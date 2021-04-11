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
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="/helpdesk">
                                                แจ้งซ่อมคอมพิวเตอร์
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ "IT-".str_pad($list->help_id, 4, '0', STR_PAD_LEFT) }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="fa fa-clipboard-list"></i> รายละเอียดรายการแจ้งซ่อมคอมพิวเตอร์ : {{ "IT-".str_pad($list->help_id, 4, '0', STR_PAD_LEFT) }}</h4>
                            <table class="table table-borderless table-bordered">
                                <tr>
                                    <th>วันที่แจ้งซ่อม</th>
                                    <td>{{ DateTimeThai($list->help_date) }}</td>
                                </tr>
                                <tr>
                                    <th>อาการ</th>
                                    <td>{{ $list->help_title }}</td>
                                </tr>
                                <tr>
                                    <th>ผู้ทำรายการ</th>
                                    <td>{{ $list->name }}</td>
                                </tr>
                                <tr>
                                    <th>ฝ่าย/กลุ่มงาน</th>
                                    <td>{{ $list->dept_name }}</td>
                                </tr>
                                <tr>
                                    <th>สถานที่/ห้อง</th>
                                    <td>{{ $list->place_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="fa fa-tools"></i> วิธีดำเนินการ</h4>
                            <table class="table table-borderless table-bordered">
                                <tr>
                                    <th>วันที่ดำเนินการ</th>
                                    <td>{{ DateTimeThai($list->help_end) }}</td>
                                </tr>
                                <tr>
                                    <th>ผู้ดำเนินการ</th>
                                    <td>{{ $list->help_support }}</td>
                                </tr>
                                <tr>
                                    <th>สาเหตุ</th>
                                    <td>{{ $list->help_cause }}</td>
                                </tr>
                                <tr>
                                    <th>วิธีแก้ไข</th>
                                    <td>{{ $list->help_fix }}</td>
                                </tr>
                                <tr>
                                    <th>ประเภทปัญหา</th>
                                    <td>{{ $list->dept_name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-{{ SUBSTR($list->hs_text,12,20) }}" role="alert">
                        สถานะการดำเนินการ : <i class="{{ $list->hs_icon }}"></i> {{ $list->hs_name }}
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
