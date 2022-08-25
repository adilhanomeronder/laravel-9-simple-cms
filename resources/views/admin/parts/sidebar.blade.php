<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{asset("assets/images/users/profil.png")}}" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{session("login_user.user_name_surname")}}</div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{url("/admin")}}" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>
                        Anasayfa
                    </span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-files-empty"></i> <span>Sayfalar</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/pages/create" class="nav-link">Sayfa Ekle</a></li>
                        <li class="nav-item"><a href="admin/pages/" class="nav-link">Sayfa Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-user"></i> <span>Üyeler</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/users/create" class="nav-link">Üye Ekle</a></li>
                        <li class="nav-item"><a href="admin/users/" class="nav-link">Üye Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-menu"></i> <span>Menüler</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/menus/create" class="nav-link">Menü Ekle</a></li>
                        <li class="nav-item"><a href="admin/menus/" class="nav-link">Menü Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-comment"></i> <span>Yorumlar</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/comments/create" class="nav-link">Yorum Ekle</a></li>
                        <li class="nav-item"><a href="admin/comments/" class="nav-link">Yorum Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-box"></i> <span>Ürünler</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/products/create" class="nav-link">Ürün Ekle</a></li>
                        <li class="nav-item"><a href="admin/products/" class="nav-link">Ürün Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-question3"></i> <span>S.S.S</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/faq/create" class="nav-link">S.S.S Ekle</a></li>
                        <li class="nav-item"><a href="admin/faq/" class="nav-link">S.S.S Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-gallery"></i> <span>Galeri</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/gallery/create" class="nav-link">Resim Ekle</a></li>
                        <li class="nav-item"><a href="admin/gallery/" class="nav-link">Resim Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-blog"></i> <span>Blog</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/blog/create" class="nav-link">Blog Ekle</a></li>
                        <li class="nav-item"><a href="admin/blog/" class="nav-link">Blog Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-folder"></i> <span>Kategori</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/category/create" class="nav-link">Kategori Ekle</a></li>
                        <li class="nav-item"><a href="admin/category/" class="nav-link">Kategori Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-cog"></i> <span>Hizmetler</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/service/create" class="nav-link">Hizmet Ekle</a></li>
                        <li class="nav-item"><a href="admin/service/" class="nav-link">Hizmet Listele</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-cogs"></i> <span>Ayarlar</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="admin/setting/contact" class="nav-link">İletişim Ayarları</a></li>
                        <li class="nav-item"><a href="admin/setting/social" class="nav-link">Sosyal Medya Ayarları</a></li>
                        <li class="nav-item"><a href="admin/fixedpages" class="nav-link">Sabit Sayfa Ayarları</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->


    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar -->
