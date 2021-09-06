@extends('layouts.app')

@section('content')
<div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center" style="background-image: url(https://wc-hospital.go.th/assets/img/hospital_front.jpg); 
    background-size: cover; background-position: bottom;">
    <span class="mask bg-gradient-default opacity-8"></span>
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            @foreach($data as $res)
                @php
                    $busy = $res->busy;
                    $sick = $res->sick;
                    $vacation = $res->vacation;
                @endphp
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">ลากิจ</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $busy }}</span>
                                        <small class="text-muted">ราย</small>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">ลาป่วย</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $sick }}</span>
                                        <small class="text-muted">ราย</small>
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
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">ลาพักผ่อน</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $vacation }}</span>
                                        <small class="text-muted">ราย</small>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-umbrella-beach"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">สถิติการเข้างาน</h5>
                                        <span class="h2 font-weight-bold mb-0">0/0</span>
                                        <small class="text-muted">ราย</small>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-user-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">ปีงบประมาณ 2564</h6>
                            <h2 class="mb-0">สถิติการลาแยกตามประเภท</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="leaveChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">ประจำวันที่ <?=DateThai(date('Y-m-d'))?></h6>
                            <h2 class="mb-0">สถิติการบันทึกเวลาเข้างาน</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="timeChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

@foreach($count as $res)
    @php
        $busy = $res->busy;
        $sick = $res->sick;
        $vacation = $res->vacation;
    @endphp
@endforeach
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
@section('script')
<script>

Chart.defaults.global.defaultFontFamily = '"Kanit"';
Chart.defaults.global.defaultFontColor = '#292b2c';
var ctx = document.getElementById('leaveChart');
var leaveChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['จำนวนลากิจ', 'จำนวนลาป่วย', 'จำนวนลาพักผ่อน'],
        datasets: [{
            // label: 'สถิติการลา',
            data: [{{ $busy }}, {{ $sick }}, {{ $vacation }}],
            backgroundColor: 'orange',
            borderColor: 'orange',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
@endsection
