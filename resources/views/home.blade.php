@extends("layouts/main")

@section("container")
  <div
    style="height: 70vh"
    class="d-flex flex-column align-items-center justify-content-center gap-3 text-center"
  >
    <img
      style="width: 10rem"
      class="img-fluid rounded shadow-sm"
      src="https://i.ibb.co/FKrVtqC/photo.jpg"
      alt="XII TKJ - SMK AW"
    />
    <h1 class="fs-5 m-0 darkmode-text fw-semibold">{{ env("APP_NAME", "blog") }}</h1>
    <p class="m-0 darkmode-text text-capitalize">
      <span id="slogan"></span>
    </p>

    <div
      class="d-flex gap-2 align-items-center darkmode-text-2"
      style="font-size: 0.8rem"
    >
      <div class="d-flex gap-2 align-items-center darkmode-text-2">
        <i class="fa fa-file text-primary"></i>
        {{ $total_posts }} postingan
      </div>
      <div
        class="d-flex gap-2 align-items-center darkmode-text-2"
      >
        <i class="fa fa-users text-primary"></i>
        {{ $total_users }} pengguna
      </div>
    </div>

    <div class="d-flex flex-column gap-2">
      <a href="{{ url('/posts') }}" class="btn btn-primary">jelajahi</a>
    </div>
  </div>
@endsection