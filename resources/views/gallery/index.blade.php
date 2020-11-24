@extends('layouts.dynamic')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
    <h3>Upload New Images In Gallery</h3>
    <div class="row mb-5 ml-3 mr-3 mt-3">
      <div class="col-12">
        <form action="{{ route('admin.upload.gallery.image') }}" id="uploadGalleryImage" enctype="multipart/form-data">
          <div class="form-group">
            <input type="file" name="images[]" multiple id="images" class="custom-file-input">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <div class="form-group">
            <button type="submit" id="upload" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
    
    <input type="text" id="link2" value="link" class="form-control">
      <table id="table" class="table table-bordered table-hover galleryImages">
    <thead>
    <tr>
      <th>Sl No</th>
      <th>Banner</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($images as $image)
      <tr>
        <td>{{ $image->id }}</td>
        <td><a href="{{ asset( 'public/'.$image->image->path ) }}" target="_blank">
            <img src="{{ asset( 'public/'.$image->image->path ) }}" class="img-fluid mb-2" style="width:200px;">
          </a></td>
        <td class='text-center'>
          <a href="javascript:void(0);" class="linkBtn btn btn-warning btn-block d-inline ml-4 copy" data-link="{{ asset( 'public/'.$image->image->path ) }}" >
          Link
          <p style="display:none">{{ asset( 'public/'.$image->image->path ) }}</p></a>
          <a href="javascript:void(0);" data-url="{{ route('admin.delete.gallery.image', $image->id) }}" class="delBtn btn btn-danger btn-block d-inline ml-5 pull-right">Delete</a>
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
      <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <input id="link" class="form-control">
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
      document.querySelectorAll('.delBtn').forEach(item => {
      item.addEventListener('click', event => {
        url = event.target.getAttribute('data-url');
        if(confirm('Are you sure ?')){
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: url,
            data: '',
            contentType: false,
            processData: false,
            success:function(response) {
              Toast.fire({
                icon: response['icon'],
                title: response['msg'],
              })
            }
        });
        event.target.parentElement.parentElement.remove();
      }
        }) 
    })
</script>
<script>
    document.querySelectorAll('.linkBtn').forEach(item => {
      item.addEventListener('click', event => {
        link = event.target.getAttribute('data-link');
        document.getElementById('link').setAttribute('value', link);
        $('#link2').val(link)
      }) 
    })
</script>
<script src="{{ asset('public/adminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
<script>
  $( "#uploadGalleryImage" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      var data = new FormData(this);
      element = document.getElementById('upload');
      element.innerHTML = 'Uploading..'
      var itag = document.createElement("i");
      itag.classList.add('fa');
      itag.classList.add('fa-spinner');
      itag.classList.add('fa-spin');
      element.classList.add('disabled');
      element.appendChild(itag)
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'POST',
          url:url,
          data:data,
          contentType: false,
          processData: false,
          success:function(response) {
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
          $('#upload').html('Upload')
          }
      });
      setTimeout(function(){
          $.ajax({
          type:'GET',
          url:"{{ route('admin.show.gallery') }}",
          success:function(data) {
            setTimeout(function(){
              $("#load_products").html(data);
              $('#table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            }, 500);
          }
        });
      }, 1000);
      event.preventDefault();
    });

    document.querySelectorAll('.linkBtn').forEach(item => {
      item.addEventListener('click', event => {
         setTimeout(function(){
          const myInp = document.getElementById('link2')
          myInp.select();
          document.execCommand('Copy')
          Toast.fire({
                icon: 'success',
                title: 'Link Copied',
              })
         }, 1000)
      }) 
    })
</script>
@endsection