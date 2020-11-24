@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.edit.product.type') }}" method="POST" id="editProductType">
  @csrf
    <div class="form-group">
      <label for="type">Product</label>
      <select class="custom-select form-control-border" name="product_id">
        <option value='null'>Select Product</option>
        @foreach($products as $product)
          <option value='{{ $product->id }}'>{{ ucfirst($product->name) }}</option>
        @endforeach
      </select>
    </div>
    <input type="hidden" name="id" value="{{ $type->id }}">
    <div class="form-group">
      <label for="type">Type</label>
      <input class="form-control" name="name" value="{{ $type->name }}">
    </div>
    <div class="form-check mt-1 ml-1">
      <input type="checkbox" class="form-check-input" id="sub_menu" name="sub_menu">
      <label class="form-check-label" for="sub_menu">Sub Category</label>
    </div>
    <div class="form-group">
      <button id="update" type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
  <script>
      $( "#editProductType" ).on('submit',function( event ) {
    event.preventDefault();
    var url = this.getAttribute('action');
    var formdata = new FormData(this);
    element = document.getElementById('update');
    element.innerHTML = 'Updating..'
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
        $('#update').html('Update')
            $.ajax({
              type:'GET',
              url:"{{ route('admin.product.type') }}",
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
</script>
  </script>
@endsection