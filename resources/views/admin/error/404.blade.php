@extends("admin.static.index")
@section("content")
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Container -->
        <div class="flex-fill">

            <!-- Error title -->
            <div class="text-center mb-4">
                <img src="{{asset("assets/images/error_bg.svg")}}" class="img-fluid mb-3" height="230" alt="404">
                <h1 class="display-2 font-weight-semibold line-height-1 mb-2">404</h1>
                <h6 class="w-md-25 mx-md-auto">Aradığınız sayfa bulunamadı. Lütfen url adresinizi kontrol ediniz.</h6>
            </div>
            <!-- /error title -->


            <!-- Error content -->
            <div class="text-center">
                <a href="{{{url("/admin/")}}}" class="btn btn-primary"><i class="icon-home4 mr-2"></i> Anasayfa'ya Dön</a>
            </div>
            <!-- /error wrapper -->

        </div>
        <!-- /container -->

    </div>
    </div>
@endsection
