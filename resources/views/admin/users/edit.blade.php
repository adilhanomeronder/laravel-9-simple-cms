@extends("admin.static.index")
@section("content")
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$data->user_name_surname}} kullanıcısı düzenleniyor...</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/users" class="breadcrumb-item">Üyeler</a>
                        <span class="breadcrumb-item active">Ekle</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <!-- Fieldset legend -->
            <div class="row">
                <div class="col-md-12">

                    <!-- Basic legend -->
                    <div class="card">
                        <div class="card-body">
                            <form class="postForm" action="{{route("admin.users.update",$data->user_id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                                <fieldset>
                                    <div class="form-group">
                                        <label>Adınız Soyadınız</label>
                                        <input type="text" name="name_surname" class="form-control" placeholder="Adınız Soyadınız" value="{{$data->user_name_surname}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Kullanıcı Adınız</label>
                                        <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adınız" value="{{$data->username}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Şifreniz</label>
                                        <input type="password" name="password" class="form-control" placeholder="Şifreniz">
                                    </div>

                                    <div class="form-group">
                                        <label>Şifre Tekrar</label>
                                        <input type="password" name="password_repeat" class="form-control" placeholder="Şifre Tekrar">
                                    </div>

                                    <div class="form-group">
                                        <label>Profil Resmi</label>
                                        <input type="file" name="file" class="form-input-styled" data-fouc="">
                                        <span class="form-text text-muted">Desteklenen Formatlar: png, jpg, jpeg.</span>
                                    </div>

                                    @if($data->image)
                                        <div class="form-group">
                                            <div class="card col-3">
                                                <div class="card-img-actions">
                                                    <img class="card-img-top img-fluid" src="{{asset("assets/images/users/".$data->image)}}" alt="">
                                                    <div class="card-img-actions-overlay card-img-top">
                                                        <a href="{{asset("assets/images/users/".$data->image)}}" target="_blank" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                                            Önizle
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="postInput('admin/users/deletePicture/', {{$data->user_id}}, '{{csrf_token()}}')" class="btn btn-outline bg-white text-white border-white border-2 ml-2">
                                                            Sil
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </fieldset>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Düzenle <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic legend -->
                </div>
            </div>
            <!-- /fieldset legend -->
        </div>
        <!-- /content area -->
@endsection
