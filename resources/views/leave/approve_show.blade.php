@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
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
                                                <i class="far fa-calendar-check"></i> ระบบอนุมัติวันลา
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
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <thead>
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
                                        <td><b>ความเห็นหัวหน้าฝ่าย</b></td>
                                        <td class="text-left">{{ $list->leave_hnote }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>จำนวน (วัน)</b></td>
                                        <td class="text-left">{{ $list->leave_num }} <small class="text-danger">{{ $list->time_name }}</small></td>
                                    </tr>
                                </thead>
                            </table>
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

</script>
@endsection
