@extends("admin.static.index")
@section("content")
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"> Hizmet Listele</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("admin/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/service" class="breadcrumb-item">Hizmetler</a>
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
                                    <th>Title</th>
                                    <th>Durum</th>
                                    <th class="text-center">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td><a href="{{asset("assets/images/service/".$data->image)}}" target="_blank">{{$data->image}}</a></td>
                                        <td>{{$data->title}}</td>
                                        <td>
                                            @if($data->status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-warning">Pasif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false">İşlemler</button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             x-placement="bottom-end"
                                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-72px, 36px, 0px);">
                                                            <a href="admin/service/{{$data->id}}/edit" class="dropdown-item"><i class="fas fa-edit"></i> Düzenle</a>
                                                            <a href="javascript:void(0)" onclick="postInput('admin/service/status/', {{$data->id}}, '{{csrf_token()}}')" class="dropdown-item"><i class="fas fa-toggle-on"></i>Aktif / Pasif</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="postInput('admin/service/{{$data->id}}/', {{$data->id}}, '{{csrf_token()}}', 'DELETE')"><i class="fas fa-trash"></i>
                                                                Sil</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
