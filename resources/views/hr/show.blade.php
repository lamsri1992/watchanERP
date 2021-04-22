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
                            <img class="img-fluid" src="{{ asset('img') }}/user-profile.png">
                            @else
                            <img class="img-fluid" src="{{ asset('img') }}/employee/{{ $data->img }}.jpg">
                            @endif
                            <div class="text-center">
                                <span class="badge badge-{{ $data->ws_text }}">
                                    <i class="fa fa-{{ $data->ws_icon }}"></i>&nbsp;
                                    {{ $data->ws_name }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form id="updateData">
                                <table class="table table-striped table-sm">
                                    <tr>
                                        <th class="text-center" width="30%"><i class="far fa-id-card"></i> BID</th>
                                        <td>
                                            <input type="text" value="{{ $data->barcode }}" style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ชื่อ - สกุล</th>
                                        <td>
                                            <input type="text" name="name" value="{{ $data->name }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วันที่เริ่มงาน</th>
                                        <td>
                                            <input type="text" name="work_start" class="jsDate" value="{{ $data->work_start }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    @if ($data->work_status == 2)
                                    <tr>
                                        <th class="text-center">วันที่ย้าย/ลาออก</th>
                                        <td>
                                            <input type="text" value="{{ $data->work_end }}" style="width: 100%;">
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
                                            <input type="text" name="position" value="{{ $data->position }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วันที่เกิด</th>
                                        <td>
                                            <input type="text" name="dob" class="jsDate" value="{{ $data->dob }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่</th>
                                        <td>
                                            <input type="text" name="address" value="{{ $data->address }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทร</th>
                                        <td>
                                            <input type="text" name="tel" value="{{ $data->tel }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ผู้ติดต่อยามฉุกเฉิน</th>
                                        <td>
                                            <input type="text" name="person_name" value="{{ $data->person_name }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทรผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" name="person_tel" value="{{ $data->person_tel }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่ผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" name="person_address" value="{{ $data->person_address }}" style="width: 100%;" required>
                                        </td>
                                    </tr>
                                    <tr class="text-right">
                                        <td colspan="2">
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
                 oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
                sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
        },
    });
});

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

</script>
@endsection
