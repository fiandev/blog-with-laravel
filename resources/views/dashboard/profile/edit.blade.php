@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">profile</h1>
</div>
<div class="col-md-10 col-lg-8">
  @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  @if(session("info"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      {{ session("info") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  <form class="p-2" action="/dashboard/profile" method="post" accept-charset="utf-8" class="text-capitalize" enctype="multipart/form-data">
    @csrf
    <input type="file" class="d-none" name="photo" id="photo" value="" />
    <div style="width: 12rem; height: 12rem" class="profile-frame border rounded mb-3 position-relative">
      <img data-src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" id="preview" style="height: 100%;width:100%" class="rounded-circle" src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" alt="{{ auth()->user()->name }}`s photo" />
      <label for="photo" class="rounded-circle position-absolute d-flex justify-content-center " style="bottom:0;right:0">
        <i class="fa fa-pencil fs-3"></i>
      </label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="john doe" value="{{ auth()->user()->name }}">
      <label for="floatingInput">name</label>
      @error("name")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->username }}">
      <label for="floatingInput">username</label>
      @error("username")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->email }}">
      <label for="floatingInput">Email</label>
      @error("email")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">update profile</button>
  </form>
</div>
@endsection

@section("script")
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
  $("#photo").on("change", function (event){
    var files = event.target.files,
                file;
   if (files && files.length > 0) {
     file = files[0]
     try {
       let fileReader = new FileReader();
       let dataSrc = $("#preview").attr("data-src")
       fileReader.onload = function (e) {
         $("#preview").attr("src", e.target.result)
         console.log(e.target.result);
       };
       fileReader.readAsDataURL(file);
     } catch (e) {
       console.log("FileReader are not supported ");
     }
   }
   else {
     let dataSrc = $("#preview").attr("data-src")
     $("#preview").attr("src", dataSrc)
   }
  })
})
</script>

@endsection