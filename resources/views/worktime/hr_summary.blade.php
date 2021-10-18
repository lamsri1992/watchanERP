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
                                <i class="far fa-clock"></i> Time attendance record
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="fas fa-user-cog"></i> ผู้ดูแลระบบงานบุคลากร
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="/hrm/worktime">
                                                ระบบบันทึกเวลาเข้างาน
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">รายงาน : {{ getMonth(date("Y")."-".$_REQUEST['month']) }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="reportTable" class="table table-borderless table-striped" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th>เจ้าหน้าที่</th>
                                <th>ประเภท</th>
                                <th>ฝ่ายงาน</th>
                                <th class="text-center">วันทำงาน</th>
                                <th class="text-center">ลากิจ</th>
                                <th class="text-center">ลาป่วย</th>
                                <th class="text-center">ลาพักผ่อน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $res)
                            <tr>
                                <td class="text-center">{{ $res->barcode }}</td>
                                <td>{{ $res->name }}</td>
                                <td>{{ $res->job_name }}</td>
                                <td>{{ $res->dept_name }}</td>
                                <td class="text-center">{{ $res->works =='' ? '0' : $res->works }}</td>
                                <td class="text-center">{{ $res->busy =='' ? '0' : $res->busy }}</td>
                                <td class="text-center">{{ $res->sick =='' ? '0' : $res->sick }}</td>
                                <td class="text-center">{{ $res->vacation =='' ? '0' : $res->vacation }}</td>
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

$(document).ready(function() {
    var table = $('#reportTable').DataTable({
        pageLength: 20,
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        ordering: false,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i> บันทึกเป็นไฟล์ Excel',
            className: "btn btn-success btn-sm",
        }],
    });
});

</script>
@endsection
