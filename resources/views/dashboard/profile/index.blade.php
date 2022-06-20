@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">profile</h1>
</div>
<div class="col-md-10 col-lg-8">
  @if(session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  @if(session()->has("info"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      {{ session("info") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  <form class="p-2" action="/dashboard/profile" method="post" accept-charset="utf-8" class="text-capitalize">
    @csrf
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="john doe" value="{{ auth()->user()->name }}">
      <label for="floatingInput">name</label>
      @error("name")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->username }}">
      <label for="floatingInput">username</label>
      @error("username")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->email }}">
      <label for="floatingInput">Email</label>
      @error("email")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">update profile</button>
  </form>
</div>
@endsection