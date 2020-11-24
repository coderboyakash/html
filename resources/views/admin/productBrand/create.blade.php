@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.product.brand') }}" method="POST" id="addNewBrand">
  @csrf
    <div class="form-group">
      <label for="type">Product</label>
      <select class="custom-select form-control-border" name="product_id" id="product">
          <option value='null'>Select Product Type</option>
          @foreach($products as $product)
            <option value='{{ $product->id }}'>{{ $product->name }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <select class="custom-select form-control-border" name="product_type_id" id="product_type">
          <option value='null'>Choose Product First</option>
      </select>
    </div>
    <div class="form-group">
      <label for="brand">Brand</label>
      <input class="form-control" name="name">
    </div>
    <div class="form-group">
      <button type="submit" id=submit class="btn btn-primary">Submit</button>
    </div>
  </form>
  @php $i = 0; @endphp
  <table id="table" class="table table-bordered table-hover probrand_list">
  <thead>
  <tr>
    <th>Sl No</th>
    <th>Product Brand Name</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($brands as $brand)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $brand->name }}</td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 editbrand" data-id='{{ $brand->id }}' data-url='{{ route("admin.edit.product.brand") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deletebrand" data-action='delete' data-id='{{ $brand->id }}' data-url='{{ route("admin.delete.product.brand") }}'>Delete</a>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>Sl No</th>
    <th>Product Brand Name</th>
    <th>Action</th>
  </tr>
  </tfoot>
</table>
@endsection
<script>
  $( "#addNewBrand" ).on('submit',function( event ) {
    event.preventDefault();
    var url = this.getAttribute('action');
    var formdata = new FormData(this);
    element = document.getElementById('submit');
    element.innerHTML = 'Processing..'
    var itag = document.createElement("i");
    itag.classList.add('fa');
    itag.classList.add('fa-spinner');
    itag.classList.add('fa-spin');
    element.classList.add('disabled');
    element.appendChild(itag)
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:url,
        data:formdata,
        contentType: false,
        processData: false,
        success:function(response) {
          Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
            element.classList.remove('disabled');
            $('#submit').html('Submit')
            $.ajax({
              type:'GET',
              url:"{{ route('admin.product.brand') }}",
              success:function(data) {
                setTimeout(function(){
                  $("#load_products").html(data);
                  $('#table').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                  });
                }, 500);
              }
            });
        }
    });
    event.preventDefault();
  });
  document.getElementById('product').addEventListener('change', function(e){
    let product_id = this.options[this.selectedIndex].value;
    let url = "{{ route('admin.get.product.type') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {product_id: product_id},
      success:function(data) {
        console.log(data)
        $("#product_type").html(data);
      }
    });
  })
  document.querySelector('.probrand_list').addEventListener('click', function(e){
    if(e.target.classList.contains('editbrand')){
    let id = e.target.getAttribute('data-id');
    let action = e.target.getAttribute('data-action');
    let url = e.target.getAttribute('data-url');
    $.ajax({
      type:'GET',
      url:url,
      data: {id: id, action: action},
      success:function(data) {
        $("#edit_product").html(data);
        $("#edit_product").fadeIn();
      }
    });
    e.preventDefault();
    }else if( e.target.classList.contains('deletebrand')){
      let url = e.target.getAttribute('data-url');
      let id = e.target.getAttribute('data-id');
      if(confirm('Are you sure ?')){
        $.ajax({
          type:'GET',
          url:url,
          data: {id: id},
          success:function(response) {
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
            e.target.parentElement.parentElement.remove();
          }
        });
      }
    }
  });
</script>
@section('scripts')

@endsection