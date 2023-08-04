@extends("layouts/main")
@section("head")
<title>{{ env("APP_NAME", "blog") }} | {{ $post->title }}</title>
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
        
        <hr class="my-2">
        
        <p id="article-content" class="card-text">{{ $post->body }}</p>
      </div>
      <div class="card-footer">
        <a href="{{ url('/posts') }}">back to posts</a>
      </div>
    </div>
    </article>
  </div>
</div>
@endsection


@section("css")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
@endsection

@section("script")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
  <script>
    $(document).ready(function (){
      let Article = $("#article-content").text()
      
      console.log({
        c: markdownToHtml(Article),
        a: Article,
      });
      $("#article-content").html(markdownToHtml(Article))
      
      hljs.highlightAll();
    })
  </script>
@endsection