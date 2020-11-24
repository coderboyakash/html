@extends('layouts.dynamic')
@section('content')
  <table id="table" class="table table-bordered table-hover pro_list">
    <thead>
    <tr>
      <th>Id No</th>
      <th>Service Banner Title</th>
      <th>Service Banner Body</th>
      <th>Service Banner Icon</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($servicebanners as $servicebanner)
      <tr>
        <td>{{ $servicebanner->id }}</td>
        <td class='text-center'>{{ $servicebanner->title }}</td>
        <td class='text-center'>{{ $servicebanner->body }}</td>
        <td class='text-center'>
          <a href="/admin"><img src="{{ asset('public/'.$servicebanner->image_path) }}" style="width:50px"></a>
        </td>
        <td class='text-center'>
          <a href="javascript:void(0);" class="btn btn-danger ml-3 editServiceBanner" data-action='edit' data-id='{{ $servicebanner->id }}' data-url='{{ route("admin.edit.service.banner") }}'>Edit</a>
          <a href="javascript:void(0);" class="btn btn-danger ml-3 deleteServiceBanner" data-action='delete' data-id='{{ $servicebanner->id }}' data-url='{{ route("admin.delete.service.banner") }}'>Delete</a>
        </td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th>Id No</th>
      <th>Service Banner Title</th>
      <th>Service Banner Body</th>
      <th>Service Banner Icon</th>
      <th>Action</th>
    </tr>
    </tfoot>
  </table>
  <button class="btn btn-success mt-2" id="addServiceBanner" data-url="{{ route('admin.add.service.banner') }}">Add Small New Banner</button>
@endsection
@section('scripts')
  <script>
    document.querySelector('#addServiceBanner').addEventListener('click', function(e){
      let url = e.target.getAttribute('data-url');
      $.ajax({
        type:'GET',
        url:url,
        success:function(data) {
          $("#edit_product").html(data);
          $("#edit_product").fadeIn();
        }
      })
    })
    document.querySelectorAll('.editServiceBanner').forEach(item => {
      $("#edit_product").fadeOut();
      item.addEventListener('click', event => {
        let url = event.target.getAttribute('data-url');
        let id = event.target.getAttribute('data-id');
        $.ajax({
        type:'GET',
        url:url,
        data:{id:id},
          success:function(data) {
            $("#edit_product").html(data);
            $("#edit_product").fadeIn();
          }
        })
      }) 
    })
    document.querySelectorAll('.deleteServiceBanner').forEach(item => {
      item.addEventListener('click', event => {
      let url = event.target.getAttribute('data-url');
      let id = event.target.getAttribute('data-id');
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
              $("#load_products").fadeOut();
              $.ajax({
                type:'GET',
                url:"{{ route('admin.show.service.banner') }}",
                data:{id:id},
                success:function(data) {
                  $("#load_products").html(data);
                  $("#load_products").fadeIn();
                }
              })
            }
          });
        }
      })
    })
  </script>
@endsection