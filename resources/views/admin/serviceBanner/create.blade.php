@extends('layouts.dynamic')
@section('content')
<form class='addServiceBanner mb-2' method="POST" action="{{ route('admin.add.service.banner') }}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="title">Title</label>
        <input id="title" class="form-control" type="text" name="title">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="body">Body</label>
        <input id="body" class="form-control" type="text" name="body">
      </div>
    </div>
    <div class="col-sm-12 mt-2 mb-2">
      <div class="custom-file">
        <input id="image" class="custom-file-input" type="file" name="image">
        <label for="image" class="custom-file-label">Icon</label>
      </div>
    </div>
    <div class="form-group ml-2 mt-2">
      <button type="submit" id="saveServiceBanner" class="btn btn-success">Save &nbsp;<i class="fas fa-save"></i></button>
    </div>
  </div>
</form>
@endsection
@section('scripts')
  <script>
    $( ".addServiceBanner" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      element = document.getElementById('saveServiceBanner');
      element.innerHTML = 'Saving..'
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
      $('.addServiceBanner').reset();
      event.preventDefault();
    });
  </script>
@endsection