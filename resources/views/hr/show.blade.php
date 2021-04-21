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
                                    {{ $data->barcode." : ".$data->name }}
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
                                <img class="img-fluid" src="{{ asset('img') }}/employee/{{ $data->img }}">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <form id="updateData">
                                <table class="table table-striped table-sm">
                                    <tr>
                                        <th class="text-center" width="30%">ชื่อ - สกุล</th>
                                        <td>
                                            <input type="text" value="{{ $data->name }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ประเภทบุคลากร</th>
                                        <td>
                                            <select name="dept" class="js-single" required>
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
                                            <input type="text" value="{{ $data->position }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่</th>
                                        <td>
                                            <input type="text" value="{{ $data->address }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทร</th>
                                        <td>
                                            <input type="text" value="{{ $data->tel }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ผู้ติดต่อยามฉุกเฉิน</th>
                                        <td>
                                            <input type="text" value="{{ $data->person_name }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">เบอร์โทรผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" value="{{ $data->person_tel }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">ที่อยู่ผู้ติดต่อ</th>
                                        <td>
                                            <input type="text" value="{{ $data->person_address }}" style="width: 100%;">
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-save"></i> บันทึกการแก้ไข
                                    </button>
                                </div>
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
</script>
@endsection
