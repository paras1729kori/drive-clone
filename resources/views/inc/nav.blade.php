<style>
    #icon{
        color: #08417a;
    }

    .link{
        color: #08417a;
    }
</style>

<nav class="navbar sticky-top bg-light navbar-expand-lg mb-3" style="border-bottom: 2px solid #08417a;" id="navbar">
    <a class="navbar-brand" href="/"><img src="{{asset('img/co.jpg')}}" style="border-radius: 8px;" alt="This is an image of logo"></a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        @if (Auth::guest() || auth()->user()->usertype == 'admin')
          <li class="nav-item">
            <a class="nav-link link" href="/important"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Important</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link link" href="/starred"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Starred</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/favourites"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Favourites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/posts"><i id="icon" class="fa fa-comment fa-lg icon" aria-hidden="true" class = "icon"></i> Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/"><i id="icon" class="fa fa-user fa-lg icon" aria-hidden="true" class = "icon"></i> My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/create"><i id="icon" class="fa fa-plus fa-lg icon" aria-hidden="true" class = "icon"></i> Create</a>
        </li>
        @if (Auth::guest() || auth()->user()->usertype == 'admin')
          <li class="nav-item">
            <a class="nav-link link" href="/dashboard"><i id="icon" class="fa fa-lock fa-lg icon" aria-hidden="true"></i> Admin</a>
          </li>
        @endif
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="/search" method="GET">
        <input class="form-control mr-sm-2" name="searching" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  {{-- Button for side bar --}}
  <div class="d-flex flex-row">
  <button class="ml-3 mt-2" id = "sidebar-btn" onclick="openNav()"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>
  
  {{-- for titles on each page --}}
  <h2 class="ml-3 mt-3 ptitle">{{$title ?? ''}}</h2>

  <!-- Small modal -->
<button class="border-0 sbtn ml-auto" data-toggle="modal" data-target=".bd-example-modal-sm">
  <a class="nav-link" href="#" id="searchme"><i id="icon" class="fa fa-search fa-lg icon" aria-hidden="true" class = "icon"></i></a>
</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <form class="form-inline" action="/search" method="GET">
        <input class="form-control" name="searching" style="width:242px;" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary mx-auto" style="width: 100px" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>
</div>
