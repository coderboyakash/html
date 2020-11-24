var owl = $('.owl-carousel');
         owl.owlCarousel({
             items:1,
             loop:true,
             margin:10,
             autoplay:true,
             autoplayTimeout:3000,
             autoplayHoverPause:true
         });
         $('.play').on('click',function(){
             owl.trigger('play.owl.autoplay',[1000])
         })
         $('.stop').on('click',function(){
             owl.trigger('stop.owl.autoplay')
         })
         $(document).ready(function(){
             $('.customer-logos').slick({
                 slidesToShow: 6,
                 slidesToScroll: 1,
                 autoplay: true,
                 autoplaySpeed: 1500,
                 arrows: false,
                 dots: false,
                 pauseOnHover: false,
                 responsive: [{
                     breakpoint: 768,
                     settings: {
                         slidesToShow: 4
                     }
                 }, {
                     breakpoint: 520,
                     settings: {
                         slidesToShow: 3
                     }
                 }]
             });
         });
         $('#play-video').on('click', function(e){
           e.preventDefault();
           $('#video-overlay').addClass('open');
           $("#video-overlay").append('<iframe width="560" height="315" src="https://youtu.be/OuwQuV-_Nlc" frameborder="0" allowfullscreen></iframe>');
         });
         
         $('.video-overlay, .video-overlay-close').on('click', function(e){
           e.preventDefault();
           close_video();
         });
         
         $(document).keyup(function(e){
           if(e.keyCode === 27) { close_video(); }
         });
         
         function close_video() {
           $('.video-overlay.open').removeClass('open').find('iframe').remove();
         };
      document.querySelectorAll('.addToCart').forEach(item => {
         item.addEventListener('submit', event => {
            event.preventDefault();
            let data= new FormData(item)
            console.log('add to cart');
            $.ajax({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               type:'POST',
               url:"{{route('addtocart')}}",
               data: data,
               contentType: false,
               processData: false,
               success:function(response) {
                  // Toast.fire({
                  // icon: response['type'],
                  // title: response['msg'],
                  // })
                  console.log(response)
               }
            });
         })
      })
