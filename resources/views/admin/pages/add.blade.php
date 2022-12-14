@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sayfa Ekle</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/pages" class="breadcrumb-item">Sayfalar</a>
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
                            <form class="postForm" action="{{route("admin.pages.store")}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <fieldset>
                                    <div class="form-group">
                                        <label>SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" placeholder="SEO Title">
                                    </div>

                                    <div class="form-group">
                                        <label>SEO Keyw</label>
                                        <input type="text" name="seo_keyw" class="form-control" placeholder="SEO Keyw">
                                    </div>

                                    <div class="form-group">
                                        <label>SEO DESC</label>
                                        <input type="text" name="seo_desc" class="form-control" placeholder="SEO DESC">
                                    </div>

                                    <hr>


                                    <div class="form-group">
                                        <label>Sayfa Ba??l??k</label>
                                        <input type="text" name="title" class="form-control" placeholder="Page Title">
                                    </div>

                                    <div class="form-group">
                                        <label>Sayfa Desc</label>
                                        <input type="text" name="description" class="form-control" placeholder="Sayfa Desc">
                                    </div>

                                    <div class="form-group">
                                        <textarea id="wysiwyg-editor" class="form-control" name="content"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Sayfa Resmi</label>
                                        <input type="file" name="file" class="form-input-styled" data-fouc="">
                                        <span class="form-text text-muted">Desteklenen Formatlar: png, jpg, jpeg.</span>
                                    </div>

                                </fieldset>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ekle <i class="icon-paperplane ml-2"></i></button>
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
