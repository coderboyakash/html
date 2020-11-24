<button class="btn btn-info btn-block mt-1 mb-3" id="addProduct" data-type="{{ $type }}" data-url="{{ route('admin.add.item') }}">Add {{ ucfirst($type) }}</button>
<table id="table" class="table table-bordered table-striped item_list">
  <thead>
    <tr>
      <th>Item</th>
      <th>Brand</th>
      <th>Images</th>
      <th>Type</th>
      <th>Variant, Price, Quantity, Sale</th>
      <th>Add Variants and Price</th>
      <th>F&A</th>
      <th>S&A</th>
      <th>T&S&W</th>
      <th>T&S&M</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $item)
    @if($item->brand->type->product->name == $type)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $item->brand->name }}</td>
      <td>
          @foreach($item->images as $image)
          <div class="row">
            <div class="col-sm-7 m-0">
              <img class="rounded-circle border border-success" src="{{ asset('public/'.$image->path) }}" style="width:25px; display:inline;">
            </div>
            <div class="col-sm-4">
              <a href="javascript:void(0);" class="close imgBtn" data-imageId="{{ $image->id }}"><span>&times;</span></a>
            </div>
          </div>
          @endforeach
      </td>
      <td>{{ $item->brand->type->name }}</td>
      <td>
        <ul class="list-unstyled">
            @foreach($item->variants as $variant)
                <div class="row" style="border:1px solid grey;">
                    <div class="col-sm-10 m-0">
                        <li data-id="{{ $variant->id }}">{{ $variant->name }} & {{ $variant->price }} & {{ $variant->quantity }} & {{ $variant->sale }} </li>
                    </div>
                    <div class="col-sm-2">
                        <li data-id="{{ $variant->id }}" class="varBtn"><a class="vBD" href="javascript:void(0);">&times;</a> </li>
                    </div>
                </div>
            @endforeach
        </ul>
      </td>
      <td>
        <form action="{{ route('admin.add.item.variant') }}" method="POST" class="save_color">
            <div class="row">
              @csrf
              <input type="text" class="col-sm-12  pr-2 form-control mr-1 " name='name' placeholder="Name">
              <input type="text" class="col-sm-12  pr-2 form-control mr-1 " name='price' placeholder="Price">
              <input type="text" class="col-sm-12  pr-2 form-control mr-1 " name='quantity' placeholder="Stock Quantity">
              <input type="text" class="col-sm-12  pr-2 form-control mr-1 " name='sale' placeholder="Sale %">
              <input type="hidden" name='item_id' value="{{ $item->id }}">
              <button type="submit" class="btn btn-info btn-block mt-1 vbtn"><i class="fas fa-save"></i></button>
            </div>
        </form>
      </td>
      <td>
        @if($item->featured_arrival != null)
        <input type="checkbox" name="fa" checked class="featured_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.featured.arrival') }}`)" >
        @else
        <input type="checkbox" name="fa" class="featured_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.featured.arrival') }}`)">
        @endif
      </td>
      <td>
        @if($item->special_arrival != null)
        <input type="checkbox" name="fa" checked class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.special.arrival') }}`)">
        @else
        <input type="checkbox" name="fa" class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.special.arrival') }}`)">
        @endif
      </td>
      <td>
        @if($item->top_selling_week != null)
        <input type="checkbox" name="fa" checked class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.top.selling.week') }}`)">
        @else
        <input type="checkbox" name="fa" class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.top.selling.week') }}`)">
        @endif
      </td>
      <td>
        @if($item->top_selling_month != null)
        <input type="checkbox" name="fa" checked class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.top.selling.month') }}`)">
        @else
        <input type="checkbox" name="fa" class="special_arrival_checkbox" onclick="changeArrival('{{ $item->id }}',`{{ route('admin.edit.top.selling.month') }}`)">
        @endif
      </td>
      <td class='text-center'>
        <a href="javascript:void(0);" class="btn btn-warning ml-3 editbtn" data-id='{{ $item->id }}' data-url='{{ route("admin.edit.item") }}' data-action='edit'>Edit</a>
        <a href="javascript:void(0);" class="btn btn-danger ml-3 deletebtn" data-action='delete' data-id='{{ $item->id }}' data-url='{{ route("admin.delete.item") }}' data-type="{{$type}}">Delete</a>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
  <tfoot>
    <tr>
    <th>Item</th>
      <th>Brand</th>
      <th>Images</th>
      <th>Type</th>
      <th>Variant, Price, Quantity, Sale</th>
      <th>Add Variants and Price</th>
      <th>F&A</th>
      <th>S&A</th>
      <th>T&S&W</th>
      <th>T&S&M</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>
<script>
  document.querySelector('.item_list').addEventListener('click', function(e){
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
    if(e.target.classList.contains('editbtn')){
    let id = e.target.getAttribute('data-id');
    let action = e.target.getAttribute('data-action');
    let url = e.target.getAttribute('data-url');
    let type = e.target.getAttribute('data-type');
    $("#new_product").fadeOut();
    $("#edit_product").fadeIn();
    $('#edit_product').html('<h3>Loading Form Please Wait!!! <i class="fa fa-spinner fa-spin"></i></h3>')
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
    let type = e.target.getAttribute('data-type');
      if(confirm('Are you sure ?')){
        e.target.innerHTML = 'Deleting..'
        var itag = document.createElement("i");
        itag.classList.add('fa');
        itag.classList.add('fa-spinner');
        itag.classList.add('fa-spin');
        e.target.classList.add('disabled');
        e.target.appendChild(itag)
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
                }, 500);
              }
            });
          }
        });
      }
    }
  });
  document.getElementById('addProduct').addEventListener('click', function(e){
  document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    let url = e.target.getAttribute('data-url');
    let type = e.target.getAttribute('data-type');
    $("#edit_product").fadeOut();
    $("#new_product").fadeIn();
    $('#new_product').html('<h3>Loading Form Please Wait!!! <i class="fa fa-spinner fa-spin"></i></h3>')
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
  document.querySelectorAll('.special_arrival_checkbox').forEach(item => {
    item.addEventListener('click', event => {
      let url = event.target.getAttribute('data-url');
      let id = event.target.getAttribute('data-id');
      console.log('clicked')
          $.ajax({
            type:'GET',
            url:url,
            data: {id: id},
            success:function(data) {
              console.log(data)
            }
          });
    }) 
  })
  
  document.querySelectorAll('.vbtn').forEach(item => {
      item.addEventListener('click', event => {
          event.target.innerHTML = "Saving Data Please Wait....";
      })
  })
    document.querySelectorAll('.vBD').forEach(item => {
      item.addEventListener('click', event => {
        //   console.log(event.target.innerHTML)
          event.target.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
        //   console.log(event.target.innerHTML);
      })
  })
  document.querySelectorAll('.save_color').forEach(item => {
    item.addEventListener('submit', event => {
      event.preventDefault();
      let url = event.target.getAttribute('action');
      let data = new FormData(event.target)
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
            event.target.reset();
            Toast.fire({
              icon: 'success',
              title: 'Variant Added Successfully!!',
            })
            type = "{{ $type }}";
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
                }, 500);
              }
            });
          }
        // event.target.innerHTML('<i class="fa fas-save"></i>');
        });
    }) 
  })
  document.querySelectorAll('.save_size').forEach(item => {
    item.addEventListener('submit', event => {
      event.preventDefault();
      let url = event.target.getAttribute('action');
      let data = new FormData(event.target)
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
            event.target.reset();
          }
        });
    }) 
  })
  document.querySelectorAll('.save_flavour').forEach(item => {
    item.addEventListener('submit', event => {
      event.preventDefault();
      let url = event.target.getAttribute('action');
      let data = new FormData(event.target)
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
            event.target.reset();
          }
        });
    }) 
  })
  document.querySelectorAll('.save_strength').forEach(item => {
    item.addEventListener('submit', event => {
      event.preventDefault();
      let url = event.target.getAttribute('action');
      let data = new FormData(event.target)
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
            event.target.reset();
          }
        });
    }) 
  })
  document.querySelectorAll('.imgBtn').forEach(item => {
    item.addEventListener('click', event => {
      let id = item.getAttribute('data-imageId');
      if(confirm('Are you sure ?')){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'GET',
          url:"{{ route('admin.delete.item.image') }}",
          data:{id:id},
          success:function(response) {
            Toast.fire({
              icon: 'success',
              title: 'Images deleted successfully',
            })
            item.parentElement.parentElement.remove();
          }
        });
      }
    }) 
  })
  document.querySelectorAll('.varBtn').forEach(item => {
    item.addEventListener('click', event => {
      let id = item.getAttribute('data-id');
      if(confirm('Are you sure ?')){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'GET',
          url:"{{ route('admin.delete.item.variant') }}",
          data:{id:id},
          success:function(response) {
            Toast.fire({
              icon: 'success',
              title: 'Variant deleted successfully',
            })
            item.parentElement.parentElement.remove();
          }
        });
      }
    }) 
  })







function changeArrival(id, url){
  $.ajax({
    type:'GET',
    url:url,
    data: {id: id},
    success:function(data) {
    //   console.log(data)
    }
  });
}








  // document.querySelectorAll('.featured_arrival_checkbox').forEach(item => {
  //   item.addEventListener('click', event => {
  //     let url = event.target.getAttribute('data-url');
  //     let id = event.target.getAttribute('data-id');
  //     console.log('clicked')

  //   }) 
  // })
//   document.querySelector('#addProduct').addEvenetListener('click', function(){

//   })
    document.querySelectorAll('.editbtn').forEach(item => {
      item.addEventListener('click', event => {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
      })
    })
</script>