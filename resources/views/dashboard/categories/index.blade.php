@extends("dashboard.main")

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total categories ({{ $categories->count() }}) !</h1>
   <a id="btnAddCategory" ref="/dashboard/categories/create/" class="btn btn-primary mb-3">create new category</a>
   <form id="addCategory" action="{{ url()->current() }}" method="post" accept-charset="utf-8" class="d-flex gap-1 d-none col-md-8 col-lg-9">
     @csrf
     <input class="form-control" placeholder="write new category" type="text" name="category_id" id="category" value="" />
     <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit">add</button>
   </form>
</div>
  @if($categories->count() >= 1)
<div class="col-md-8 col-lg-9">
  <div class="table-responsive">
  @if(session()->has("error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session("error") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @error("category_id")
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @enderror
    
    @if(session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">name</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>
             <form action="/dashboard/categories/{{ $category->slug }}" method="post" accept-charset="utf-8">
              @method("put")
              @csrf
              <input class="border input-update-categories" type="text" name="category_id" id="category_id" value="{{ $category->name }}" />
            </form>
          </td>
          
          <td class="d-flex gap-1">
            <a href="/posts?category={{ $category->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
            <form action="/dashboard/categories/{{ $category->slug }}" method="post" accept-charset="utf-8">
              @method("delete")
              @csrf
              <button type="submit" class="badge bg-danger border-0" onclick="return confirm('are you sure ?, category {{ $category->name }} will be delete!')">
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
    {{ $categories->onEachSide(0)->links() }}
  </div>
  <!-- end pagination-->
</div>
@endsection

@section("script")
<script src="{{ url('js')}}/dash-category.js" type="text/javascript" charset="utf-8"></script>
@endsection