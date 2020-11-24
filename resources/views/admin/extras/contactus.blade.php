@extends('layouts.dynamic')

@section('content')
  <form action="{{ route('admin.save.contact.us') }}" id="contactusSave" method="POST">
    <div class="row">
        <div class="form-group col-3">
          <label for="mail">Email ID</label>
          <input class="form-control" name="mail" value="{{ $contactus->mail }}">
        </div>
        <div class="form-group col-3">
          <label for="phone">Phone</label>
          <input class="form-control" name="phone" value="{{ $contactus->phone }}">
        </div>
        <div class="form-group col-3">
          <label for="address">Address</label>
          <input class="form-control" name="address" value="{{ $contactus->address }}">
        </div>
        <div class="form-group col-3">
          <label for="you_link">Youtube Link</label>
          <input class="form-control" name="you_link" value="{{ $contactus->you_link }}">
        </div>
        <div class="form-group col-3">
          <label for="ins_link">Instagram Link</label>
          <input class="form-control" name="ins_link" value="{{ $contactus->ins_link }}">
        </div>
        <div class="form-group col-3">
          <label for="fb_link">Facebook Link</label>
          <input class="form-control" name="fb_link" value="{{ $contactus->fb_link }}">
        </div>
        <div class="form-group col-3">
          <label for="tw_link">Twitter Link</label>
          <input class="form-control" name="tw_link" value="{{ $contactus->tw_link }}">
        </div>
        <div class="form-group col-3">
          <label for="lind_link">LinkedIn Link</label>
          <input class="form-control" name="lind_link" value="{{ $contactus->lind_link }}">
        </div>
        <div class="form-group col-3">
          <label for="pin_link">Pinterest Link</label>
          <input class="form-control" name="pin_link" value="{{ $contactus->pin_link }}">
        </div>
        <div class="form-group col-5">
        <button type="submit" class="btn btn-primary"><i class="fas fa-cog"></i> Save Setting</button>
        </div>
    </div>
  </form>
@endsection
<script>
  $( "#contactusSave" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      let data= new FormData(this)
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'POST',
          url:url,
          data: data,
          contentType: false,
          processData: false,
          success:function(response) {
            console.log(response)
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
          }
      });
      event.preventDefault();
    });
</script>