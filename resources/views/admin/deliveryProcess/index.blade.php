<form action="{{ route('admin.add.delivery.process') }}" id="addDeliveryProcess" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-3">
          <label for="title">Title</label>
          <input class="form-control" name="title">
        </div>
        <div class="form-group col-3">
          <label for="day_range">Day Range</label>
          <input class="form-control" name="day_range">
        </div>
        <div class="form-group col-3">
          <label for="charge">Charge</label>
          <input class="form-control" name="charge">
        </div>
        <div class="form-group col-5">
        <button type="submit" class="btn btn-primary" id="addDeliveryProcessBtn">Add New Delivery Process</button>
        </div>
    </div>
  </form>
<table id="table" class="table table-bordered table-striped deliveryProcessList">
  <thead>
    <tr>
      <th>Title</th>
      <th>Day Range</th>
      <th>Charge</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($processes as $process)
    <tr>
      <td>{{ $process->title }}</td>
      <td>{{ $process->day_range }}</td>
      <td>£{{ $process->charge }}</td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 editDeliveryProcessBtn" data-id='{{ $process->id }}' data-url='{{ route("admin.edit.delivery.process") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deletebtn" data-action='delete' data-id='{{ $process->id }}' data-url='{{ route("admin.delete.delivery.process") }}'>Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Title</th>
      <th>Day Range</th>
      <th>Charge</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>
<script>

$( "#addDeliveryProcess" ).on('submit',function( event ) {
      event.preventDefault();
      element = document.getElementById('addDeliveryProcessBtn');
      element.innerHTML = 'Adding..'
      var itag = document.createElement("i");
      itag.classList.add('fa');
      itag.classList.add('fa-spinner');
      itag.classList.add('fa-spin');
      element.classList.add('disabled');
      element.appendChild(itag)
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
            $('#addDeliveryProcessBtn').html('Add New Delivery Process')
            document.querySelector("#addDeliveryProcess").reset();
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

    document.querySelector('.deliveryProcessList').addEventListener('click', function(e){
    if(e.target.classList.contains('editDeliveryProcessBtn')){
    let id = e.target.getAttribute('data-id');
    let url = e.target.getAttribute('data-url');
    $.ajax({
      type:'GET',
      url:url,
      data: {id: id},
      success:function(data) {
        $("#edit_product").html(data);
        $("#edit_product").fadeIn();
      }
    });
  }
  })
  document.querySelector('.deliveryProcessList').addEventListener('click', function(e){
    if(e.target.classList.contains('editDeliveryProcessBtn')){
    let id = e.target.getAttribute('data-id');
    let action = e.target.getAttribute('data-action');
    let url = e.target.getAttribute('data-url');
    let type = e.target.getAttribute('data-type');
    $("#new_product").fadeOut();
    $.ajax({
      type:'GET',
      url:url,
      data: {id: id, action: action},
      success:function(data) {
        $("#edit_product").html(data);
        $("#edit_product").fadeIn();
      }
    });
    e.preventDefault();
    }else if( e.target.classList.contains('deletebtn')){
      let url = e.target.getAttribute('data-url');
      let id = e.target.getAttribute('data-id');
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
      }
    }
  });
  document.getElementById('addProduct').addEventListener('click', function(e){
    let url = e.target.getAttribute('data-url');
    let type = e.target.getAttribute('data-type');
    $("#edit_product").fadeOut();
    $.ajax({
      type:'GET',
      url:url,
      data: {type: type},
      success:function(data) {
        $("#new_product").fadeIn();
        $("#new_product").html(data);
      }
    });
  });
</script>