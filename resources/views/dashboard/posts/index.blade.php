@extends("dashboard.main")

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total posts ({{ $posts->count() }}) !</h1>
   <a href="/dashboard/posts/create/" class="btn btn-primary mb-3">create new post</a>
</div>
  @if($posts->count() >= 1)
<div class="table-responsive">
  @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td class="d-flex gap-1">
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-primary"><span data-feather="edit"></span></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" accept-charset="utf-8">
              @method("delete")
              @csrf
              <button type="submit" class="badge bg-danger border-0" onclick="return confirm('are you sure?')">
                <i data-feather="x-circle"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  @else
  @include("partials.no-post")
  @endif
  <!-- pagination-->
  <div class="overflow-scroll d-flex justify-content-center">
    {{ $posts->onEachSide(0)->links() }}
  </div>
  <!-- end pagination-->
@endsection