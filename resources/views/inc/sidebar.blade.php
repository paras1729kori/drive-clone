<style>
    .links{
        color: #08417a;
        font-size:18px;
    }

    .cir{
      border-radius:0px 30px 30px 0px;
    }
</style>


<!-- Sidebar -->
<div id="sidebar-wrapper">
    <div class="list-group list-group-flush" id="sidenav">
        <a href="javascript:void(0)" class="closebtn close mt-2" onclick="closeNav()">&times;</a>
        <a class="navbar-brand mt-0" href="/"><img src="{{asset('img/mob.jpg')}}" alt=""></a>
        
        @if (Auth::guest() || auth()->user()->usertype == 'admin')
            <a class="nav-link links" href="/important"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Important</a>
        @endif
        <a class="nav-link links" href="/starred"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Starred</a>
        <a class="nav-link links" href="/favourites"><i id="icon" class="fa fa-folder fa-lg icon" aria-hidden="true"></i> Favourites</a>
        <a class="nav-link links" href="/posts"><i id="icon" class="fa fa-comment fa-lg icon" aria-hidden="true"></i> Messages</a>        
        <a class="nav-link links" href="/"><i id="icon" class="fa fa-user fa-lg icon" aria-hidden="true"></i> My Account</a>
        {{-- <a class="nav-link links" href="/create"><i id="icon" class="fa fa-plus fa-lg icon" aria-hidden="true"></i> Create</a> --}}

        @if (Auth::guest() || auth()->user()->usertype == 'admin')
            <a class="nav-link links" href="/dashboard"><i id="icon" class="fa fa-lock fa-lg icon" aria-hidden="true"></i> Admin</a>
        @endif
    </div>
  </div>
  <!-- /#sidebar-wrapper -->
  