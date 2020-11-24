@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.product.type') }}" method="POST" id="addNewType">
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
    <div class="form-group">
      <label for="type">Type</label>
      <input class="form-control" name="name">
    </div>
    <div class="form-check mt-1 ml-1">
      <input type="checkbox" class="form-check-input" id="sub_menu" name="sub_menu">
      <label class="form-check-label" for="sub_menu">Sub Category</label>
    </div>
    <div class="form-group">
      <label for="type">Sub Category Name</label>
      <input class="form-control" name="sub_menu_name" placeholder="Optional">
    </div>
    <div class="form-group">
      <button id="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @php $i = 0; @endphp
  <table id="table" class="table table-bordered table-hover protype_list">
  <thead>
  <tr>
    <th>Sl No</th>
    <th>Product Type Name</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($types as $type)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $type->name }}</td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 edittype" data-id='{{ $type->id }}' data-url='{{ route("admin.edit.product.type") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deletetype" data-action='delete' data-id='{{ $type->id }}' data-url='{{ route("admin.delete.product.type") }}'>Delete</a>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>Sl No</th>
    <th>Product Type Name</th>
    <th>Action</th>
  </tr>
  </tfoot>
</table>
@endsection
@section('scripts')
<script>
  $( "#addNewType" ).on('submit',function( event ) {
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
              url:"{{ route('admin.product.type') }}",
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
  document.querySelector('.protype_list').addEventListener('click', function(e){
    if(e.target.classList.contains('edittype')){
      console.log('clicked')
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
    }else if( e.target.classList.contains('deletetype')){
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
@endsection