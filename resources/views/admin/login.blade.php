<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel Girişi</title>

    <!-- Global stylesheets -->
    <link href="{{asset("assets/css/roboto-font.css?family=Roboto:400,300,100,500,700,900")}}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/vendor/icons/icomoon/styles.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/bootstrap_limitless.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/vendor/sweetalert/dist/sweetalert.css")}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset("assets/vendor/main/jquery.min.js")}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset("assets/vendor/main/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/vendor/sweetalert/dist/sweetalert.min.js")}}"></script>
    <script src="{{asset("assets/js/custom.js")}}"></script>
    <!-- /core JS files -->
</head>

<body>

<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login card -->
            <form class="login-form postForm" action="{{route("login.check")}}" method="POST">
                {{csrf_field()}}
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-car icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">LARAVEL ADMIN PANEL</h5>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adınız">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" name="password" class="form-control" placeholder="Şifreniz">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Giriş Yap <i class="icon-circle-right2 ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /login card -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>

