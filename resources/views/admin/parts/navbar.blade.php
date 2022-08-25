<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-user"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
            <li class="nav-item dropdown"></li>
        </ul>


        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset("assets/images/users/profil.png")}}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{session("login_user.user_name_surname")}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="admin/users/{{session("login_user.user_id")}}/edit" class="dropdown-item"><i class="icon-user-plus"></i> Profilim</a>
                    <a href="admin/logout" class="dropdown-item"><i class="icon-switch2"></i> Çıkış Yap</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
