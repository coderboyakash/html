@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.product.itemtype') }}" method="POST" id="addNewItem">
  @csrf
    <div class="form-group">
      <label for="type">Product</label>
      <select class="custom-select form-control-border" name="type_id" id="product">
          <option value='null'>Select Product Type</option>
          @foreach($products as $product)
            <option value='{{ $product->id }}'>{{ $product->type }}</option>
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
      <label for="type">Brand</label>
      <select class="custom-select form-control-border" name="product_brand_id" id="product_brand">
          <option value='null'>Choose Type First</option>
      </select>
    </div>
    <div class="form-group">
      <label for="brand">Item Type</label>
      <input class="form-control" name="item_type">
    </div>
    <div class="form-group">
      <input type="submit" value="Submit" class="btn btn-primary">
    </div>
  </form>
  @php $i = 0; @endphp
  <table id="table" class="table table-bordered table-hover itemtype_list">
  <thead>
  <tr>
    <th>Sl No</th>
    <th>Item Type Name</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($itemtypes as $itemtype)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $itemtype->item_type }}</td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 edititemtype" data-id='{{ $itemtype->id }}' data-url='{{ route("admin.edit.product.itemtype") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deleteitemtype" data-action='delete' data-id='{{ $itemtype->id }}' data-url='{{ route("admin.delete.itemtype") }}'>Delete</a>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>Sl No</th>
    <th>Item Type Name</th>
    <th>Action</th>
  </tr>
  </tfoot>
</table>
@endsection
<script>
  $( "#addNewItem" ).on('submit',function( event ) {
    event.preventDefault();
    var url = this.getAttribute('action');
    var formdata = new FormData(this);
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
            $.ajax({
              type:'GET',
              url:"{{ route('admin.product.itemtype') }}",
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
    let type_id = this.options[this.selectedIndex].value;
    let url = "{{ route('admin.get.product.type') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {type_id: type_id},
      success:function(data) {
        $("#product_type").html(data);
      }
    });
  })
  document.getElementById('product_type').addEventListener('change', function(e){
    let product_type_id = this.options[this.selectedIndex].value;
    let url = "{{ route('admin.get.product.brand') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {product_type_id: product_type_id},
      success:function(data) {
        $("#product_brand").html(data);
      }
    });
  })
  document.querySelector('.itemtype_list').addEventListener('click', function(e){
    if(e.target.classList.contains('edititemtype')){
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
    }else if( e.target.classList.contains('deleteitemtype')){
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