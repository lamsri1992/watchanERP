@extends('layouts.app')

@section('content')
<style>
    .inputX{
        width: 100%;
        padding: 4px;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
</style>
<div class="header bg-gradient-primary pb-6 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="fa fa-database"></i> HR DATABASE : ฐานข้อมูลบุคลากร
                            </h6>
                        </div>
                    </div>
                    <div class="mb-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/hrm/dashboard">
                                        <i class="fa fa-user-cog"></i> ผู้ดูแลระบบงานบุคลากร
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="/hrm/employee">
                                       ข้อมูลเจ้าหน้าที่
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $data->barcode." - ".$data->name }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="header-body">
                        <!-- Card stats -->
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase ls-1 mb-1">
                                    <i class="fa fa-calendar"></i> จำนวนสิทธิ์วันลา
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">สิทธิ์วันลากิจ</h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $data->busy }} วัน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                    <i class="fas fa-briefcase"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">สิทธิ์วันลาป่วย</h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $data->sick }} วัน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="fas fa-user-injured"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">สิทธิ์วันลาพักผ่อน</h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $data->balance_new }} วัน</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                    <i class="fas fa-umbrella-beach"></i>
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
                    <div class="row">
                        <div class="col-md-4">
                            @if ($data->img == NULL)
                            <img class="img-fluid rounded" src="{{ asset('img') }}/user-profile.png">
                            @else
                            <img class="img-fluid rounded" src="{{ asset('img') }}/employee/{{ $data->img }}.jpg">
                            @endif
                            <div class="text-center">
                                <span class="badge badge-{{ $data->ws_text }} btn-block">
                                    <i class="fa fa-{{ $data->ws_icon }}"></i>&nbsp;
                                    {{ $data->ws_name }}
                                    {{ " : อายุงาน ".GetAge($data->work_start)." ปี" }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form id="updateData">
                                <table class="table table-striped table-sm">
                                    <tr>
                                        <th class="text-center" width="30%"><i class="far fa-id-card"></i> BID</th>
                                        <td>
                                            <input type="text" class="inputX text-primary" value="{{ $data->barcode }}" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ชื่อ - สกุล</th>
                                        <td>
                                            <input type="text" class="inputX" name="name" value="{{ $data->name }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วันที่เริ่มงาน</th>
                                        <td>
                                            <input type="text" class="inputX jsDate" name="work_start" value="{{ $data->work_start }}" required>
                                        </td>
                                    </tr>
                                    @if ($data->work_status == 2)
                                    <tr>
                                        <th class="text-center">วันที่ย้าย/ลาออก</th>
                                        <td>
                                            <input type="text" class="inputX" value="{{ $data->work_end }}">
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th class="text-center">ประเภทบุคลากร</th>
                                        <td>
                                            <select name="job" class="js-single" required>
                                                <option></option>
                                                @foreach ($jobs as $js)
                                                <option value="{{ $js->job_id }}"
                                                    @if ($data->job == $js->job_id)
                                                        {{ 'SELECTED' }}
                                                    @endif>
                                                    {{ $js->job_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">กลุ่มงาน/หน่วยบริการ</th>
                                        <td>
                                            <select name="dept" class="js-single" required>
                                                <option></option>
                                                @foreach ($dept as $ds)
                                                <option value="{{ $ds->dept_id }}"
                                                    @if ($data->department == $ds->dept_id)
                                                        {{ 'SELECTED' }}
                                                    @endif>
                                                    {{ $ds->dept_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ตำแหน่ง</th>
                                        <td>
                                            <input type="text" class="inputX" name="position" value="{{ $data->position }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วันที่เกิด</th>
                                        <td>
                                            <input type="text" class="inputX jsDate" name="dob" value="{{ $data->dob }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่</th>
                                        <td>
                                            <input type="text" class="inputX" name="address" value="{{ $data->address }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทร</th>
                                        <td>
                                            <input type="text" class="inputX" name="tel" value="{{ $data->tel }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ผู้ติดต่อยามฉุกเฉิน</th>
                                        <td>
                                            <input type="text" class="inputX" name="person_name" value="{{ $data->person_name }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทรผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" class="inputX" name="person_tel" value="{{ $data->person_tel }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่ผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" class="inputX" name="person_address" value="{{ $data->person_address }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><i class="fab fa-line text-success"></i> Line Token</th>
                                        <td>
                                            <input type="text" class="inputX" name="line_token" value="{{ $data->line_token }}" style="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ผู้บังคับบัญชา</th>
                                        <td>
                                            <select name="unit" class="js-single" required>
                                                <option></option>
                                                @foreach ($unit as $uns)
                                                <option value="{{ $uns->id }}"
                                                    @if ($data->unit == $uns->id)
                                                        {{ 'SELECTED' }}
                                                    @endif>
                                                    {{ $uns->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#leaveModal">
                                                <i class="fa fa-history"></i> ประวัติการลา
                                            </a>
                                            @if ($data->work_status == 1)
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resign">
                                                <i class="fa fa-sign-out-alt"></i> บันทึกการย้าย
                                            </a>
                                            @endif
                                            <a href="/hrm/employee" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times-circle"></i> ยกเลิกการแก้ไข
                                            </a>
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-save"></i> บันทึกการแก้ไข
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Modal -->
<div class="modal fade" id="resign" tabindex="-1" aria-labelledby="resignLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="resignFrm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resignLabel"><i class="fa fa-sign-out-alt"></i> บันทึกการย้าย/ลาออก</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="resign" class="form-control jsDate" placeholder="ระบุวันที่ย้าย/ลาออก" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="submit" class="btn btn-sm btn-success">บันทึกข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Leave History Modal -->
<div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveModalLabel"><i class="fa fa-history"></i> ประวัติการลางาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="leave_list" class="table table-borderless table-striped compact" style="width:100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">ประเภทการลา</th>
                            <th class="text-center">วันที่ลา</th>
                            <th class="text-center">วันที่สิ้นสุด</th>
                            <th class="text-center">จำนวน (วัน)</th>
                            <th class="text-center">ผู้รับผิดชอบงาน</th>
                            <th class="text-center">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $res)                                
                        <tr>
                            <td class="text-center">
                                <a class="badge badge-warning btn-block" href="{{ route('leave.hr_show',base64_encode($res->leave_id)) }}">
                                    {{ "HR-".$res->leave_id }}
                                </a>
                            </td>
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
                                {{ $res->leave_stead }}
                            </td>
                            <td class="text-center">
                                <div class="text-center">
                                    <span class="{{ $res->status_style }}">
                                          <i class="{{ $res->status_icon }}"></i> {{ $res->status_name }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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
$(document).ready(function() {
    $('.js-single').select2({
        width: '100%',
        placeholder: "กรุณาเลือก",
        allowClear: true,
    });
});

$(function() {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y/m/d',
            timepicker: false,
            lang: 'th',
        });
    });

$('#updateData').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการแก้ไขข้อมูล ?',
            text: '{{ $data->name }}',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('hr.editEmp',$data->id) }}",
                    data: $('#updateData').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        })
    });

    $('#resignFrm').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'บันทึกการย้าย/ลาออก ?',
            text: '{{ $data->name }}',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('hr.resign',$data->id) }}",
                    data: $('#resignFrm').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        })
    });

    $(document).ready(function () {
        $('#leave_list').dataTable({
            bLengthChange: false,
            bPaginate: false,
            searching: false,
            responsive: true,
            ordering: false,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            order: [[ 0, 'desc' ]],
            oLanguage: {
                 oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
            }
        });
    });
</script>
@endsection
