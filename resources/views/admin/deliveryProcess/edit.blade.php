<form action="{{ route('admin.edit.delivery.process') }}" id="updateDeliveryProcess" method="POST">
  @csrf
  <input type="hidden" name="id" value="{{ $process->id }}">
  <div class="row">
    <div class="form-group col-3">
      <label for="title">Title</label>
      <input class="form-control" name="title"  value="{{ $process->title }}">
    </div>
    <div class="form-group col-3">
      <label for="day_range">Day Range</label>
      <input class="form-control" name="day_range"  value="{{ $process->day_range }}">
    </div>
    <div class="form-group col-3">
      <label for="charge">Charge</label>
      <input class="form-control" name="charge"  value="{{ $process->charge }}">
    </div>
    <div class="form-group col-5">
    <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>

<script>
    $( "#editDeliveryProcess" ).on('submit',function( event ) {
      event.preventDefault();
      $("#load_products").fadeOut();
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
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
            $("#edit_product").fadeOut();
            document.querySelector("#editDeliveryProcess").reset();
          }
      });
      $.ajax({
          type:'GET',
          url:"{{ route('admin.show.delivery.process') }}",
          success:function(data) {
            setTimeout(function(){
              $("#load_products").html(data);
              $("#load_products").fadeIn();
              $("#table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf"]
              }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
            }, 500);
          }
        });
      event.preventDefault();
    });

    $( "#updateDeliveryProcess" ).on('submit',function( event ) {
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
            $("#edit_product").fadeOut();
            $.ajax({
              type:'GET',
              url:"{{route('admin.show.delivery.process')}}",
              success:function(data) {
                setTimeout(function(){
                  $("#load_products").html(data);
                  $("#table").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf"]
                  }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
                }, 500);
              }
            });
          }
      });
      event.preventDefault();
    });
</script>