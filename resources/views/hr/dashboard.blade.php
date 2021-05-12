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
                                <i class="fa fa-user-cog"></i> Leave Administrator : ผู้ดูแลระบบงานบุคลากร
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="header-body">
                            <!-- Card stats -->
                            <div class="row">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">จำนวนเจ้าหน้าที่</h5>
                                                    <span class="h2 font-weight-bold mb-0">{{ $users }} คน :</span>
                                                    <small class="text-muted">{{ $resign }} คน (ย้าย/ลาออก)</small>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <a href="/hrm/employee" class="btn btn-success btn-sm btn-block">
                                                    <i class="fa fa-cog"></i> จัดการข้อมูลเจ้าหน้าที่
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">รายการขออนุมัติวันลา</h5>
                                                    <span class="h2 font-weight-bold mb-0">{{ $leaves }} รายการ</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <a href="/hrm/leave" class="btn btn-success btn-sm btn-block">
                                                    <i class="fa fa-cog"></i> จัดการรายการขออนุมัติวันลา
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-stats mb-4 mb-xl-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">รายการขออนุมัติเดินทาง</h5>
                                                    <span class="h2 font-weight-bold mb-0">{{ $notes }} รายการ</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                        <i class="fa fa-shuttle-van"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-muted text-sm">
                                                <a href="#" class="btn btn-success btn-sm btn-block">
                                                    <i class="fa fa-cog"></i> จัดการรายการขออนุมัติเดินทาง
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@endsection
