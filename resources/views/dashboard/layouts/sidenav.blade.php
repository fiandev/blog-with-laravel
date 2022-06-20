    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky">
        <h6 class="sidebar-heading d-flex justify-content-start gap-2 align-items-center px-3 mt-4 mb-2 text-muted">
            Menu
          </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is("dashboard") ? "active" : ""}}" aria-current="page" href="/dashboard/">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is("dashboard/posts*") ? "active" : ""}}" href="/dashboard/posts">
              <span data-feather="file-text"></span>
              posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is("dashboard/profile*") ? "active" : ""}}" aria-current="page" href="{{ url('/dashboard') }}/profile">
              <span data-feather="user"></span>
              Profile
            </a>
          </li>
           <li class="nav-item">
            <form class="nav-link" action="/logout/" method="post" accept-charset="utf-8">
              @csrf
              <button type="submit" class="p-0 border-0 bg-light">
                <i data-feather="log-out"></i>
                logout
              </button>
            </form>
          </li>
        </ul>
        @can("admin")
          <h6 class="sidebar-heading d-flex justify-content-start gap-2 align-items-center px-3 mt-4 mb-2 text-muted">
            Administrator
          </h6>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ Request::is("dashboard/categories*") ? "active" : ""}}" aria-current="page" href="{{ url('/dashboard') }}/categories">
                <span data-feather="grid"></span>
                Categories
              </a>
            </li>
          </ul>
        @endcan
      </div>
    </nav>