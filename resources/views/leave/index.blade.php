@extends('layouts.app')

@section('content')
@include('leave.card')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase ls-1 mb-1">
                                <i class="fa fa-calendar-week"></i> Leave System
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-folder-open"></i> งานบริหารทั่วไป
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ระบบวันลาออนไลน์</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-primary btn-block">
                                <i class="far fa-edit"></i> ขออนุมัติวันลา
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-info btn-block">
                                รอการอนุมัติ <span class="badge badge-info text-white">1</span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger btn-block">
                                รอดำเนินการ <span class="badge badge-danger text-white">1</span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-block">
                                อนุมัติแล้ว <span class="badge badge-success text-white">1</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="ls-1 mb-1">
                        <i class="fa fa-history"></i> ประวัติการลางาน
                    </h6>
                    <table id="" class="table table-sm table-bordered" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">รหัสรายการ</th>
                                <th class="text-center">ประเภทการลา</th>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">ระยะเวลา</th>
                                <th class="text-center">ผู้รับผิดชอบงาน</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">HR-0004</td>
                                <td class="text-center">
                                    <span>ลาพักผ่อน</span>
                                </td>
                                <td class="text-center">
                                    1 มี.ค. 2564 - 1 มี.ค. 2564
                                </td>
                                <td class="text-center">
                                    1 วัน
                                </td>
                                <td class="text-center">
                                    <span>นิเทศน์ จรูญเกษมกุล</span>
                                </td>
                                <td class="text-center">
                                    <span class='badge badge-warning btn-block'>
                                        <i class='fa fa-ban'></i> ยกเลิกรายการ
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">HR-0003</td>
                                <td class="text-center">
                                    <span>ลาพักผ่อน</span>
                                </td>
                                <td class="text-center">
                                    8 ม.ค. 2564 - 8 ม.ค. 2564
                                </td>
                                <td class="text-center">
                                    1 วัน
                                </td>
                                <td class="text-center">
                                    <span>นิเทศน์ จรูญเกษมกุล</span>
                                </td>
                                <td class="text-center">
                                    <span class='badge badge-danger btn-block'>
                                        <i class='fa fa-envelope-open-text'></i> รอดำเนินการ
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">HR-0002</td>
                                <td class="text-center">
                                    <span>ลากิจ</span>
                                </td>
                                <td class="text-center">
                                    22 ธ.ค. 2563 - 22 ธ.ค. 2563
                                </td>
                                <td class="text-center">
                                    1 วัน
                                </td>
                                <td class="text-center">
                                    <span>เกียรติศักดิ์ เด่นแสงจันทร์</span>
                                </td>
                                <td class="text-center">
                                    <span class='badge badge-info btn-block'>
                                        <i class='far fa-clock'></i> รอการอนุมัติ
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">HR-0001</td>
                                <td class="text-center">
                                    <span>ลาป่วย</span>
                                </td>
                                <td class="text-center">
                                    25 พ.ย. 2563 - 25 พ.ย. 2563
                                </td>
                                <td class="text-center">
                                    1 วัน
                                </td>
                                <td class="text-center">
                                    <span>เกียรติศักดิ์ เด่นแสงจันทร์</span>
                                </td>
                                <td class="text-center">
                                    <span class='badge badge-success btn-block'>
                                        <i class='fa fa-check'></i> อนุมัติแล้ว
                                    </span>
                                </td>
                            </tr>
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

@endsection
