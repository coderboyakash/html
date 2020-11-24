@extends('layouts.admin')
@section('adminContent')
  <div id="new_product" class="col-12"></div>
  <div id="edit_product" class="col-12"></div>
  <div id="load_products" class="col-12"></div>
@endsection
@section('scripts')
  <script>
  console.log('welcome')
    $(document).ready(function() {
      let prod = document.querySelector('#products');
      let page_contents = document.querySelector('#page_contents');
      let add_product_type = document.querySelector('#nav_link');
      function loadDataFunction(e){
        let not = e.target.getAttribute('data-not');
        let url = e.target.getAttribute('data-url');
        let type = e.target.getAttribute('data-type');
        type == null ?  type = e.target.parentElement.getAttribute('data-type') : type = e.target.getAttribute('data-type');
        url == null ?  url = e.target.parentElement.getAttribute('data-url') : url = e.target.getAttribute('data-url');
        if(url == 'reload'){
          location.reload();
        }
        if(url === `{{ route('home') }}`){
          location.reload();
        }
        if(url == 'not_reload'){
          return;
        }
        if(type === ''){
            Toast.fire({
              icon: 'warning',
              title: 'Please wait Something went wrong Page will reload !! after 2 sec',
            })
            setTimeout(function(){ location.reload(); }, 3000);
        }
        $("#edit_product").fadeOut();
        // $("#load_products").fadeOut();
        $("#new_product").fadeOut();
        $("#load_products").html('<h3>Processing Please Wait ....<i class="fa fa-spinner fa-spin"></i></h3>');
        $.ajax({
          type:'GET',
          url:url,
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
            }, 500);
          }
        });
        e.preventDefault();
      }
      if(prod){
        prod.addEventListener('click',(e)=>loadDataFunction(e))
      }
      if(page_contents){
        page_contents.addEventListener('click',(e)=>loadDataFunction(e))
      }
      if(add_product_type){
        add_product_type.addEventListener('click',(e)=>loadDataFunction(e))
      }
    })
    document.getElementById('users').addEventListener('click', function(e){
      e.preventDefault();
      $("#edit_product").fadeOut();
        $("#load_products").html('<h3>Processing Please Wait ....<i class="fa fa-spinner fa-spin"></i></h3>');
      $("#new_product").fadeOut();
      $.ajax({
        type:'GET',
        url:"{{ route('admin.show.users') }}",
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
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          }, 1000);
        }
      });
    })
    document.getElementById('orders').addEventListener('click', function(e){
      e.preventDefault();
      $("#edit_product").fadeOut();
        $("#load_products").html('<h3>Processing Please Wait ....<i class="fa fa-spinner fa-spin"></i></h3>');
      $("#new_product").fadeOut();
      $.ajax({
        type:'GET',
        url:"{{ route('admin.show.payments') }}",
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
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          }, 1000);
        }
      });
    })
  </script>
@endsection