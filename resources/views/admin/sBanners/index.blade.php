@extends('layouts.dynamic')
@section('content')
  <table id="table" class="table table-bordered table-hover pro_list">
    <thead>
    <tr>
      <th>Id No</th>
      <th>Small Banner</th>
      <th>Layout Id</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($smallbanners as $smallbanner)
      @php 
        $links = explode(",",$smallbanner->link);
        $paths = explode(",",$smallbanner->path);
      @endphp
      <tr>
        <td>{{ $smallbanner->id }}</td>
        <td class='text-center'>
          <a href="/admin"><img src="{{ asset('/public/'.$paths[0]) }}" style="width:50px"></a>
          <a href="/admin"><img src="{{ asset('/public/'.$paths[1]) }}" style="width:50px"></a>
          <a href="/admin"><img src="{{ asset('/public/'.$paths[2]) }}" style="width:50px"></a>
        </td>
        <td class='text-center'>{{ $smallbanner->layout_id }}</td>
        <td class='text-center'>
          <a href="javascript:void(0);" class="btn btn-danger ml-3 deleteSmallBanner" data-action='delete' data-id='{{ $smallbanner->id }}' data-url='{{ route("admin.delete.small.banner") }}'>Delete</a>
        </td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
      <th>Id No</th>
      <th>Small Banner</th>
      <th>Layout Id</th>
      <th>Action</th>
    </tr>
    </tfoot>
  </table>
  <button class="btn btn-success"id="addNewSmallBanner" data-url="{{ route('admin.upload.small.banner') }}">Add Small New Banner</button>
@endsection
@section('scripts')
  <script>
    document.querySelector('#addNewSmallBanner').addEventListener('click', function(e){
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
      document.querySelectorAll('.deleteSmallBanner').forEach(item => {
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
