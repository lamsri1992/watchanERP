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
                                        <span class="h2 font-weight-bold mb-0">{{ $busy == 0 ? 0 : $busy }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $sick == 0 ? 0 : $sick }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $vacation == 0 ? 0 : $vacation }}</span>
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">ไปราชการ</h5>
                                        <span class="h2 font-weight-bold mb-0">0</span>
                                        <small class="text-muted">ราย</small>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-shuttle-van"></i>
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
                            <h2 class="mb-0"><i class="fas fa-chart-bar"></i> สถิติการลาแยกตามประเภท</h2>
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
                            <h2 class="mb-0"><i class="fas fa-user-clock"></i> การบันทึกเวลาเข้างาน</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Worktimes -->
                    <div class="chart">
                        <table id="time_table" class="table table-sm table-striped compact" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th><i class="far fa-clock"></i> เวลาเข้างาน</th>
                                    <th>ชื่อ - สกุล</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 mb-5 mb-xl-0" style="margin-top: 1rem;">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="mb-0"><i class="far fa-calendar"></i> ปฏิทินวันลา</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Calendar -->
                    <div class="container">
                        <div id="calendar"></div>
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
// Leave Chart
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

// Worktime Table
$(document).ready(function () {
    $('#time_table').dataTable( {
        ajax: {
            url: "api/time_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'work_time', className: "text-center" },
            { 'data': 'name' },
        ],
        lengthMenu: [
            [7, 50, 100, -1],
            [7, 50, 100, "All"]
        ],
        // responsive: true,
        scrollX: true,
        autoWidth: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        order: [[ 0, 'desc' ]],
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
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        hiddenDays: [ 0, 6 ],
        dayMaxEventRows: true,
        views: {
            timeGrid: {
                dayMaxEventRows: 6
            }
        },
        displayEventTime: false,
        initialView: 'dayGridMonth',
        eventSources: [
            {
                url: '/api/calendar_api',
                color: 'purple',
                textColor: 'white'
            }
        ]
    });
    calendar.setOption('locale', 'th');
    calendar.render();
});

</script>
@endsection
