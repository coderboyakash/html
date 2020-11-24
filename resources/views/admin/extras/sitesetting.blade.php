@extends('layouts.dynamic')

@section('content')
  <form action="{{ route('admin.save.site.setting') }}" id="settingSave" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-3">
          <label for="name">App Name</label>
          <input class="form-control" name="name" value="{{ $sitesetting->name }}">
        </div>
        <div class="form-group col-3">
          <label for="website_link">App URL</label>
          <input class="form-control" name="website_link" value="{{ $sitesetting->website_link }}">
        </div>
        <div class="form-group col-3">
          <label for="vat_no">Vat No</label>
          <input class="form-control" name="vat_no" value="{{ $sitesetting->vat_no }}">
        </div>
        <div class="form-group col-3">
          <label for="reg_no">Company Registration No</label>
          <input class="form-control" name="reg_no" value="{{ $sitesetting->reg_no }}">
        </div>
        <div class="form-group col-5">
        <button type="submit" class="btn btn-primary"><i class="fas fa-cog"></i> Save Setting</button>
        </div>
    </div>
  </form>
@endsection
<script>
  $( "#settingSave" ).on('submit',function( event ) {
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