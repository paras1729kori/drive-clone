<style>
    #icon{
        color: #08417a;
    }

    .link{
        color: #08417a;
    }
</style>

<nav class="navbar navbar-expand-lg mt-2" id="navbar">
    <a class="navbar-brand" href="/home"><img src="{{asset('img/co.jpg')}}" alt="This is an image of logo"></a>
  
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link link" href="/create"><i id="icon" class="fa fa-plus fa-lg icon" aria-hidden="true" class = "icon"></i> Create</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/home"><i id="icon" class="fa fa-home fa-lg icon" aria-hidden="true" class = "icon"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link" href="/"><i id="icon" class="fa fa-user fa-lg icon" aria-hidden="true" class = "icon"></i> Dashboard</a>
        </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="/search" method="GET">
        <input class="form-control mr-sm-2" name="searching" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  
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
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form class="form-inline" action="/search" method="GET">
        <input class="form-control" name="searching" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary ml-auto" style="width: 115px" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>
</div>
