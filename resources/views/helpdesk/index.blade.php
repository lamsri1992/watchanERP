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
                                <i class="fa fa-wrench"></i> Maintenance work
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="fas fa-wrench"></i> ระบบงานแจ้งซ่อม
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">แจ้งซ่อมคอมพิวเตอร์</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="header-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">ซ่อมสำเร็จ</h5>
                                                <span class="h2 font-weight-bold mb-0">?? รายการ</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                    <i class="fas fa-check"></i>
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
                                                <h5 class="card-title text-uppercase text-muted mb-0">รอดำเนินการ</h5>
                                                <span class="h2 font-weight-bold mb-0">?? รายการ</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                    <i class="fas fa-clock"></i>
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
                                                <h5 class="card-title text-uppercase text-muted mb-0">ส่งซ่อม</h5>
                                                <span class="h2 font-weight-bold mb-0">?? รายการ</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-shipping-fast"></i>
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
                                                <h5 class="card-title text-uppercase text-muted mb-0">ชำรุด</h5>
                                                <span class="h2 font-weight-bold mb-0">?? รายการ</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="fas fa-times"></i>
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
                    <div class="" style="margin-bottom: 1rem;">
                        <h6 class="ls-1 mb-1">
                            <i class="fas fa-clipboard-list"></i> รายการแจ้งซ่อมคอมพิวเตอร์
                        </h6>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#addNew">
                                <i class="fas fa-wrench"></i> แจ้งซ่อมคอมพิวเตอร์
                            </button>
                        </div>
                    </div>
                    <table id="list_table" class="table display nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">รหัสแจ้งซ่อม</th>
                                <th class="text-center">วันที่แจ้ง</th>
                                <th>ฝ่าย/กลุ่มงาน</th>
                                <th>รายละเอียด</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $res)
                            <tr>
                                <td class="text-center">{{ "IT-".str_pad($res->help_id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-center">{{ DateTimeThai($res->help_date) }}</td>
                                <td>{{ $res->dept_name }}</td>
                                <td>{{ $res->help_title }}</td>
                                <td class="text-center">
                                    <span class="{{ $res->hs_text }}">
                                        <i class="{{ $res->hs_icon }}"></i>&nbsp;
                                        {{ $res->hs_name }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Modal -->
<div class="modal fade" id="addNew" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus-circle"></i> เปิดรายการแจ้งซ่อม
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addFrm">
                <div class="modal-body">
                    <div class="form-group">
                        <table class="table table-bordered text-center" style="font-size:13px;">
                            <tr>
                                <td>
                                    <b>วันที่แจ้งซ่อม :</b>
                                    @php $curdate = date('Y-m-d H:i:s'); @endphp
                                    {{ DateTimeThai($curdate) }}
                                </td>
                                <td>
                                    <b>ชื่อ-สกุล :</b>
                                    {{ Auth::user()->name }}
                                </td>
                                <td>
                                    <b>ตำแหน่ง :</b>
                                    {{ Auth::user()->position }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <span style="font-size:14px;">ระบุอาการ/ปัญหาการใช้งานไม่ได้</span>
                        <textarea type="text" name="title" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <select name="place" class="js-single" required>
                            <option></option>
                            @php
                                foreach ($place as $arr){ echo "<option value='".$arr->place_id ."'>".$arr->place_name ."</option>"; }
                            @endphp
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" class="btn btn-success">
                            <i class="fa fa-save"></i> บันทึกการแจ้งซ่อม
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#list_table').dataTable( {
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        oLanguage: {
                sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
        },
        order: [[ 4, 'asc' ]],
        scrollX: true,
        initComplete: function() {
            this.api().columns([2, 3]).every(function() {
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

$('#addFrm').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกรายการแจ้งซ่อม ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('helpdesk.addHelpdesk') }}",
                    data: $('#addFrm').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการแจ้งซ่อมสำเร็จ',
                            text: 'เจ้าหน้าที่จะใช้เวลาเข้าไปถึงหน้างานไม่เกิน 30 นาที',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('helpdesk')
                        }, 2900);
                    }
                });
            }
        })
    });

$(document).ready(function() {
        $('.js-single').select2({
            width: '100%',
            placeholder: "ระบุสถานที่/ห้อง",
            allowClear: true,
        });
    });

</script>
@endsection
