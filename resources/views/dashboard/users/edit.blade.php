@extends("dashboard.main")

@section("container")
<div class="d-flex justify-content-start flex-column flex-wrap flex-md-nowrap align-items-start pt-3 pb-2 mb-3 border-bottom">
  <h1 class="fs-5 text-capitalize">
    edit profile {{ $user->name }}
  </h1>
  <div class="d-flex justify-content-start gap-2">
    <button class="btn d-flex gap-2 justify-content-center align-items-center btn-outline-info" type="button">
      <i class="fa fa-arrow-left"></i>
      <a href="{{ url('/dashboard/users') }}">back</a>
    </button>
      <form action="/dashboard/users/{{ $user->slug }}" method="post" accept-charset="utf-8">
        @method("delete")
        @csrf
        <button type="submit" onclick="return confirm('are you sure ?, user with name {{ $user->name }} will be delete!')" class=" btn d-flex gap-2 justify-content-center align-items-center btn-outline-danger">
          <i class="fa fa-trash"></i>
          delete
        </button>
      </form>
  </div>
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
  @if(session("error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session("error") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  <form id="form" class="p-2" action="/dashboard/users/{{ $user->slug }}" method="post" accept-charset="utf-8" class="text-capitalize" enctype="multipart/form-data">
    @csrf
    @method("put")
    <input type="file" class="d-none" name="photo" id="photo" value="" />
    <div style="width: 12rem; height: 12rem" class="profile-frame border rounded mb-3 position-relative">
      <img data-src="{{ $user->photo ? url($user->photo) : url('post-images/no-pp.jpg') }}" id="preview" style="height: 100%;width:100%" class="rounded-circle" src="{{ $user->photo ? url($user->photo) : url('post-images/no-pp.jpg') }}" alt="" />
      <label for="photo" class="rounded-circle position-absolute d-flex justify-content-center " style="bottom:0;right:0">
        <i class="fa fa-pencil fs-3"></i>
      </label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="john doe" value="{{ old('name') ?? $user->name }}">
      <label for="floatingInput">name</label>
      @error("name")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ old('username') ?? $user->username }}">
      <label for="floatingInput">username</label>
      @error("username")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ old('email') ?? $user->email }}">
      <label for="floatingInput">Email</label>
      @error("email")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <select id="rolesSelect" class="form-control" multiple name="roles[]" id="roles">
        
        @foreach($roles as $role)
         <!-- each user roles -->
          @if(hasRole($user->roles, $role))
            <option value="{{ $role->id }}" selected>
              {{ $role->name }}
            </option>
          @else
            <option value="{{ $role->id }}">
              {{ $role->name }}
            </option>
          @endif
        @endforeach
      </select>
      <label for="floatingInput">roles</label>
      @error("roles")
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
@if($user->id === auth()->user()->id)
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  $("#rolesSelect").on("change", function() {
    let roles = $(this).val()
    let allRoles = ["administrator", "moderator", "member"]
    /* all missing */
    if (!roles.includes("1") && !roles.includes("2") && !roles.includes("3")) {
       return myConfirm("shit, really?", "<b>{{ auth()->user()->id === $user->id ? 'you' : $user->name }}</b> will lose all roles!")
    }
    for (var i = 1; i <= allRoles.length; i++) {
      let role = allRoles[i - 1]
      if (!roles.includes(`${i}`)) {
        return myConfirm("are you sure?", `<b>{{ auth()->user()->id === $user->id ? 'you' : $user->name }}</b> will lose ${role} roles!`)
      }
    }
  })
</script>
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
<script src='//cdn.jsdelivr.net/npm/eruda'></script>
  <script>eruda.init();</script>
@endsection