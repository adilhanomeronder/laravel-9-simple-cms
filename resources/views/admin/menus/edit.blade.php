@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$data->title}} menüsü düzenleniyor...</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/menus" class="breadcrumb-item">Menüler</a>
                        <span class="breadcrumb-item active">Düzenle</span>
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
                            <form class="postForm" action="{{route("admin.menus.update",$data->id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                                <fieldset>
                                    <div class="form-group">
                                        <label>Üst Menü</label>
                                        <select name="parent_id" class="form-control" required>
                                            <option value="0">Ana Menü Olsun</option>
                                            {{!! $menus !!}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipi</label>
                                        <select name="type" class="form-control" required>
                                            <option value="0" {{$data->type == 0 ? "selected" : ""}}>Header Menü</option>
                                            <option value="1" {{$data->type == 1 ? "selected" : ""}}>Footer Menü</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Başlığı</label>
                                        <input type="text" class="form-control" name="title" value="{{$data->title}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Bağlantı Seçenekleri</label>
                                        <select name="hrefTypes" class="form-control">
                                            <option value="0">Link verme seçeneğini belirleyin !</option>
                                            <option value="manuel">Manuel Gireceğim</option>
                                            <option value="sayfalar" >Sayfaları Göster</option>
                                            <option value="bloglar" >Blogları Göster</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="hrefSayfalar" style="display:none">
                                        <label for="input-text" class="col-sm-2 control-label">Menü Linki Belirleyin</label>
                                        <div class="col-sm-9">
                                            <select name="href" class="form-control"  disabled>
                                                <option value="0">Sayfa Seçin !</option>
                                                @foreach($pages as $page)
                                                    <option value="">{{$page->page_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="hrefHizmetler" style="display:none">
                                        <label for="input-text" class="col-sm-2 control-label">Menü Linki Belirleyin</label>
                                        <div class="col-sm-9">
                                            <select name="href" class="form-control"  disabled>
                                                <option value="0">Hizmet Seçin !</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="hrefManuel">
                                        <label for="input-text" class="col-sm-2 control-label">Menü Linki Belirleyin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="href" placeholder="Örn : http://www.google.com.tr/" value="{{$data->href}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Target</label>
                                        <select class="form-control" name="target" id="target">
                                            <option value="0">Self Olarak Açılsın</option>
                                            <option value="1">Yeni Sekme Olarak Açılsın</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>İcon</label>
                                        <input type="file" name="file" class="form-input-styled" data-fouc="">
                                        <span class="form-text text-muted">Desteklenen Formatlar: png, jpg, jpeg.</span>
                                    </div>

                                    @if($data->icon)
                                        <div class="form-group">
                                            <div class="card col-3">
                                                <div class="card-img-actions">
                                                    <img class="card-img-top img-fluid" src="{{asset("assets/images/menu/".$data->icon)}}" alt="">
                                                    <div class="card-img-actions-overlay card-img-top">
                                                        <a href="{{asset("assets/images/menu/".$data->icon)}}" target="_blank" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                                            Önizle
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="postInput('admin/menus/deletePicture/', {{$data->id}}, '{{csrf_token()}}')" class="btn btn-outline bg-white text-white border-white border-2 ml-2">
                                                            Sil
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </fieldset>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Güncele <i class="icon-paperplane ml-2"></i></button>
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
