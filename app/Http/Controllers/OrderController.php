<?php

namespace App\Http\Controllers;
use auth;
use App\Models\User;
use Omnipay\Omnipay;
use App\Models\Cart;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use App\Models\OrderConfig;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use LaravelDaily\Invoices\Invoice;
use App\Http\Controllers\Controller;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Mail\OrderPlaced;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('app.paypal1'),config('app.paypal2')
            )
        );
        $tax = $this->getTax();
        $items = $this->getCartItemsArray('paypal')['items'];
        $price = $this->getCartItemsArray('paypal')['price'];
        $shipping = $this->getShipping($request->payment_id);
        // setting up payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        // inserting items in itemlist
        $itemList = new ItemList();
        $itemList->setItems($items);
        $details = new Details();
        $details->setShipping($shipping)
            ->setTax(($tax*$price)/100)
            ->setSubtotal($price);
        // calculating amount
        $amount = new Amount();
        $amount->setCurrency("GBP")
            ->setTotal($price+($tax*$price)/100+$shipping)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        $payment_id = $request->payment_id;
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('execute-payment', compact('payment_id')))
            ->setCancelUrl(route('execute-payment'));
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
            $payment->create($apiContext);
        return redirect($payment->getApprovalLink());
    }
    public function execute(Request $request)
    {
        $tax = $this->getTax();
        $items = $this->getCartItemsArray('paypal')['items'];
        $price = $this->getCartItemsArray('paypal')['price'];
        $shipping = $this->getShipping($_GET['payment_id']);
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('app.paypal1'),config('app.paypal2')
            )
        );
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);
        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping($shipping)
            ->setTax(($tax*$price)/100)
            ->setSubtotal($price);

        $amount->setCurrency('GBP');
        $amount->setTotal($price+$shipping+($tax*$price)/100);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
        $execution->addTransaction($transaction);
        try {
            $result = $payment->execute( $execution, $apiContext);
        } catch (\Throwable $th) {
            return 'something went wrong';
        }
        // saving payment in database
        $payment_data = array(
            'payment_id' => $result->id,
            'state' => $result->state,
            'payment_method' => $result->payer->payment_method,
            'payer_id' => $result->payer->payer_info->payer_id,
            'subtotal' => $result->transactions[0]->amount->details->subtotal,
            'invoice_number' => $result->transactions[0]->invoice_number,
        );
        $this->savePaymentData($payment_data, $_GET['payment_id']);
        $payment = \App\Models\Payment::find($_GET['payment_id']);
        $customer = new Buyer([
            'name'          => $result->payer->payer_info->first_name.' '.$result->payer->payer_info->last_name,
            'custom_fields' => [
                'email' => $payment->email,
            ],
        ]);
        // $invoice_no = $result->transactions[0]->invoice_number;
        $invoice_no = uniqid('vape').$payment->id.time();
        $invoice_name = auth()->user()->id.'_'.time();
        $invoice_data = array(
            'customer' => $payment->fname . ' ' . $payment->lname,
            'address' => $payment->address,
            'phone' => $payment->phone,
            'email' => $payment->email,
            'zip_code' => $payment->zip_code,
            'city' => $payment->city,
            'provison' => $payment->provison,
            'country' => $payment->country,
            'invoice_no' => $invoice_no,
            'invoice_name' => $invoice_name
        );
        $this->generateInvoice($invoice_data,$_GET['payment_id']);
        return redirect('paymentConfirmed');
    }

    public function chargeWithCard(Request $request)
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        if ($request->input('stripeToken')) {
  
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
          
            $token = $request->input('stripeToken');
            $tax = $this->getTax();
            $price = $this->getCartItemsArray('paypal')['price'];
            $response = $gateway->purchase([
                'amount' => number_format($price+(($price*$tax)/100), 2, '.', ''),
                'currency' => env('STRIPE_CURRENCY'),
                'token' => $token,
            ])->send();
          
            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData();
                 
                $isPaymentExist = \App\Models\Payment::where('payment_id', $arr_payment_data['id'])->first();
          
                if(!$isPaymentExist)
                {
                    $payment_data = array(
                        'payment_id' => $arr_payment_data['id'],
                        'state' => $arr_payment_data['status'],
                        'payment_method' => $arr_payment_data['payment_method'],
                        'payer_id' => $arr_payment_data['source']['id'],
                        'subtotal' => ($arr_payment_data['amount']/100),
                        'invoice_number' => '123456789',
                    );
                    $this->savePaymentData($payment_data, $request->payment_id);
                }
                $payment = \App\Models\Payment::find($request->payment_id);
                $customer = new Buyer([
                    'name'          =>$payment->fname.' '.$payment->lname,
                    'custom_fields' => [
                        'email' => $payment->email,
                    ],
                ]);
                $invoice_name = auth()->user()->id.'_'.time();
                $payment = \App\Models\Payment::find($request->payment_id);
                $invoice_no = uniqid('vape').$payment->id.time();
                $invoice_data = array(
                    'customer' => $payment->fname . ' ' . $payment->lname,
                    'address' => $payment->address,
                    'phone' => $payment->phone,
                    'email' => $payment->email,
                    'zip_code' => $payment->zip_code,
                    'city' => $payment->city,
                    'provison' => $payment->provison,
                    'country' => $payment->country,
                    'invoice_no' => $invoice_no,
                    'invoice_name' => $invoice_name
                );
                $this->generateInvoice($invoice_data,$request->payment_id);
                return redirect()->route('payment.confirmed');
                return "Payment is successful. Your payment id is: ". $arr_payment_data['id'];
            } else {
                // payment failed: display message to customer
                return $response->getMessage();
            }
        }
    }

    public function getCartItemsArray($paymentType) 
    {
        $items = [];
        if($paymentType === 'card'){
            $price = 0;
            foreach(auth()->user()->carts as $cart)
            {
                $item = (new InvoiceItem())->title($cart->item->name)->pricePerUnit($cart->item->price)->quantity($cart->quantity);
                $items[] = $item; 
                $price += $cart->quantity * $cart->item->price;
            }
        }else if($paymentType === 'paypal'){
            $items = [];
            $loop = 0;
            $priceFinal = 0;
            foreach(auth()->user()->carts as $cart)
            {
                if($cart->variant_id != null){
                    $tmpItem = \App\Models\ItemVariant::find($cart->variant_id);
                    $name = $cart->item->name.' '.$tmpItem->name;
                    $price = $tmpItem->price;
                }else{
                    $name = $cart->item->name;
                    $price = $cart->item->price;
                }
                $item = new Item();
                $item->setName($name)
                    ->setPrice($price)
                    ->setCurrency('GBP')
                    ->setQuantity($cart->quantity);
                $items[] = $item;
                $priceFinal += $cart->quantity * $price;
            }
        }
        $data['items'] = $items;
        $data['price'] = $priceFinal;
        return $data;
    }

    public function getTax()
    {
        $orderConfig = OrderConfig::first();
        return $orderConfig->tax;
    }

    public function getShipping($id)
    {
        $del_id = \App\Models\Payment::find($id)->delivery_mode_id;
        $shipping = \App\Models\DeliveryProcess::find($del_id);
        return $shipping->charge;
    }

    public function savePaymentData($data, $id)
    {
        $payment = \App\Models\Payment::find($id);
        $payment->payment_id = $data['payment_id'];
        $payment->state = $data['state'];
        $payment->method = $data['payment_method'];
        $payment->payer_id = $data['payer_id'];
        $payment->subtotal = $data['subtotal'];
        $payment->invoice_number = $data['invoice_number'];
        // $payment->invoice_number = $result->transactions[0]->invoice_number;
        $payment->update();
    }

    public function generateInvoice($data,$id)
    {
        // invoice generation
        $items = [];
        $priceFinal = 0;
        foreach(auth()->user()->carts as $cart)
        {
            if($cart->variant_id != null){
                $tmpItem = \App\Models\ItemVariant::find($cart->variant_id);
                $name = $cart->item->name.' '.$tmpItem->name;
                $price = $tmpItem->price;
            }else{
                $name = $cart->item->name;
                $price = $cart->item->price;
            }
            \App\Models\Order::create([
                'invoice_id' => $id,
                'user_id' => auth()->user()->id,
                'name' => $name,
                'price' => $price,
                'quantity' => $cart->quantity,
            ]);
            $item = (new InvoiceItem())->title( $name )->pricePerUnit( $price )->quantity( $cart->quantity );
            $items[] = $item; 
            $priceFinal += $cart->quantity * $price;
        }
        $shipping = $this->getShipping($id);
        $customer = new Party([
            'name'      => $data['customer'],
            'address'   => $data['address'].' ' .$data['zip_code'].' ' .$data['city'],
            'custom_fields' => [
                'phone'     => $data['phone'],
                'email'     => $data['email'],
                'provison'  => $data['provison'],
                'country'   => $data['country'],
            ],
        ]);
        $invoice = Invoice::make()
            ->buyer($customer)
            ->series($data['invoice_no'])
            ->serialNumberFormat('{SERIES}')
            ->discountByPercent(0)
            ->taxRate($this->getTax())
            ->shipping($shipping)
            ->addItems($items)
            ->filename($data['invoice_name'])
            ->logo("public/images/invoice_logo.png")
            ->save('invoices');
            $payment = \App\Models\Payment::find($id);
            $payment->invoice_path = '/invoices/'.$data['invoice_name'].'.pdf';
            $path = $payment->invoice_path;
            $payment->update();
            $this->sendMail($data['email'], $path, $data['customer']);
            foreach(auth()->user()->carts as $cart){
                if($cart->variant_id != NULL){
                    $iv = \App\Models\ItemVariant::find($cart->variant_id);
                    $tmp = $iv->quantity;           
                    $tmp -= 1;
                    $iv->quantity = $tmp;
                    $iv->update();     
                }else{
                    $iv = \App\Models\Item::find($cart->item_id);
                    $tmp = $iv->quantity;           
                    $tmp -= 1;
                    $iv->quantity = $tmp;
                    $iv->update();
                }
            }
            foreach(auth()->user()->carts as $cart){
                $cart->delete();
            }
    }

    public function sendMail($email, $invoice_path, $name)
    {
        $data = array(
            'mail' => $email,
            'path' => $invoice_path,
            'name' => $name,
        );
        Mail::to($email)->send(new OrderPlaced($data));
        return Mail::to("sales@vapeunderground.co.uk")->send(new OrderNotification($data));
    }
}
