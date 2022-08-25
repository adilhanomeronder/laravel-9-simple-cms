<!DOCTYPE html>
<html lang="tr">
<head>
<base href="{{url("/")}}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SIMPLE CMS PANEL</title>
<meta name="keywords" content="SIMPLE CMS PANEL">
<meta name="description" content="SIMPLE CMS PANEL">
<!-- Global stylesheets -->
<link href="{{asset("assets/css/roboto-font.css?family=Roboto:400,300,100,500,700,900")}}" rel="stylesheet" type="text/css">
<link href="{{"assets/vendor/icons/icomoon/styles.min.css"}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/all.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/bootstrap_limitless.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/layout.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/components.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/colors.min.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/vendor/sweetalert/dist/sweetalert.css")}}" rel="stylesheet" type="text/css">
<link href="{{asset("assets/css/custom.css")}}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="{{asset("assets/vendor/main/jquery.min.js")}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{asset("assets/vendor/main/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/js/app.js")}}"></script>
<!-- /core JS files -->
<script src="{{asset("assets/vendor/plugins/tables/datatables/datatables.min.js")}}"></script>
<script src="{{asset("assets/js/datatables_basic.js")}}"></script>
</head>
<body>

@include("admin.parts.navbar")

<!-- Page content -->
<div class="page-content">
    @include("admin.parts.sidebar")
        @yield("content")
    @include("admin.parts.footer")
</div>
<!-- /page content -->


<script src="{{asset("assets/vendor/sweetalert/dist/sweetalert.min.js")}}"></script>
<script src="{{asset("assets/vendor/plugins/editors/ckeditor/ckeditor.js")}}"></script>
<script src="{{asset("assets/vendor/plugins/forms/styling/uniform.min.js")}}"></script>
<script src="{{asset("assets/js/form_layouts.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('wysiwyg-editor', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
</body>
</html>
