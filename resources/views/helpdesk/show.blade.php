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
                                @if ($list->help_status == 3 && Auth::user()->id == $list->help_create)
                                <tr>
                                    <th>ประเมินความพึงพอใจ</th>
                                    <td>
                                        <a href="#rateModal" data-toggle="modal" class="badge badge-info"><i class="fa fa-clipboard-check"></i> ทำแบบประเมิน</a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <th>ประเมินความพึงพอใจ</th>
                                    <td>
                                        @php 
                                            $rate_all = ($list->rate_1 + $list->rate_2 + $list->rate_3);
                                            $rate = $rate_all / 3;
                                            $i = 1; while ($i <= $rate) { 
                                                echo "<span class='fa fa-star text-yellow'></span>"; $i++; 
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="fa fa-tools"></i> วิธีดำเนินการ</h4>
                            @if (Auth::user()->permission == 4 || Auth::user()->permission == 5)
                                @include('helpdesk.show_admin')
                            @else
                                @include('helpdesk.show_user')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@include('helpdesk.rate')

@endsection
@section('script')
<script type="text/javascript">
$('#fixFrm').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันดำเนินการซ่อมเสร็จสิ้น ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('helpdesk.fixHelpdesk',$list->help_id) }}",
                    data: $('#fixFrm').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการซ่อมสำเร็จ',
                            text: 'ผู้ดำเนินการ : {{ Auth::user()->name }}',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/helpdesk')
                        }, 2900);
                    }
                });
            }
        })
    });

    $('#rateFrm').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันบันทึกการประเมิน ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('helpdesk.rateHelpdesk',$list->help_id) }}",
                    data: $('#rateFrm').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกการประเมินสำเร็จ',
                            text: 'ขอบคุณที่ให้ความร่วมมือ',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/helpdesk')
                        }, 2900);
                    }
                });
            }
        })
    });
</script>
@endsection
