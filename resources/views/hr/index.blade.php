@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="fa fa-database"></i> HR DATABASE
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-folder-open"></i> งานบริหารทั่วไป
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ฐานข้อมูลบุคลากร</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">Barcode</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th width="25%">ตำแหน่ง</th>
                                <th width="20%">กลุ่มงาน/หน่วยบริการ</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').dataTable( {
        ajax: {
            url: "http://127.0.0.1:8000/api/hr_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'id' },
            { 'data': 'barcode' },
            { 'data': 'name' },
            { 'data': 'position' },
            { 'data': 'dept_name' },
        ],
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        oLanguage: {
            sSearch: "ค้นหา : ",
        }
    });
});
</script>
@endsection
