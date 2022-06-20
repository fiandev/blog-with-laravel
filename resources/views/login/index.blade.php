@extends("layouts.main")

@section("head")
<title>{{ $title }}</title>
@endsection


@section("container")
<div class="row justify-content-center">
  <div class="col-lg-6">
    <main class="form-signin">
      <h1 class="h3 my-3 fw-normal text-center">Please Login</h1>
      @if(session()->has("registered"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session("registered") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session()->has("loginError"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session("loginError") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <form action="/login/" method="post">
        @csrf
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Example@example.com">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-2">
          <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        
        <small class="d-block text-center text-capitalize my-3">
          <p>not registered ? <a href="/register/">register now!</a></p>
          
        </small>
      </form>
    </main>
  </div>
</div>
@endsection