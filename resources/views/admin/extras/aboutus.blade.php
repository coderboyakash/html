<form action="{{ route('admin.save.about.us') }}" method="POST" id="saveAboutUs">
  @csrf
    <!-- description -->
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="summary-ckeditor" name="aboutus"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace( 'summary-ckeditor' );
  setTimeout(function(){
    des = `{!!$aboutus->aboutus!!}`
    console.log('aboutus',`{!!$aboutus->aboutus!!}`)
    document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML = des
  }, 1000);
</script>
<script>
  $( "#saveAboutUs" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      var editorData = document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML;
      let data= new FormData(this)
      data.append('aboutus',editorData);
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