@extends('layouts.dynamic')
@section('content')
<form class='editServiceBanner mb-2' method="POST" action="{{ route('admin.edit.service.banner') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $servicebanner->id }}">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Title</label>
        <input id="title" class="form-control" type="text" name="title" value="{{ $servicebanner->title }}">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="body">Body</label>
        <input id="body" class="form-control" type="text" name="body" value="{{ $servicebanner->body }}">
      </div>
    </div>
    <div class="col-sm-12 mt-2 mb-2">
      <div class="custom-file">
        <input id="image" class="custom-file-input" type="file" name="image">
        <label for="image" class="custom-file-label">Icon</label>
      </div>
    </div>
    <div class="form-group ml-2 mt-2">
      <button type="submit" id="editServiceBanner" class="btn btn-success">Update</button>
    </div>
  </div>
</form>
@endsection
@section('scripts')
  <script>
    $( ".editServiceBanner" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      element = document.getElementById('editServiceBanner');
      element.innerHTML = 'Updating..'
      var itag = document.createElement("i");
      itag.classList.add('fa');
      itag.classList.add('fa-spinner');
      itag.classList.add('fa-spin');
      element.classList.add('disabled');
      element.appendChild(itag)
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
            element.classList.remove('disabled');
            $('#saveServiceBanner').html('Save &nbsp;<i class="fas fa-save"></i>')
            $.ajax({
              type:'GET',
              url:"{{ route('admin.show.service.banner') }}",
              success:function(data) {
                $("#load_products").html(data);
              }
          });
          }
      });
      event.preventDefault();
    });
  </script>
@endsection