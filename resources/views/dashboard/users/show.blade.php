@extends("dashboard.main")

@section("container")
<div class="d-flex justify-content-start flex-md-column flex-wrap flex-md-nowrap align-items-start pt-3 pb-2 mb-3 border-bottom">
  <h1 class="fs-5 text-capitalize">
    detail profile {{ $user->name }}
  </h1>
  <div class="d-flex justify-content-start gap-2">
    <button class="btn d-flex gap-2 justify-content-center align-items-center btn-outline-info" type="button">
      <i class="fa fa-arrow-left"></i>
      <a href="{{ url('/dashboard/users/') }}">back</a>
    </button>
    <button class="btn d-flex gap-2 justify-content-center align-items-center btn-outline-primary" type="button">
      <i class="fa fa-pencil"></i>
      <a href="{{ url('/dashboard/users/'.$user->slug.'/edit') }}">edit</a>
    </button>
    <button class="btn d-flex gap-2 justify-content-center align-items-center btn-outline-danger" type="button">
      <i class="fa fa-trash"></i>
      delete
    </button>
  </div>
</div>
<div class="row content">
  <div class="col-md-12 overflow-visible">
    <div class="d-flex flex-column flex-md-row align-items-center gap-3">
      <div class="photo-frame d-flex justify-content-center">
        <img class="rounded-circle pp" src="{{ $user->photo !== null ? url($user->photo) : url('post-images/no-pp.jpg') }}" alt="{{ $user->name.' photo' }}" />
      </div>
      <div class="d-flex flex-column">
        <h1 class="fs-5 d-flex gap-2">
          <b>name :</b> {{ $user->name }}
        </h1>
        <h1 class="fs-5 d-flex gap-2">
          <b>username :</b> {{ $user->username }}
        </h1>
        <h1 class="fs-5 d-flex gap-2">
          <b>email :</b> {{ $user->email }}
        </h1>
        <h1 class="fs-5 d-flex gap-2">
          <b>join :</b> {{ $user->created_at->diffForHumans() }}
        </h1>
        <h1 class="fs-5 d-flex gap-2">
          <b>posts :</b> {{ $user->posts->count() }}
        </h1>
        <div class="roles align-items-center d-flex gap-2">
          <h1 class="fs-5 d-flex gap-2">
            <b>role :</b>
          </h1>
          @if($user->roles->count() < 1)
            <div class="role d-flex justify-content-center align-items-center bg-dark text-light fw-bold px-2 py-1 rounded-pill">
              {{ "do not have roles" }}
            </div>
          @endif
          @foreach($user->roles as $role)
            <div class="role d-flex justify-content-center align-items-center bg-dark text-light fw-bold px-2 py-1 rounded-pill">
              {{ $role->name }}
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection