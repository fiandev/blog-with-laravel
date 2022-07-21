@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">
     total users ({{ $users->count() }}) !
   </h1>
   <a href="{{ url('/dashboard/users/create/') }}" class="btn btn-primary mb-3">register new user!</a>
</div>
<div class="table-responsive">
  @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <table class="table table-striped table-sm text-center">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">photo</th>
          <th scope="col">email</th>
          <th scope="col">name</th>
          <th scope="col">username</th>
          <th scope="col">posts</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            <img style="max-height: 2rem;max-width: 2rem" class="rounded" src="{{ $user->photo !== null ? url($user->photo) : url('post-images/no-pp.jpg') }}" alt="{{ $user->name }} photo" />
          </td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->posts->count() }}</td>
          <td class="d-flex gap-1">
            <a href="/dashboard/users/{{ $user->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
            <a href="/dashboard/users/{{ $user->slug }}/edit" class="badge bg-primary"><span data-feather="edit"></span></a>
            <form action="/dashboard/users/{{ $user->slug }}" method="post" accept-charset="utf-8">
              @method("delete")
              @csrf
              <button type="submit" onclick="return confirm('are you sure ?, user with name {{ $user->name }} will be delete!')" class="badge bg-danger border-0">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
</div>
<!-- pagination-->
<div class="overflow-scroll d-flex justify-content-center">
  {{ $users->onEachSide(0)->links() }}
</div>
<!-- end pagination-->
@endsection

