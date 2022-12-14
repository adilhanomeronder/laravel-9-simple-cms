@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Ürün Ekle</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/products" class="breadcrumb-item">Ürünler</a>
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
                            <form class="postForm" action="{{route("admin.products.store")}}" method="POST" enctype="multipart/form-data">
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
                                        <label>Ürün Başlık</label>
                                        <input type="text" name="name" class="form-control" placeholder="Ürün Başlık">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün SKU</label>
                                        <input type="text" name="sku" class="form-control" placeholder="Ürün SKU">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün Kısa Açıklama</label>
                                        <input type="text" name="short_content" class="form-control" placeholder="Ürün Kısa Açıklama">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün Açıklama</label>
                                        <textarea id="wysiwyg-editor" class="form-control" name="content"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün Fiyat</label>
                                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Ürün Fiyat">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün İndirim </label>
                                        <input type="number" name="discount" class="form-control" placeholder="Ürün İndirim">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün Stok </label>
                                        <input type="number" name="stock" class="form-control" placeholder="Ürün Stok">
                                    </div>

                                    <div class="form-group">
                                        <label>Ürün Resimleri (Multiple)</label>
                                        <input type="file" name="file[]" class="form-input-styled" data-fouc="" multiple>
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
