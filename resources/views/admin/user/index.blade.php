  <table id="users_list" class="table table-bordered table-hover">
  <thead>
  <tr>
    <th>Id</th>
    <th>User Name</th>
    <th>Email Id</th>
    <th>Status</th>
  </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
      @if($user->is_admin != 1)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td class='text-center'>
            <a href="javascript:void(0);" data-url="{{ route('admin.change.user.status', $user->id) }}" class="btn {{ $user->is_active ? 'btn-primary' : 'btn-warning' }} ml-3 btnUser">{{ $user->is_active ? 'Active' : 'Not Active' }}</a>
          </td>
        </tr>
      @endif
    @endforeach
  </tbody>
  <tfoot>
  <tr>
    <th>Id</th>
    <th>User Name</th>
    <th>Email Id</th>
    <th>Status</th>
  </tr>
  </tfoot>
</table>
<script>
  setTimeout(function(){
    document.querySelectorAll('.btnUser').forEach(item => {
      item.addEventListener('click', event => {
        item.classList.add('disabled');
        url = item.getAttribute('data-url')
        var tmp = item.innerHTML
        var itag = document.createElement("i");
        itag.classList.add('fa');
        itag.classList.add('fa-spinner');
        itag.classList.add('fa-spin');
        item.appendChild(itag)
        $.ajax({
          type:'GET',
          url:url,
          success:function(data) {
            setTimeout(function(){
              if(tmp === 'Active'){
                item.innerHTML = 'Not Active'
                item.classList.remove('btn-primary');
                item.classList.add('btn-warning');
              }else{
                item.innerHTML = 'Active'
                item.classList.remove('btn-warning');
                item.classList.add('btn-primary');
              }
              item.classList.remove('disabled');
            }, 1000);
          }
        });
      })
    })
    }, 500);
  </script>