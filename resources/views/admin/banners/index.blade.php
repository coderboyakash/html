@extends('layouts.dynamic')
@section('content')
  <table id="table" class="table table-bordered table-hover pro_list">
    <thead>
    <tr>
      <th>Sl No</th>
      <th>Banner</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
      <tr>
        <td>{{ $banner->id }}</td>
        <td>{{ $banner->name }}</td>
        <td class='text-center'><a href="/admin"><img src="{{ $banner->path ? asset('/public/'.$banner->path) : '/public/favicon.ico' }}" style="width:100px"></a></td>
        <td class='text-center'>
          <a href="javascript:void(0);" class="btn btn-danger ml-3 deleteBanner" data-action='delete' data-id='{{ $banner->id }}' data-url='{{ route("admin.delete.banner") }}'>Delete</a>
        </td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th>Sl No</th>
      <th>Banner</th>
      <th>Action</th>
    </tr>
    </tfoot>
  </table>
  <button class="btn btn-success"id="addNewBanner" data-url="{{ route('admin.upload.banner') }}">Add New Banner</button>
@endsection
@section('scripts')
  <script>
    document.querySelector('#addNewBanner').addEventListener('click', function(e){
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
      document.querySelectorAll('.deleteBanner').forEach(item => {
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
                    event.target.parentElement.parentElement.remove();
                  }
                });
              }
        }) 
      })
  </script>
@endsection
