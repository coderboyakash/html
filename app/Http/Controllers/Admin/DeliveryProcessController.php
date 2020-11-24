<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryProcess;
use App\Models\Payment;

class DeliveryProcessController extends Controller
{
    public function showDeliveryProcess()
    {
        $processes = DeliveryProcess::all();
        return view('admin.deliveryProcess.index', compact('processes'))
        ->render();
    }

    public function editDeliveryProcess(Request $request)
    {
        $response = array();
        if($request->isMethod('get')) {
            $process = DeliveryProcess::find($request->id);
            return view('admin.deliveryProcess.edit', compact('process'))
            ->render();
        }if($request->isMethod('post')){
            $process = DeliveryProcess::find($request->id);
            $process->title = $request->title;
            $process->day_range = $request->day_range;
            $process->charge = $request->charge;
            $process->save();
            $response['icon'] = 'success';
            $response['msg'] = 'Delivery Process Updated Successfully';
            return $response;
        }
    }

    public function deleteDeliveryProcess(Request $request)
    {
        $response = array();
        try {
            DeliveryProcess::where('id',$request->id)->delete();
            $response['icon'] = 'success';
            $response['msg'] = 'Delivery Process Deleted Successfully';
            return $response;
        } catch (\Throwable $th) {
            $response['icon'] = 'warning';
            $response['msg'] = 'Something Went Wrong';
            return $response;
        }
    }

    public function addDeliveryProcess(Request $request)
    {
        $response = array();
        try {
            DeliveryProcess::create($request->all());
            $response['icon'] = 'success';
            $response['msg'] = 'Delivery Process Added Successfully';
            return $response;
        } catch (\Throwable $th) {
            $response['icon'] = 'warning';
            $response['msg'] = 'Something went wrong';
            return $response;
        }

    }

    public function itemDelivered(Request $request)
    {
        $response = array();
        try {
            $order = Payment::find($request->id);
            $order->delivery_status = 'delivered';
            $order->update();
            $response['icon'] = 'success';
            $response['msg'] = 'Status Updated Successfully';
        } catch (\Throwable $th) {
            $response['icon'] = 'warning';
            $response['msg'] = 'Something went wrong';
        }
        return $response;
    }
    public function itemPending(Request $request)
    {
        $response = array();
        try {
            $order = Payment::find($request->id);
            $order->delivery_status = 'pending';
            $order->update();
            $response['icon'] = 'success';
            $response['msg'] = 'Status Updated Successfully';
        } catch (\Throwable $th) {
            $response['icon'] = 'warning';
            $response['msg'] = 'Something went wrong';
        }
        return $response;
    }

    public function showInvoice($id)
    {
        $order = Payment::find($id);
        return view('admin.orderManage.invoice', compact('order'))
        ->render();
    }
}
