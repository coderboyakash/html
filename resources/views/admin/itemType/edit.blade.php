@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.edit.product.itemtype') }}" method="POST" id="editItemType">
  @csrf
    <div class="form-group">
      <label for="type">Product</label>
      <select class="custom-select form-control-border" name="type_id" id="product">
          <option value='{{ $itemtype->brand->type->product->id }}'>{{ $itemtype->brand->type->product->type }}</option>
          @foreach($products as $product)
            <option value='{{ $product->id }}'>{{ $product->type }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <select class="custom-select form-control-border" name="product_type_id" id="product_type">
          <option value='{{ $itemtype->brand->type->id }}'>{{ $itemtype->brand->type->name }}</option>
          <option value='null'>Choose Product To Load New Product Types</option>
      </select>
    </div>
    <div class="form-group">
      <label for="type">Brand</label>
      <select class="custom-select form-control-border" name="product_brand_id" id="product_brand">
          <option value='{{ $itemtype->brand->id }}'>{{ $itemtype->brand->name }}</option>
          <option value='null'>Choose Type To Load New Product Brands</option>
      </select>
    </div>
    <input type="hidden" name="id" value={{ $itemtype->id }}>
    <div class="form-group">
      <label for="brand">Item Type</label>
      <input class="form-control" name="item_type" value={{ $itemtype->item_type }}>
    </div>
    <div class="form-group">
      <input type="submit" value="Update" class="btn btn-primary">
    </div>
  </form>

  <script>
  $( "#editItemType" ).on('submit',function( event ) {
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
                  $("#edit_product").fadeOut();
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
  </script>
@endsection