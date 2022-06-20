@extends("layouts/main")

@section("container")
 @foreach($posts as $post)
   <article class="mb-3">
     <h1 class="text-capitalize"> 
       <a href="/posts/{{ $post->slug }}">{{ $post->title }} </a>
     </h1>
    <p>Made By <a href="/authors/{{ $post->author->username }}">{{ $post->author->username }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->username }}</a></p>
     <p>{!! $post->excerpt !!} <a class="text-capitalize" href="/posts/{{ $post->slug }}">readmore..</a></p>
   </article>
 @endforeach
@endsection