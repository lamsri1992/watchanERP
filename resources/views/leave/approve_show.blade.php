@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8"></div>
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
                                            <a href="/approve">
                                                <i class="far fa-calendar"></i> ระบบอนุมัติวันลา
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ "รหัสรายการ : HR-".$list->leave_id }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($list->status_id == 3)
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-check-circle"></i> รายการนี้ถูกอนุมัติแล้ว</h4>
                        <span><b>วันที่อนุมัติ</b> : {{ DateThai($list->leave_approve) }}</span><br>
                        <span><b>ความเห็นผู้อำนวยการ</b> : {{ $list->leave_dnote }}</span>
                    </div>
                    @endif
                    @if ($list->status_id == 5)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"><i class="fa fa-times-circle"></i> รายการนี้ถูกยกเลิกไปแล้ว</h4>
                        <span><b>วันที่ยกเลิก</b> : {{ DateThai($list->leave_cancel_date) }}</span><br>
                        <span><b>ผู้ยกเลิก</b> : {{ $list->leave_cancle }}</span><br>
                        <span><b>หมายเหตุ</b> : {{ $list->leave_cancel_note }}</span>
                    </div>
                    @endif
                    <div class="container-fluid">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td><b>วันที่ทำรายการ</b></td>
                                    <td class="text-left">{{ $list->leave_create }}</td>
                                    <td><b>เบอร์โทรติดต่อ</b></td>
                                    <td>{{ $list->tel }}</td>
                                </tr>
                                <tr>
                                    <td><b>ผู้ทำรายการ</b></td>
                                    <td class="text-left">{{ $list->name }}</td>
                                    <td><b>ที่อยู่ที่สามารถติดต่อได้</b></td>
                                    <td>{{ $list->address }}</td>
                                </tr>
                                <tr>
                                    <td><b>ประเภทการลา</b></td>
                                    <td class="text-left">{{ $list->type_name }}</td>
                                    <td><b>ผู้รับผิดชอบงานแทน</b></td>
                                    <td class="text-left">{{ $list->leave_stead }}</td>
                                </tr>
                                <tr>
                                    <td><b>วันที่เริ่มลา</b></td>
                                    <td class="text-left">{{ DateThai($list->leave_start) }}</td>
                                    <td><b>หมายเหตุการลา</b></td>
                                    <td class="text-left">{{ $list->leave_note }}</td>
                                </tr>
                                <tr>
                                    <td><b>วันที่สิ้นสุด</b></td>
                                    <td class="text-left">{{ DateThai($list->leave_end) }}</td>
                                    @if(!is_null($list->leave_hnote))
                                        <td><b>ความเห็นหัวหน้าฝ่าย</b></td>
                                        <td class="text-left">{{ $list->leave_hnote }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>จำนวน (วัน)</b></td>
                                    <td class="text-left">{{ $list->leave_num }}
                                        <small class="text-danger">{{ $list->time_name }}</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($list->status_id == 1)
                <div class="card-body">
                    <form id="approveList">
                        <div class="container-fluid form-row">
                            <div class="form-group col-md-12">
                                <label>ความเห็นหัวหน้าฝ่าย</label>
                                <textarea name="hnote" class="form-control" cols="30" rows="3" placeholder="ระบุความคิดเห็นในการขออนุมัติรายการ..." required></textarea>
                            </div>
                            <div class="col-md-6">
                                <button id="btnApprove" class="btn btn-block btn-lg btn-success"><i class="fa fa-check-circle"></i> อนุมัติรายการ</button>
                            </div>
                            <div class="col-md-6">
                                <button id="btnDisapprove" class="btn btn-block btn-lg btn-danger"><i class="fa fa-times-circle"></i> ไม่อนุมัติรายการ</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

@endsection
@section('script')
<script type="text/javascript">
     $('#btnApprove').on("click", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'อนุมัติวันลา\n{{ "รหัสรายการ : HR-".$list->leave_id }}',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
            icon: "success",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('approve.allowList',$list->leave_id) }}",
                    data: $('#approveList').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการแล้ว',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/approve')
                        }, 1500);
                    }
                });
            }
        })
    });

    $('#btnDisapprove').on("click", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ไม่อนุมัติวันลา\n{{ "รหัสรายการ : HR-".$list->leave_id }}',
            showCancelButton: true,
            confirmButtonText: `ตกลง`,
            cancelButtonText: `ยกเลิก`,
            icon: "error",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('approve.disallowList',$list->leave_id) }}",
                    data: $('#approveList').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการแล้ว',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/approve')
                        }, 1500);
                    }
                });
            }
        })
    });
</script>
@endsection
