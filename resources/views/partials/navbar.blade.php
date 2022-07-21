  <nav class="shadow navbar navbar-expand-lg navbar-dark bg-info mb-2">
      <div class="container">
        <a class="navbar-brand" href="/">MyBlog</a>
        <button class="navbar-toggler mx-2 my-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex justify-content-between text-capitalize" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ ( Request::is('home*') || Request::is('/') ) ? 'active' : ''}}" href="/home/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ( Request::is('about*') ) ? 'active' : ''}}" href="/about/">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ( Request::is('posts*') || Request::is('blog*') ) ? 'active' : ''}}" href="/blog/">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ( Request::is('categories*') ) ? 'active' : ''}}" href="/categories/">categories</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            @auth
              <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  welcome back, {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu text-capitalize" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="/dashboard/"><i class="fa fa-table-columns"></i> my dashboard</a>
                    </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form action="/logout/" method="post" accept-charset="utf-8">
                      @csrf
                      <button class="dropdown-item" type="submit">
                        <i class="fa fa-sign-out"></i>
                        logout
                      </button>
                    </form>
                </ul>
            </li>
            @else
                <li class="nav-item">
                  <a class="nav-link {{ ( Request::is('login*') ) ? 'active' : ''}}" href="/login/">
                    <i class="fa fa-login"></i>
                    login
                  </a>
                </li>
            @endauth
          </ul>
          <form action="/posts/" class="d-flex gap-2  ms-auto d-lg-none" role="search">
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
      </div>
    </nav>
    