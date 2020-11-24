<form method="POST" action="{{ route('admin.edit.item') }}" class="m-5" id="editItem" enctype="multipart/form-data" data-type="{{ $item->brand->type->product->type }}">
  @csrf
  <input type="hidden" name="item_id" value="{{ $item->id }}">
  <div class="row">
    <div class="@if($item->brand->type->product->only_product->is_exsits == 1) d-none @else col-4 @endif">
      <div class="form-group">
        <label for="type">Type</label>
        <select class="custom-select form-control-border" name="product_type_id" id="product_type">
          <option value='{{$item->brand->type->id}}'>{{$item->brand->type->name}}</option>
          @foreach($item->brand->type->product->types as $type)
            <option value='{{ $type->id }}'>{{ $type->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="@if($item->brand->type->product->only_product->is_exsits == 1) d-none @else col-4 @endif">
      <div class="form-group">
        <label for="type">Brand(Choose If It Has Sub Category)</label>
        <select class="custom-select form-control-border" name="product_brand_id" id="product_brand">
            <option value='{{$item->brand->id}}'>{{$item->brand->name}}</option>
            <option value='null'>Choose Type First</option>
        </select>
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" id="name" class="form-control" name='name' value="{{ $item->name }}">
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="price">Price(£)</label>
        <input type="text" id="price" class="form-control" name='price'  value="{{ $item->price }}">
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="sale">Sale(%)</label>
        <input type="text" id="sale" class="form-control" name='sale'  value="{{ $item->sale }}">
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="quantity">Stocks</label>
        <input type="text" id="quantity" class="form-control" name='quantity'  value="{{ $item->quantity }}">
      </div>
    </div>
  </div>
  <!-- description -->
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="descriptionEdit" name="description"></textarea>
  </div>
  <input type="file" name="images[]" multiple id='images'>
  <button type="submit" class="btn btn-primary editSubmitBtn">Submit</button>
</form>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace( 'descriptionEdit' );
  setTimeout(function(){
    des = `{!!$item->description!!}`
    document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML = des
  }, 1000);
  document.getElementById('product_type').addEventListener('change', function(e){
    let product_type_id = this.options[this.selectedIndex].value;
    let url = "{{ route('admin.get.product.brand') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {product_type_id: product_type_id},
      success:function(data) {
        $("#product_brand").html(data);
      }
    });
  })
  document.getElementById('product_brand').addEventListener('change', function(e){
    let product_brand_id = this.options[this.selectedIndex].value;
    let url = "{{ route('admin.get.product.itemtype') }}";
    $.ajax({
      type:'GET',
      url:url,
      data: {product_brand_id: product_brand_id},
      success:function(data) {
        $("#item_type").html(data);
      }
    });
  })
  $( "#editItem" ).on('submit',function( event ) {
      event.preventDefault();
      $('.editSubmitBtn').html('Updating Data Please Wait....')
      var url = this.getAttribute('action');
      var type = this.getAttribute('data-type');
      var editorData = document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML;
      let data = new FormData(this);
      data.append('description',editorData);
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
            document.querySelector("form").reset();
            document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML = '';
          }
      });
      type = "{{ $type->name }}";
    //   console.log(type)
      $("#load_products").html('<h3>loading data please wait</h3>');
      $.ajax({
          type:'GET',
          url:"{{ route('admin.show.items') }}",
          data: {type: type},
          success:function(data) {
            setTimeout(function(){
              $("#load_products").html(data);
              $("#load_products").fadeIn();
              $("#table").DataTable({
                    "responsive": true, 
                    "lengthChange": true, 
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf"]
                  }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
            }, 1000);
          }
        });
      event.preventDefault();
    });
    $('.price').keyup(function () { 
      this.value = this.value.replace(/[^0-9\.]/g,'');
    });
</script>
<script>
</script>