@extends("layouts/main")
@section("head")
<title>Myblog | {{ $post->title }}</title>
@endsection
@section("container")
<div class="content row">
  <div class="col-md-8 overflow-visible">
    <article class="mb-3 px-2 ">
     <div class="card-article">
      <div class="card-body">
        <h5 class="card-title text-center">{{ $post->title }}</h5>
         <img src="{{ ($post->image != null) ? url($post->image) : 'https://source.unsplash.com/1800x1200?'.($post->category->name ?? 'no image') }}" class="img-fluid my-2 thumbnail" alt="thumbnail {{ $post->title }}">
        <p class="list-group-item"><span class="fw-bold">by</span> : <a href="/posts/?author={{ $post->author->username ?? '-' }}">{{ $post->author->name ?? 'none' }}</a> | {{ $post->created_at->diffForHumans() ?? 'none' }}</p>
        <p class="list-group-item"><span class="fw-bold">category</span> : 
          <a href="/posts/?category={{ $post->category->slug ?? '-' }}">
            {{ $post->category->name ?? "none" }}
          </a>
        </p>
        <p class="card-text">{!! $post->body !!}</p>
      </div>
      <div class="card-footer">
        <a href="/blog">back to posts</a>
      </div>
    </div>
    </article>
  </div>
</div>
@endsection