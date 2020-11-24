// document.getElementById('filter').addEventListener('click', function(){
//   $('#filtersubmit').trigger('click');
// })
$('#filter').keyup(function(){
    let url = this.getAttribute('action');
    let method = this.getAttribute('method');
    let formdata = new FormData(this);
    console.log(url);
    $.ajax({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:method,
      url:url,
      data: formdata,
      contentType: false,
      processData: false,
      success:function(response) {
        console.log(response)
         $('#col-list').html('')
         $('#col-list').html(response)
      }
   });
})