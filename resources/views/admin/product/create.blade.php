@extends('layouts.dynamic')
@section('content')
  <form action="{{ route('admin.add.product') }}" method="POST" id="addNewProduct">
  @csrf
    <div class="form-group">
      <label for="brand">New Product</label>
      <input class="form-control" name="name">
    </div>
    <div class="form-check mt-1 ml-1">
      <input type="checkbox" class="form-check-input" id="only_menu" name="only_menu">
      <label class="form-check-label" for="only_menu">Only Menu</label>
    </div>
    <div class="form-group mt-2">
      <button type="submit" id=submit class="btn btn-primary">Submit</button>
    </div>
    
  </form>
  @php $i = 0; @endphp
  <table id="table" class="table table-bordered table-hover pro_list">
  <thead>
  <tr>
    <th>Sl No</th>
    <th>Product Name</th>
    <th>Icon</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->name }}</td>
      <td><img style="width:50px" src="{{ asset('public/'.$product->icon_path) }}"></td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 editpro" data-id='{{ $product->id }}' data-type='{{ $product->type }}' data-url='{{ route("admin.edit.product") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deletepro" data-action='delete' data-id='{{ $product->id }}' data-url='{{ route("admin.delete.product") }}' data-type='{{ $product->type }}'>Delete</a>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>Sl No</th>
    <th>Product Name</th>
    <th>Icon</th>
    <th>Action</th>
  </tr>
  </tfoot>
</table>
@endsection
<script>
  $( "#addNewProduct" ).on('submit',function( event ) {
    event.preventDefault();
    var url = this.getAttribute('action');
    var type = this.getAttribute('data-type');
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
          if(response['errors'] != null){
            errors = response['errors']
            Object.values(errors).forEach(val => {
              Toast.fire({
                icon: response['icon'],
                title: '&nbsp;&nbsp;&nbsp;&nbsp;'+val,
              })
            });
          }else{
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })  
            element.classList.remove('disabled');
            $('#submit').html('Submit')
          }
            $.ajax({
              type:'GET',
              url:"{{ route('admin.add.product') }}",
              data: {type: type},
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
    document.querySelector("form").reset();
    window.location.href = '{{ route('admin.dashboard') }}';
  });
  document.querySelector('.pro_list').addEventListener('click', function(e){
    if(e.target.classList.contains('editpro')){
    console.log('edit clicked')
    let id = e.target.getAttribute('data-id');
    let action = e.target.getAttribute('data-action');
    let url = e.target.getAttribute('data-url');
    $("#new_product").fadeOut();
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
    }else if( e.target.classList.contains('deletepro')){
      console.log('delete clicked')
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
