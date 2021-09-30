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
<div class="header bg-gradient-primary pb-6 pt-5 pt-md-7"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="fa fa-user-cog"></i> HR Administrator : ผู้ดูแลระบบงานบุคลากร
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
                                <li class="breadcrumb-item active" aria-current="page">ข้อมูลเจ้าหน้าที่</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <h4>
                        <i class="fa fa-database"></i> ฐานข้อมูลบุคลากร
                    </h4>
                    <div class="text-right" style="margin-bottom:0.5rem;">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#addEmpModal">
                            <i class="fa fa-user-plus"></i> เพิ่มข้อมูลบุคลากร
                        </button>
                    </div>
                    <table id="emplist_table" class="table table-striped" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center"><i class="fa fa-barcode"></i> BID</th>
                                <th><i class="far fa-address-card"></i> ชื่อ/สกุล</th>
                                <th><i class="fas fa-sitemap"></i> ฝ่าย/กลุ่มงาน</th>
                                <th>ประเภท</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $emps)
                                <tr>
                                    <td class="text-center">{{ $emps->barcode }}</td>
                                    <td>{{ $emps->name }}</td>
                                    <td>
                                        {{ $emps->dept_name }}
                                        @if($emps->permission == 1)
                                        <span class="badge badge-danger">
                                            <i class="fas fa-star"></i> หัวหน้าฝ่าย
                                        </span>
                                        @endif
                                        @if($emps->permission == 2)
                                        <span class="badge badge-warning">
                                            <i class="fas fa-star"></i> ผู้อำนวยการ
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $emps->job_name }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $emps->ws_text }} btn-block">
                                            <i class="fa fa-{{ $emps->ws_icon }}"></i>&nbsp;
                                            {{ $emps->ws_name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('hr.show',base64_encode($emps->id)) }}"
                                            class="badge badge-info btn-block">
                                            <i class="fa fa-search"></i>&nbsp;
                                            เพิ่มเติม
                                        </a>
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
<div class="modal fade" id="addEmpModal" aria-labelledby="addEmpLabel" aria-hidden="true">
    <form id="addEmp">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmpLabel"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลบุคลากร</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ชื่อ-สกุล</label>
                        <input type="text" name="name" class="inputX" placeholder="ไม่ต้องใส่คำนำหน้า">
                    </div>
                    <div class="form-group">
                        <label for="">วันที่เริ่มงาน</label>
                        <input type="text" class="inputX jsDate" name="work_start">

                    </div>
                    <div class="form-group">
                        <label for="">ประเภทบุคลากร</label>
                        <select name="job" class="inputX js-single">
                            <option></option>
                            @foreach ($jobs as $js)
                            <option value="{{ $js->job_id }}">
                                {{ $js->job_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">กลุ่มงาน/หน่วยบริการ</label>
                        <select name="dept" class="inputX js-single">
                            <option></option>
                            @foreach ($dept as $ds)
                            <option value="{{ $ds->dept_id }}">
                                {{ $ds->dept_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">ตำแหน่ง</label>
                        <input type="text" name="position" class="inputX">
                    </div>
                    <div class="form-group">
                        <label for="">ผู้บังคับบัญชา</label>
                        <select name="unit" class="inputX js-single">
                            <option></option>
                            @foreach ($unit as $uns)
                            <option value="{{ $uns->id }}">
                                {{ $uns->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-plus-circle"></i> บันทึกข้อมูล
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#emplist_table').dataTable({
            lengthMenu: [
                [10, 50, 100, -1],
                [10, 50, 100, "All"]
            ],
            order: [
                [4, "asc"],
                [0, "asc"]
            ],
            scrollX: true,
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

    $(function() {
        $.datetimepicker.setLocale('th');
        $(".jsDate").datetimepicker({
            format: 'Y/m/d',
            timepicker: false,
            lang: 'th',
        });
    });

    $(document).ready(function() {
        $('.js-single').select2({
            width: '100%',
            placeholder: "กรุณาเลือก",
            allowClear: true,
        });
    });

    $('#addEmp').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('hr.addEmp') }}",
                    data: $('#addEmp').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.reload()
                        }, 2900);
                    }
                });
            }
        })
    });

</script>
@endsection
