@extends('layouts.dynamic')
@section('content')
<div class="row" >
    1<img class="col-sm-3" src="http://35.198.231.185/vapesite/public/images/1GQiexEY3Ku9PIAeHINEXOLEF0nlDjogfJre6H5r.png">
    2<img class="col-sm-3" src="http://35.198.231.185/vapesite/public/images/vI2neM8SzCetr3CvD2GfD8kdh29CRBJtpazeYA1m.png">
    3<img class="col-sm-3" src="http://35.198.231.185/vapesite/public/images/kaD4teJD8cIkLAztwpt11pR1uGXfayKytqf49CYt.png">
</div>
<form class='uploadSmallBanner mb-2' method="POST" action="{{ route('admin.upload.small.banner') }}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label for="link1">link1</label>
        <div class="input-group mb-2">
            <input type="text" class="form-control" id="link1" name="link1">
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="link2">link2</label>
        <div class="input-group mb-2">
            <input type="text" class="form-control" id="link2" name="link2">
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="link3">link3</label>
        <div class="input-group mb-2">
            <input type="text" class="form-control" id="link3" name="link3">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image1" name="image1">
          <label class="custom-file-label" for="image1">Choose file</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image2" name="image2">
          <label class="custom-file-label" for="image2">Choose file</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image3" name="image3">
          <label class="custom-file-label" for="image3">Choose file</label>
        </div>
      </div>
    </div>
  </div>
  <div class="input-group">
    <select name="layout_id" class="form-control mt-2">
      <option value="1">Layout 1</option>
      <option value="2">Layout 2</option>
      <option value="3">Layout 3</option>
    </select>
  </div>
    <button type="submit" class="btn btn-primary mt-3" id="upload">Upload</button>
</form>
@endsection
@section('scripts')
  <script>
    $( ".uploadSmallBanner" ).on('submit',function( event ) {
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
              url:"{{ route('admin.show.small.banners') }}",
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