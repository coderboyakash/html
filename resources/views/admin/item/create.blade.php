@extends('layouts.dynamic')
@section('content')
<form method="POST" action="{{ route('admin.add.item') }}" data-type="{{ $type }}" class="m-5" id="addNewProduct" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="@if($product->only_product->is_exsits == 1) d-none @else col-3 @endif">
      <div class="form-group">
        <label for="type">Type</label>
        <select class="custom-select form-control-border" name="product_type_id" id="product_type">
            @if($product->only_product->is_exsits == 1) 
                <option value='{{$product->types->first()->id}}'>{{$product->types->first()->name}}</option>
            @else 
                <option value='null'>Select Product Type</option>
            @endif
          @foreach($types as $type)
            <option value='{{ $type->id }}'>{{ $type->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="@if($product->only_product->is_exsits == 1) d-none @else col-3 @endif">
    <div class="form-group">
      <label for="type">Brand</label>
      <select class="custom-select form-control-border" name="product_brand_id" id="product_brand">
                      @if($product->only_product->is_exsits == 1) 
          <option value='{{$product->types->first()->brands->first()->id}}'>{{$product->types->first()->brands->first()->name}}</option>
            @else 
          <option value=''>Optional If Chosen Subcategory</option>
            @endif
      </select>
    </div>
    </div>
    <div class="@if($product->only_product->is_exsits == 1) col-6 @else col-3 @endif">
    <div class="form-group">
      <label for="price">Price(£)</label>
      <input type="text" id="price" class="form-control price" name='price'>
    </div>
    </div>
    <div class="@if($product->only_product->is_exsits == 1) col-6 @else col-3 @endif">
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="text" id="quantity" class="form-control quantity" name='quantity'>
    </div>
    </div>
    <div class="col-10">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" class="form-control name" name='name'>
    </div>
    </div>
    <div class="col-2">
    <div class="form-group">
      <label for="name">Sale %</label>
      <input type="text" id="sale" class="form-control sale" name='sale'>
    </div>
    </div>
  </div>
  <!-- description -->
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="summary-ckeditor" name="description"></textarea>
  </div>

  <input type="file" name="images[]" multiple id='images' >
  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
</form>
@endsection
@section('scripts')
<script>
    $('.colors').select2()
    $( "#addNewProduct" ).on('submit',function( event ) {
      event.preventDefault();
      var url = this.getAttribute('action');
      var type = this.getAttribute('data-type');
      var editorData = document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML;
      let data= new FormData(this)
      element = document.getElementById('submit');
        element.innerHTML = 'Processing..'
        var itag = document.createElement("i");
        itag.classList.add('fa');
        itag.classList.add('fa-spinner');
        itag.classList.add('fa-spin');
        element.classList.add('disabled');
        element.appendChild(itag)
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
            console.log(response)
            Toast.fire({
              icon: response['icon'],
              title: response['msg'],
            })
            document.querySelector("form").reset();
            document.querySelector('.cke_wysiwyg_frame').contentWindow.document.body.innerHTML = '';
            element.classList.remove('disabled');
            $('#submit').html('Submit')
            $.ajax({
              type:'GET',
              url:"{{route('admin.show.items')}}",
              data: {type: type},
              success:function(data) {
                setTimeout(function(){
                  $("#load_products").html(data);
                  $("#table").DataTable({
                    "responsive": true,  
                    "lengthChange": true, 
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf"]
                  }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
                  document.getElementById('addNewProduct').reset();
                }, 500);
              }
            });
          }
      });
      event.preventDefault();
    });
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
</script>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace( 'summary-ckeditor' );
  $('.price').keyup(function () { 
      this.value = this.value.replace(/[^0-9\.]/g,'');
  });
  $('.quantity').keyup(function () { 
      this.value = this.value.replace(/[^0-9\.]/g,'');
  });
</script>
@endsection
