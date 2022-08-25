@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$data->title}} kategorisi düzenleniyor...</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/category" class="breadcrumb-item">Kategoriler</a>
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
                            <form class="postForm" action="{{route("admin.category.update",$data->id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                                <fieldset>

                                    <div class="form-group">
                                        <label>SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" placeholder="SEO Title" value="{{$data->seo_title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>SEO Keyw</label>
                                        <input type="text" name="seo_keyw" class="form-control" placeholder="SEO Keyw" value="{{$data->seo_keyw}}">
                                    </div>

                                    <div class="form-group">
                                        <label>SEO DESC</label>
                                        <input type="text" name="seo_desc" class="form-control" placeholder="SEO DESC" value="{{$data->seo_desc}}">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label>Kategori Başlık</label>
                                        <input type="text" name="title" class="form-control" placeholder="Kategori Başlık" required value="{{$data->title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Kategori Kısa İçerik</label>
                                        <input type="text" name="short_content" class="form-control" placeholder="Kısa İçerik" value="{{$data->short_content}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Kategori İçerik</label>
                                        <textarea id="wysiwyg-editor" class="form-control" name="content">{{$data->content}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Kategori Resmi</label>
                                        <input type="file" name="file" class="form-input-styled" data-fouc="">
                                        <span class="form-text text-muted">Desteklenen Formatlar: png, jpg, jpeg.</span>
                                    </div>


                                    @if($data->image)
                                        <div class="form-group">
                                            <div class="card col-3">
                                                <div class="card-img-actions">
                                                    <img class="card-img-top img-fluid" src="{{asset("assets/images/category/".$data->image)}}" alt="">
                                                    <div class="card-img-actions-overlay card-img-top">
                                                        <a href="{{asset("assets/images/category/".$data->image)}}" target="_blank" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                                            Önizle
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="postInput('admin/category/deletePicture/', {{$data->id}}, '{{csrf_token()}}')" class="btn btn-outline bg-white text-white border-white border-2 ml-2">
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
