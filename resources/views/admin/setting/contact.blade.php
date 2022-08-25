@extends("admin.static.index")
@section("content")
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">İletişim Ayarları</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url("/")}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                        <a href="admin/setting/contact" class="breadcrumb-item">İletişim Ayarları</a>
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
                            <form class="postForm" action="{{route("admin.setting.contactStore")}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <fieldset>
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">
                                                    Tip
                                                </th>
                                                <th class="text-center">
                                                    Değer
                                                </th>
                                                <th class="text-center">
                                                    Sil
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if(!empty($datas))
                                            @foreach($datas as $data)
                                            <tr>
                                                <td class='text-center'>
                                                    <select class="form-control" name="type[]" id="tip">
                                                        <option <?=($data["type"] == 1) ? "selected" : ""?> value="1">
                                                            Telefon</option>
                                                        <option <?=($data["type"] == 4) ? "selected" : ""?> value="4">GSM
                                                        </option>
                                                        <option <?=($data["type"] == 2) ? "selected" : ""?> value="2">
                                                            Adres</option>
                                                        <option <?=($data["type"] == 3) ? "selected" : ""?> value="3">
                                                            Email</option>
                                                    </select>
                                                </td>
                                                <td class='text-center'>
                                                    <input class="form-control" type="text" name="value[]"
                                                           value="<?=$data["value"]?>">
                                                </td>
                                                <td class='text-center'>
                                                    <span class="delete-table-row">X</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                                <tr id='addr0'>
                                                    <td class='text-center'>
                                                        <select class="form-control" name="type[]" id="tip">
                                                            <option value="1">Telefon</option>
                                                            <option value="4">GSM</option>
                                                            <option value="2">Adres</option>
                                                            <option value="3">Email</option>
                                                        </select>
                                                    </td>
                                                    <td class='text-center'>
                                                        <input class="form-control" type="text" name="value[]">
                                                    </td>
                                                    <td class='text-center'>
                                                        <span>X</span>
                                                    </td>
                                                </tr>
                                            @endif

                                            </tbody>
                                        </table>
                                        <a id="table_add_row" class="btn btn-primary text-white mt-2"><i class="fa fa-add"></i> Satır Ekle</a>
                                    </div>
                                </fieldset>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Güncelle <i class="icon-paperplane ml-2"></i></button>
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
