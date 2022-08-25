@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$data->title}} blog düzenleniyor...</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/blog" class="breadcrumb-item">Bloglar</a>
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
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item"><a href="#edit" class="nav-link active" data-toggle="tab">Düzenle</a></li>
                                <li class="nav-item"><a href="#pictures" class="nav-link" data-toggle="tab">Resimler</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="edit">
                                    <form class="postForm" action="{{route("admin.blog.update",$data->id)}}" method="POST" enctype="multipart/form-data">
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
                                                <label>Blog Başlık</label>
                                                <input type="text" name="title" class="form-control" placeholder="Blog Başlık" value="{{$data->title}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Blog Kısa Açıklama</label>
                                                <input type="text" name="short_content" class="form-control" placeholder="Blog Kısa Açıklama" value="{{$data->short_content}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Blog Açıklama</label>
                                                <textarea id="wysiwyg-editor" class="form-control" name="content">{{$data->content}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Blog Etiketler</label>
                                                <input type="text" name="tags" class="form-control" placeholder="tags,tags,tags..." value="{{$data->tags}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Blog Kategori</label>
                                                <input type="text" name="category" class="form-control" placeholder="Exm: holiday" value="{{$data->category}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Ürün Resimleri (Multiple)</label>
                                                <input type="file" name="file[]" class="form-input-styled" data-fouc="" multiple>
                                                <span class="form-text text-muted">Desteklenen Formatlar: png, jpg, jpeg.</span>
                                            </div>

                                        </fieldset>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Düzenle <i class="icon-paperplane ml-2"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pictures">
                                    <div class="form-group">
                                        @if(count($images))
                                            <div id="sortable" class="row" data-url="admin/blog/sortable" data-csrf="{{csrf_token()}}">
                                                @foreach($images as $image)
                                                    <div class="card col-3" id="{{$image->id}}">
                                                        <div class="card-img-actions">
                                                            <img class="card-img-top img-fluid" src="{{asset("assets/images/blog/".$image->image)}}" alt="">
                                                            <div class="card-img-actions-overlay card-img-top">
                                                                <a href="{{asset("assets/images/blog/".$image->image)}}" target="_blank" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                                                                    Önizle
                                                                </a>
                                                                <a href="javascript:void(0)" onclick="postInput('admin/blog/deletePicture/', {{$image->id}}, '{{csrf_token()}}')" class="btn btn-outline bg-white text-white border-white border-2 ml-2">
                                                                    Sil
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic legend -->
                </div>
            </div>
            <!-- /fieldset legend -->

        </div>
        <!-- /content area -->
@endsection
