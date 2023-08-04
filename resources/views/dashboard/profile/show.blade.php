@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">profile</h1>
</div>
<div class="privilages d-flex flex-column col-md-6 col-lg-5">
  @can("member")
  @endcan
  <div class="card">
    <img src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" class="card-img-top" alt="{{ auth()->user()->name }}`s photo">
    <div class="card-body">
      <h5 class="card-title">
        {{ auth()->user()->name }}
      </h5>
      <p class="card-text">
        your name is {{ auth()->user()->name }}, you have a nickname {{ auth()->user()->username }}, your total posts are {{ auth()->user()->posts->count() }} posts!, your role is @foreach(auth()->user()->roles as $role) {{ $loop->iteration === auth()->user()->roles->count() ? $role->name : $role->name."," }} @endforeach who has benefits :
      </p>
    </div>
    <ul class="benefits list-group list-group-flush">
      @can("member")
      <li class="list-group-item">
        ✅ You can manage your posts
      </li>
      <li class="list-group-item">
        ✅ You can see the statistics of your posts
      </li>
      <li class="list-group-item">
        ✅ You can change your profile
      </li>
      @endcan
      
      @can("mod")
      <li class="list-group-item">
        ✅ You can see statistics of all posts
      </li>
      @endcan
      
      @can("admin")
      <li class="list-group-item">
        ✅ You can manage post categories
      </li>
      <li class="list-group-item">
        ✅ You can manage all user accounts
      </li>
      @endcan
    </ul>
    <div class="card-body">
      <a href="{{ url('/dashboard/profile/edit') }}" class="card-link">edit profile</a>
    </div>
  </div>
</div>
@endsection