@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="far fa-clock"></i> Time attendance record
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-folder-open"></i> งานบริหารทั่วไป
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ระบบบันทึกเวลาเข้างาน</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="header-body">
                        @php $curdate = date('Y-m-d'); @endphp
                        <h1><i class="fa fa-calendar-day"></i> {{ FullDateTimeThai($curdate) }}</h1>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">เข้างานปกติ</h5>
                                                <span class="h2 font-weight-bold mb-0">?? คน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">เข้างานสาย</h5>
                                                <span class="h2 font-weight-bold mb-0">?? คน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-calendar-times"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">ขาดงาน</h5>
                                                <span class="h2 font-weight-bold mb-0">?? คน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">ไปราชการ</h5>
                                                <span class="h2 font-weight-bold mb-0">?? คน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="time_table" class="table display responsive nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>WID</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ตำแหน่ง</th>
                                <th>ฝ่าย/งาน</th>
                                <th><i class="far fa-clock"></i> เวลาเข้างาน</th>
                            </tr>
                        </thead>
                        <tfoot class="thead-dark">
                            <tr>
                                <th>WID</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ตำแหน่ง</th>
                                <th>ฝ่าย/งาน</th>
                                <th><i class="far fa-clock"></i> เวลาเข้างาน</th>
                            </tr>
                        </tfoot>
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
        $('#time_table').dataTable( {
        ajax: {
            url: "api/time_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'work_id', className: "text-center" },
            { 'data': 'name' },
            { 'data': 'position' },
            { 'data': 'dept_name' },
            { 'data': 'work_time', className: "text-center"  },
        ],
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        oLanguage: {
            sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
        },
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        order: [[ 4, 'desc' ]],
        oLanguage: {
                 oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
        },
         initComplete: function() {
            this.api().columns([2,3]).every(function() {
                var column = this;
                var select = $(
                        '<select class=""><option value="">แสดงทั้งหมด</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.cells('', column[0]).render('display').sort().unique().each(function(
                    d, j) {
                    select.append('<option value="' + d + '">- ' + d + '</option>')
                });
            });
        }
    });
});
</script>
@endsection
