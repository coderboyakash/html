<table id="table" class="table table-bordered table-striped payments_list">
  <thead>
    <tr>
      <th>Payment Id</th>
      <th>State</th>
      <th>Method</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Subtotal</th>
      <th>Payer Id</th>
      <th>Invoice Number</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($payments as $payment)
    <tr>
      <td>{{ $payment->payment_id }}</td>
      <td>{{ $payment->state }}</td>
      @if($payment->method == 'paypal')
        <td>PayPal</td>
      @else
        <td>Card</td>
      @endif
      <td>{{ $payment->fname }}</td>
      <td>{{ $payment->lname }}</td>
      <td>{{ $payment->subtotal }}</td>
      <td>{{ $payment->payer_id }}</td>
      <td>{{ $payment->invoice_number }}</td>
      @if($payment->delivery_status === 'pending')
        <td><button class="btn btn-info" onclick="delivered({{$payment->id}})">PENDING</td></button>
      @elseif($payment->delivery_status === 'delivered')
        <td><button class="btn btn-success" onclick="pending({{$payment->id}})">DELIVERED</button></td>
      @endif
      <td><a class="btn btn-primary btn-block" href="{{ route('show.invoice',$payment->id) }}" target="_blank">Download</a></td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Payment Id</th>
      <th>State</th>
      <th>Method</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Subtotal</th>
      <th>Payer Id</th>
      <th>Invoice Number</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>

<script>
  function delivered(id){
    $.ajax({
      type:'GET',
      url: "{{ route('admin.item.delivered') }}",
      data: {id: id},
      success:function(response) {
        Toast.fire({
          icon: response['icon'],
          title: response['msg'],
        })
        reloadData();
      }
    })
  }
  function pending(id){
    $.ajax({
      type:'GET',
      url: "{{ route('admin.item.pending') }}",
      data: {id: id},
      success:function(response) {
        Toast.fire({
          icon: response['icon'],
          title: response['msg'],
        })
        reloadData();
      }
    })
  }

  function reloadData() {
    $.ajax({
      type:'GET',
      url:"{{ route('admin.show.payments') }}",
      success:function(data) {
        setTimeout(function(){
          $("#load_products").html(data);
          $("#load_products").fadeIn();
          $("#table").DataTable({
              "responsive": true, 
              "lengthChange": true, 
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "autoWidth": false,
              "buttons": ["csv", "excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }, 1000);
      }
      });
  }

  // function showInvoice(id){
  //   $("#edit_product").fadeOut();
  //   $("#load_products").fadeOut();
  //   $("#new_product").fadeOut();
  //   $.ajax({
  //     type:'GET',
  //     url: "{{ route('show.invoice', 1) }}",
  //     data: {id: id},
  //     success:function(data) {
  //       setTimeout(function(){
  //         $("#load_products").html(data);
  //         $("#load_products").fadeIn();
  //         $("#table").DataTable({
  //           "responsive": true, 
  //           "lengthChange": true, 
  //           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
  //           "autoWidth": false,
  //           "buttons": ["csv", "excel", "pdf"]
  //         }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
  //       }, 500);
  //     }
  //   })
  // }
</script>