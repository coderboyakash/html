<form action="{{ route('admin.edit.product') }}" method="POST" id="updateProduct">
  @csrf
  <div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
  </div>
  <input type="hidden" name="id" value="{{ $product->id }}">
  <label for="icon">Icon</label>
  <div class="input-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="icon" name="icon">
        <label class="custom-file-label" for="icon">Choose file</label>
      </div>
  </div>
  <div class="form-group">
    <button type="submit" id="update" class="btn btn-primary mt-3">Update</button>
  </div>
</form>

<script>
  document.getElementById('updateProduct').addEventListener('submit', function(e){
    e.preventDefault();
    let url = this.getAttribute('action');
    let data = new FormData(this)
    element = document.getElementById('update');
    element.innerHTML = 'Updating..'
    var itag = document.createElement("i");
    itag.classList.add('fa');
    itag.classList.add('fa-spinner');
    itag.classList.add('fa-spin');
    element.classList.add('disabled');
    element.appendChild(itag)
    $.ajax({
      type:'POST',
      url:url,
      data: data,
      processData: false,
      contentType: false,
      success:function(response) {
        Toast.fire({
          icon: response['icon'],
          title: response['msg'],
        })
        $("#edit_product").fadeOut();
        $("#load_products").fadeOut();
        element.classList.remove('disabled');
        $('#update').html('Update')
      }
    });
    setTimeout(function(){
      $.ajax({
        type:'GET',
        url:"{{ route('admin.add.product') }}",
        success:function(data) {
            $("#load_products").html(data);
            $("#load_products").fadeIn();
            $('#table').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
        }
      });
    }, 100);
  })
</script>