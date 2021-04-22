@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-5 pt-md-7"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="fa fa-calendar-week"></i> Leave Approve
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-calendar-check"></i> ระบบอนุมัติวันลา
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">สำหรับผู้อำนวยการ</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="ls-1 mb-1">
                        <i class="far fa-clock"></i> รายการรอดำเนินการ
                        <div class="text-right">
                            <button id="btnAll" class="btn btn-sm btn-success">
                                <i class="fa fa-tasks"></i> อนุมัติทั้งหมด
                            </button>
                        </div>
                    </h4>
                    <table id="leave_list" class="table table-bordered display" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ผู้ขออนุมัติ</th>
                                <th class="text-center">ประเภทการลา</th>
                                <th class="text-center">วันที่ลา</th>
                                <th class="text-center">วันที่สิ้นสุด</th>
                                <th class="text-center">จำนวน (วัน)</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $res)                                
                            <tr>
                                <td class="text-center">{{ "HR-".$res->leave_id }}</td>
                                <td class="text-center">
                                    <span class="{{ $res->status_style }}">
                                        <i class="{{ $res->status_icon }}"></i> {{ $res->status_name }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $res->name }}</td>
                                <td class="text-center">
                                    {{ $res->type_name }}
                                </td>
                                <td class="text-center">
                                    {{ DateThai($res->leave_start) }}
                                </td>
                                <td class="text-center">
                                    {{ DateThai($res->leave_end) }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_num }}&nbsp;
                                    <small class="text-danger">{{ $res->time_name }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownApprove" 
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-cog"></i> รายการอนุมัติ
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownApprove">
                                          <a class="dropdown-item text-success" href="#"><i class="far fa-check-circle"></i>อนุมัติรายการ</a>
                                          <a class="dropdown-item text-danger" href="#"><i class="far fa-times-circle"></i>ไม่อนุมัติรายการ</a>
                                          <a class="dropdown-item text-primary" href="#"><i class="far fa-question-circle"></i>ดูรายละเอียด</a>
                                        </div>
                                    </div>
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

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#leave_list').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            searching: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            order: [
                [0, 'asc']
            ],
            oLanguage: {
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
                sInfoEmpty: "<small>ไม่มีข้อมูล</small>"
            }
        });
    });

    $('#btnAll').on("click", function (event) {
        var id = $(this).attr('data-id');
        event.preventDefault();
        Swal.fire({
            title: 'อนุมัติรายการทั้งหมด ?',
            showCancelButton: true,
            confirmButtonText: `ยืนยัน`,
            cancelButtonText: `ยกเลิก`,
            icon: `warning`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('leave.approve_all') }}",
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ทำรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/authorize')
                        }, 1500);
                    }
                });
            }
        })
    });

</script>
@endsection
