@extends('layouts.dynamic')
@section('content')
<form class='uploadBanner mb-2' method="POST" action="{{ route('admin.upload.banner') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
      <label for="image">Banner</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image">
          <label class="custom-file-label" for="image">Choose file</label>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary" id="upload">Upload</button>
</form>
@endsection
@section('scripts')
  <script>
    $( ".uploadBanner" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      element = document.getElementById('upload');
      element.innerHTML = 'Uploading..'
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
            $('#upload').html('Upload')
            $.ajax({
              type:'GET',
              url:"{{ route('admin.show.banners') }}",
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