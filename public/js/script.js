var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

function loadUpdatedItems(type){
  $.ajax({
    type:'GET',
    url:url,
    data: {type: type},
    success:function(data) {
      setTimeout(function(){
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
      }, 500);
    }
  });
}