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
                                <i class="fa fa-money-check-alt"></i> Financial System
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-folder-open"></i> งานบริหารทั่วไป
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="/salary">
                                                ใบรับรองการจ่ายเงินเดือน : {{ Auth::user()->name }}
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ค่าล่วงเวลา เดือน{{ MonthThai(date($slip->year."-".$slip->month)) }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                @php 
                    $income = $slip->salary + $slip->pos_incom + $slip->son + $slip->school + $slip->ot 
                            + $slip->health + $slip->store + $slip->life + $slip->other_income;
                    $outcome = $slip->tax + $slip->co_ordinate + $slip->dead + $slip->car + $slip->house 
                            + $slip->trat_store + $slip->save_life + $slip->water_elect + $slip->other_pay
                            + $slip->p5 + $slip->p7 + $slip->sav_1;
                    $total = $income - $outcome;
                @endphp
                <div class="card-body">
                    <div class="row" style="margin-bottom: 1rem;">
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <div class="card" style="height: 100%;">
                                <div class="card-body">
                                    <h2 class="card-title text-center" style="font-weight: bold;">
                                        <i class="fa fa-file-download text-success"></i> ค่าล่วงเวลา
                                    </h2>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td style="font-weight: bold;">OT</td>
                                            <td style="font-weight: bold;" class="text-right text-success">
                                                + {{ number_format($slip->salary,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">ค่ารีเฟอร์</td>
                                            <td style="font-weight: bold;" class="text-right text-success">
                                                + {{ number_format($slip->son,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">เบี้ยเลี้ยงเหมาจ่าย</td>
                                            <td style="font-weight: bold;" class="text-right text-success">
                                                + {{ number_format($slip->life,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">ค่าไม่ทำเวช</td>
                                            <td style="font-weight: bold;" class="text-right text-success">
                                                + {{ number_format($slip->store,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">เงิน พตส.</td>
                                            <td style="font-weight: bold;" class="text-right text-success">
                                                + {{ number_format($slip->ot,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;font-size: 18px;">รวมรายรับ</td>
                                            <td style="font-weight: bold;font-size: 18px;" class="text-right text-success">
                                                + {{ number_format($income,2) }} ฿
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <div class="card" style="height: 100%;">
                                <div class="card-body">
                                    <h2 class="card-title text-center" style="font-weight: bold;">
                                        <i class="fa fa-file-upload text-danger"></i> รายการจ่าย
                                    </h2>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td style="font-weight: bold;">ภาษีหัก ณ ที่จ่าย</td>
                                            <td style="font-weight: bold;" class="text-right text-danger">
                                                - {{ number_format($slip->sav_1,2) }} ฿
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;font-size: 18px;">รวมรายจ่าย</td>
                                            <td style="font-weight: bold;font-size: 18px;" class="text-right text-danger">
                                                - {{ number_format($outcome,2) }} ฿
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @php
                            $id = $slip->salary_id;
                            for ($i = 0; $i < 10; $i++)
                            {
                                $id = base64_encode($id);
                            }
                        @endphp
                        <div class="col-md-12">
                            <div class="jumbotron text-center">
                                <h1 class="display-4" style="font-size: 2rem;">
                                    <i class="fa fa-piggy-bank text-info" style="font-size: 3rem;"></i> 
                                    คงเหลือ  {{ number_format($total,2) }} ฿
                                </h1>
                                <a href="{{ route('salary.ot_print', $id) }}" class="btn btn-light btn-sm" target="_blank">
                                    <i class="fa fa-print"></i> พิมพ์สลิปเงินเดือน
                                </a>
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
