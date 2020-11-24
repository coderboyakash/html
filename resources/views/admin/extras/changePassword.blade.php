<div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Change Password</p>

          <form method="POST" action="{{ route('admin.change.password') }}" id=changePasswd>
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="username" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="New Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
                <button type="submit" class="btn btn-primary btn-block">Update Password</button>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <script>
  $( "#changePasswd" ).on('submit',function( event ) {
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
          }
      });
      event.preventDefault();
    });
</script>