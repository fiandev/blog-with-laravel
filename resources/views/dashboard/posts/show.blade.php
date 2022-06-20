@extends("dashboard.main")

@section("container")
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  </div>
   <div class="content row">
    <div class="col-md-12 overflow-visible">
      <div class="d-flex justify-content-start gap-1 mb-3 align-items-center overflow-scroll">
        <a href="/dashboard/posts" class="btn btn-success mx-1 d-flex align-items-center gap-2"><span data-feather="arrow-left"></span> my posts</a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-primary d-flex align-items-center gap-2"><span data-feather="edit"></span> edit</a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" accept-charset="utf-8">
            @method("delete")
            @csrf
            <button type="submit" class="btn btn-danger mx-1 d-flex align-items-center gap-2" onclick="return confirm('are you sure?')">
              <i data-feather="x-circle"></i>
              delete
            </button>
          </form>
        </div>
        <article class="mb-3 px-2 ">
         <div class="card-article">
          <div class="card-body">
            <h5 class="card-title text-center">{{ $post->title }}</h5>
             <img src="{{ ($post->image != null) ? url($post->image) : 'https://source.unsplash.com/1200x400?'.$post->category->name }}" class="img-fluid my-2 thumbnail" alt="thumbnail {{ $post->title }}">
            <p class="list-group-item"><span class="fw-bold">by</span> : <a href="/posts/?author={{ $post->author->username }}">{{ $post->author->username }}</a> | {{ $post->created_at->diffForHumans() }}</p>
            <p class="list-group-item"><span class="fw-bold">category</span> : <a href="/posts/?category={{ $post->category->slug }}">{{ $post->category->name }}</a></p>
            <p class="card-text">{!! $post->body !!}</p>
          </div>
        </div>
        </article>
        
      </div>
    </div>
@endsection