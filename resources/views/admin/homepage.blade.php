@extends("admin.static.index")
@section("content")
<!-- Main content -->
<div class="content-wrapper">
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                <span class="breadcrumb-item active">Ana Ekran</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
    <center><h4>Yönetim Paneline Hoşgeldiniz. <br> Yönetim paneli üzerinden web sitenizde ki tüm alanları kontrol edebilirsiniz.</h4></center>
</div>
<!-- /content area -->
@endsection
