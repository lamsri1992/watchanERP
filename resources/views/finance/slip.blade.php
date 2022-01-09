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
                                        <li class="breadcrumb-item active" aria-current="page">ใบรับรองการจ่ายเงินเดือน : {{ Auth::user()->name }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="" style="margin-bottom: 1rem;">
                        <div class="col-md-6">
                            <h1><i class="fa fa-comments-dollar"></i> ข้อมูลการจ่ายเงินเดือนปี / เงินค่าล่วงเวลา OT</h1>
                        </div>
                        <div class="alert alert-danger text-center" role="alert">
                            <small><i class="fa fa-exclamation-circle"></i> ข้อมูลทางการเงิน เป็นข้อมูลสำคัญ กรุณาเก็บรักษาไว้เป็นความลับ</small>
                        </div>
                        <div class="row">
                            @php $i = 0; @endphp
                            @foreach ($sal as $sals)
                            @php 
                                $income = $sals->salary + $sals->pos_incom + $sals->son + $sals->school + $sals->ot 
                                        + $sals->health + $sals->store + $sals->life + $sals->other_income;
                                $outcome = $sals->tax + $sals->co_ordinate + $sals->dead + $sals->car + $sals->house 
                                        + $sals->trat_store + $sals->save_life + $sals->water_elect + $sals->other_pay
                                        + $sals->p5 + $sals->p7 + $sals->sav_1;
                                $total = $income - $outcome;
                                $i++;
                            @endphp
                            <div class="col-md-3" style="margin-bottom: 1rem;">
                                <div class="card" style="height: 100%;">
                                    <div class="card-body">
                                        <h2 class="card-title text-center" style="font-weight: bold;">
                                            @if ($sals->salary_ot == 1)
                                            OT : 
                                            @endif
                                            เดือน{{ MonthThai(date($sals->year."-".$sals->month)) }}
                                            @if ($i == 1)
                                            <span class="badge badge-danger"><i class="far fa-bell"></i> New</span>
                                            @endif
                                            <br><small class="text-muted">{{ $sals->year }}</small>
                                        </h2>
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td style="font-weight: bold;">รวมรายรับ</td>
                                                <td style="font-weight: bold;" class="text-right text-success">
                                                    + {{ number_format($income,2) }} ฿
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">รวมรายจ่าย</td>
                                                <td style="font-weight: bold;" class="text-right text-danger">
                                                    - {{ number_format($outcome,2) }} ฿
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">คงเหลือ</td>
                                                <td style="font-weight: bold;" class="text-right text-primary">
                                                   <span style="border-bottom: 4px double;">{{ number_format($total,2) }} ฿</span>
                                                </td>
                                            </tr>
                                        </table>
                                        @php
                                            $id = $sals->salary_id;
                                            for ($i = 0; $i < 10; $i++)
                                            {
                                                $id = base64_encode($id);
                                            }
                                        @endphp
                                        <div class="text-center">
                                            <a href="{{ route('salary.slip_ot', $id) }}"
                                                class="btn btn-sm btn-light">
                                                <i class="fa fa-search"></i> VIEW
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
