@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.edit.product.brand') }}" method="POST" id="updateProductBrand">
  @csrf
    <div class="form-group">
      <label for="type">Product</label>
      <select class="custom-select form-control-border" name="product_id" id="product">
          <option value='{{ $brand->type->product->id }}'>{{ $brand->type->product->name }}</option>
          @foreach($products as $product)
            <option value='{{ $product->id }}'>{{ $product->name }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <select class="custom-select form-control-border" name="product_type_id" id="product_type">
          <option value='{{ $brand->type->id }}'>{{ $brand->type->name }}</option>
      </select>
    </div>
    <input class="form-control" type="hidden" name="id" value="{{ $brand->id }}">
    <div class="form-group">
      <label for="brand">Brand</label>
      <input class="form-control" name="name" value="{{ $brand->name }}">
    </div>
    <div class="form-group">
      <button type="submit" id="update" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection
<script>
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



    document.getElementById('updateProductBrand').addEventListener('submit', function(e){
    e.preventDefault();
    let url = this.getAttribute('action');
    let data = new FormData(this)
    element = document.getElementById('update');
    element.innerHTML = 'Updating..'
    var itag = document.createElement("i");
    itag.classList.add('fa');
    itag.classList.add('fa-spinner');
    itag.classList.add('fa-spin');
    element.classList.add('disabled');
    element.appendChild(itag)
    $.ajax({
      type:'POST',
      url:url,
      data: data,
      processData: false,
      contentType: false,
      success:function(response) {
        Toast.fire({
          icon: response['icon'],
          title: response['msg'],
        })
        $("#edit_product").fadeOut();
        $("#load_products").fadeOut();
        element.classList.remove('disabled');
        $('#update').html('Update')
      }
    });
    setTimeout(function(){
      $.ajax({
        type:'GET',
        url:"{{ route('admin.product.brand') }}",
        success:function(data) {
            $("#load_products").html(data);
            $("#load_products").fadeIn();
            $('#table').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
        }
      });
    }, 100);
  })
</script>