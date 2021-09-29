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
                                            <span class="badge badge-danger"><i class="fas fa-star"></i>
                                                หัวหน้าฝ่าย</span>
                                        @endif
                                        @if($emps->permission == 2)
                                            <span class="badge badge-warning"><i class="fas fa-star"></i>
                                                ผู้อำนวยการ</span>
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
<div class="modal fade" id="addEmpModal" tabindex="-1" aria-labelledby="addEmpLabel" aria-hidden="true">
    <form id="addEmp">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmpLabel"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลบุคลากร</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i>
                        บันทึกข้อมูล</button>
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

</script>
@endsection
