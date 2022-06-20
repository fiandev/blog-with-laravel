@extends("layouts/main")

@section("container") 
<div class="container">
  <div class="row d-flex justify-content-center">
    <h1 style="font-size: var(--fontMobile)">{{ $title }}</h1>
 @foreach($categories as $category)
      <div class="col-md-4 col-lg-3">
        <a href="/posts/?category={{ $category->slug }}">
          <div class="card bg-dark text-white my-2">
            <img src="https://source.unsplash.com/400x400?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-auto">
              <h1 class="card-title fs-4">{{ $category->name }}</h1>
              <h5 class="card-title fs-5">{{ $category->posts->count() }} posts</h5>
            </div>
          </div>
        </a>
      </div>
 @endforeach
  </div>
</div>
@endsection