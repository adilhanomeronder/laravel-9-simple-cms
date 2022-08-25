@extends("admin.static.index")
@section("content")
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"> Sabit Sayfa Listele</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("admin/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/fixedpages" class="breadcrumb-item">Sabit Sayfalar</a>
                        <span class="breadcrumb-item active">Listele</span>
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
                    <!-- Responsive integration -->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <table class="table datatable-basic">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Resim</th>
                                    <th>Başlık</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td><a href="{{asset("assets/images/fixed/".$data->banner)}}" target="_blank">{{$data->banner}}</a></td>
                                        <td><a href="#">{{$data->name}}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /responsive integration -->
                    </div>
                </div>
                <!-- /fieldset legend -->

            </div>
            <!-- /content area -->
@endsection
