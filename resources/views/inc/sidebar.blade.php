<style>
    #icon{
        color: #08417a;
    }

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
    <div class="list-group list-group-flush bg-light" id="sidenav">
        <a href="javascript:void(0)" class="closebtn close mt-2" onclick="closeNav()">&times;</a>
        <a class="navbar-brand mt-0" href="/"><img src="{{asset('img/mob.jpg')}}" alt=""></a>
        
        <a class="nav-link links" href="/create"><i id="icon" class="fa fa-plus fa-lg icon" aria-hidden="true" class = "icon"></i> Create</a>
        <a class="nav-link links" href="/dash"><i id="icon" class="fa fa-home fa-lg icon" aria-hidden="true" class = "icon"></i> Dashboard</a>
        <a class="nav-link links" href="/acc"><i id="icon" class="fa fa-user fa-lg icon" aria-hidden="true" class = "icon"></i> Home</a>

    </div>
  </div>
  <!-- /#sidebar-wrapper -->
  