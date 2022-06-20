@extends("layouts/main")

@section("head")
<title>MyBlog | {{ $title }}</title>
<script type="text/javascript" charset="utf-8">
  const popularPost = {{ Illuminate\Support\Js::from($popular) }}
</script>
@endsection
@section("container")
<div class="content row">
  <div class="col-lg-8" id="content">
    <!-- article -->
    <div class="row">
      <h1 class="text-capitalize" style="font-size: var(--fontMobile)">{{ request("search") ? "result for : ".request("search") : $title }}
      </h1>
       @if($posts->count() == 0)
       @include("partials/no-post")
       @else
       <div class="card shadow col-12 mb-3 p-0">
         <a class="text-white main-news-link" href="/posts/{{ $posts[0]->slug }}">
           <div class="w-100 main-news position-relative rounded overflow-hidden text-center">
             <img src="{{ ($posts[0]->image != null) ? url($posts[0]->image) : 'https://source.unsplash.com/1200x1000?'.$posts[0]->category->name }}" class="img-fluid thumbnail" style="object-fit:cover;" alt="thumbnail {{ $posts[0]->title }}">
              <h1 class="bg-primary card-title w-100 text-center py-3" style="font-size: var(--fontMobile);opacity:.8; position: absolute;bottom:-1.1vh">
                <a class="text-white" href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a>
              </h1>
              <h1 class="bg-info card-title position-absolute top-0 left-0 p-2" style="font-size: var(--fontMobile);opacity:.8;">
                <a class="text-white" href="/posts/?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
              </h1>
              <h1 class="bg-dark card-title position-absolute top-0 p-2" style="font-size: var(--fontMobile);opacity:.8;right:0">
                <a class="text-white" href="/posts/?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
              </h1>
           </div>
         </a>
      </div>
       @endif
       @foreach($posts->skip(1) as $post)
         <article class="mb-3 px-2 col-md-6 col-lg-6">
           <div class="card shadow card-article">
             <img src="{{ ($post->image != null) ? url($post->image) : 'https://source.unsplash.com/1200x400?'.($post->category->name ?? '-') }}" class="card-img-top thumbnail" style="height:150px" alt="thumbnail {{ $post->title }}">
             <h1 class="bg-info card-title position-absolute top-0 p-2" style="font-size: var(--fontMobile);opacity:.8;left:0">
                <a class="text-white" href="/posts/?category={{ $post->category->name ?? '-' }}">{{ $post->category->name ?? '-' }}</a>
              </h1>
             <h1 class="bg-dark card-title position-absolute top-0 p-2" style="font-size: var(--fontMobile);opacity:.8;right:0">
                <a class="text-white" href="/posts/?author={{ $post->author->username }}">{{ $post->author->name }}</a>
              </h1>
            <div class="card-body">
              <h1 class="card-title fs-6">
                <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                </h1>
                <small>
                  <p class="card-text">{{ $post->excerpt }} <a href="/posts/{{ $post->slug }}">readmore..</a></p>
                  
                </small>
              </div>
            </div>
           </article>
       @endforeach
         
      
    </div>
    <!-- end article -->
    <!-- pagination-->
    <div class="overflow-scroll d-flex justify-content-center">
      {{ $posts->onEachSide(0)->links() }}
    </div>
    <!-- end pagination-->
  </div>
  <!-- sidenav -->
  <div class="d-none col-lg-4 d-lg-flex flex-lg-column gap-3">
    <div class="search">
      <h1 class="text-capitalize" style="font-size: var(--fontMobile)">
        Pencarian
      </h1>
      <form action="/posts/" class="d-flex gap-2  ms-auto position-relative" role="search">
        @if(request("category"))
        <input type="hidden" name="category" value="{{ request('category') }}" />
        @endif
        @if(request("author"))
        <input type="hidden" name="author" value="{{ request('author') }}" />
        @endif
        <input autofocus class="form-control" type="search" placeholder="Search.." aria-label="Search" name="search" value="{{ request('search') }}">
        <button class="px-3 overflow-visible btn d-flex justify-content-center align-items-center btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="popular-posts d-flex flex-column gap-2">
      <h1 class="text-capitalize" style="font-size: var(--fontMobile)">
        Popular posts
      </h1>
      @foreach($popular as $post)
       <div class="post d-flex align-items-center gap-2 justify-content-between">
         <img class="side-post-thumbnail" src="{{ ($post->image != null) ? url($post->image) : 'https://source.unsplash.com/150x150?'.($post->category->name ?? '-') }}" alt="" />
         <div class="detail d-flex flex-column">
           <h1 class="side-post-title my-0">{{ $post->title }}</h1>
           <p class="side-post-title my-0">By <a href="/posts/?author={{ $post->author->username }}">{{ $post->author->name }}</a></p>
         </div>
       </div>
     @endforeach
    </div>
    <div class="recomendation-posts d-flex flex-column gap-2">
      <h1 class="text-capitalize" style="font-size: var(--fontMobile)">
        recomendation posts
      </h1>
      @foreach($recomendation as $post)
       <div class="post d-flex align-items-center gap-2 justify-content-between">
         <img class="side-post-thumbnail" src="{{ ($post->image != null) ? url($post->image) : 'https://source.unsplash.com/150x150?'.($post->category->name ?? '-') }}" alt="" />
         <div class="detail d-flex flex-column">
           <h1 class="side-post-title my-0">{{ $post->title }}</h1>
           <p class="side-post-title my-0">By <a href="/posts/?author={{ $post->author->username }}">{{ $post->author->name }}</a></p>
         </div>
       </div>
     @endforeach
    </div>
  </div>
</div>
@endsection