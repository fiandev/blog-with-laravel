<header class="navbar navbar-dark sticky-top bg-dark d-flex align-items-center flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-flex gap-1 align-items-center" href="{{ url('dashboard/') }}/profile">
    <span data-feather="user" class="avatar-dashboard"></span>
    {{ auth()->user()->username }}
    </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>