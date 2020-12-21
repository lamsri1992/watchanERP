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
                    <table id="hr_table" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="15%"><i class="far fa-address-card"></i> ID</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th width="25%">ตำแหน่ง</th>
                                <th width="20%">กลุ่มงาน/หน่วยบริการ</th>
                                <th width="10%"><i class="fa fa-search"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="15%"><i class="far fa-address-card"></i> ID</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th width="25%">ตำแหน่ง</th>
                                <th width="20%">กลุ่มงาน/หน่วยบริการ</th>
                                <th width="10%"><i class="fa fa-search"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Modal -->
<div class="modal fade" id="hrModal" tabindex="-1" role="dialog" aria-labelledby="hrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="hrModalLabel"></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-sm">
                <tr>
                    <th>ชื่อ - สกุล</th>
                    <td id="name"></td>
                </tr>
                <tr>
                    <th>ตำแหน่ง</th>
                    <td id="position"></td>
                </tr>
                <tr>
                    <th>กลุ่มงาน/หน่วยบริการ</th>
                    <td id="dept_name"></td>
                </tr>
                <tr>
                    <th>ประเภทบุคลากร</th>
                    <td id="job_name"></td>
                </tr>
                <tr>
                    <th>ที่อยู่</th>
                    <td id="address"></td>
                </tr>
                <tr>
                    <th>เบอร์โทร</th>
                    <td id="tel"></td>
                </tr>
                <tr>
                    <th>ผู้ติดต่อยามฉุกเเฉิน</th>
                    <td id="person_name"></td>
                </tr>
                <tr>
                    <th>เบอร์โทรผู้ติดต่อ</th>
                    <td id="person_tel"></td>
                </tr>
                <tr>
                    <th>ที่อยู่ผู้ติดต่อ</th>
                    <td id="person_address"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">ปิดหน้าต่าง</button>
        </div>
      </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#hr_table').dataTable( {
        ajax: {
            url: "api/hr_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'barcode', className: "text-center" },
            { 'data': 'name' },
            { 'data': 'position' },
            { 'data': 'dept_name', className: "text-center" },
            { 'targets': -1, 'data': null, className: "text-center", 'defaultContent': '<button class="btn btn-sm btn-primary">เพิ่มเติม</button>'}
        ],
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        oLanguage: {
            sSearch: "ค้นหา : ",
        },
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
    });

    var table = $('#hr_table').DataTable();
    $('#hr_table tbody').on('click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        // alert(data['name']);
        $("#hrModalLabel").text(data['barcode']);
        $("#name").text(data['name']);
        $("#position").text(data['position']);
        $("#dept_name").text(data['dept_name']);
        $("#job_name").text(data['job_name']);
        $("#address").text(data['address']);
        $("#tel").text(data['tel']);
        $("#person_name").text(data['person_name']);
        $("#person_tel").text(data['person_tel']);
        $("#person_address").text(data['person_address']);
        $("#hrModal").modal("show");
    });
});
</script>
@endsection
