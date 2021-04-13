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
                            @if (Auth::user()->permission == 4)
                            <form id="fixFrm">
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
                                        <td>
                                            <input type="text" name="cause" class="form-control" value="{{ $list->help_cause }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>วิธีแก้ไข</th>
                                        <td>
                                            <input type="text" name="fix" class="form-control" value="{{ $list->help_fix }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ประเภทปัญหา</th>
                                        <td>
                                            <select name="type" class="custom-select" required>
                                                <option>เลือกประเภท</option>
                                                @foreach ($type as $ts)
                                                <option value="{{ $ts->ht_id }}"
                                                    @if ($list->help_type == $ts->ht_id)
                                                        {{ 'SELECTED' }}
                                                    @endif>
                                                    {{ $ts->ht_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>สถานะดำเนินการ</th>
                                        <td>
                                            <select name="stat" class="custom-select" required>
                                                @foreach ($stat as $stats)
                                                <option value="{{ $stats->hs_id }}"
                                                    @if ($list->help_status == $stats->hs_id)
                                                        {{ 'SELECTED' }}
                                                    @endif>
                                                    {{ $stats->hs_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> บันทึกการซ่อม</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            @else
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
                                    <td>{{ $list->ht_name }}</td>
                                </tr>
                                <tr>
                                    <th>สถานะ</th>
                                    <td>
                                        <span class="{{ $list->hs_text }}">
                                            <i class="{{ $list->hs_icon }}"></i> {{ $list->hs_name }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Rate Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rateModalLabel"><i class="fa fa-clipboard-check"></i> แบบประเมินความพึงพอใจ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if (!isset($list->rate_id))
        <form id="rateFrm">
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <tr class="text-center">
                        <th width="75%">รายการ / คะแนน <i class="far fa-smile"></i></th>
                        <th width="5%">5</th>
                        <th width="5%">4</th>
                        <th width="5%">3</th>
                        <th width="5%">2</th>
                        <th width="5%">1</th>
                    </tr>
                    <tr>
                        <td>1. ความรวดเร็วในการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="1"></td>
                    </tr>
                    <tr>
                        <td>2. การจัดลำดับขั้นตอนการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="1"></td>
                    </tr>
                    <tr>
                        <td>3. ความเต็มใจและความพร้อมในการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="1"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> ส่งแบบประเมิน</button>
            </div>
        </form>
        @else
        <div class="modal-body">
            <table class="table table-sm table-bordered">
                <tr class="">
                    <th>รายการประเมิน</th>
                    <th class="text-center">คะแนน <i class="far fa-smile"></i></th>
                </tr>
                <tr>
                    <td>1. ความรวดเร็วในการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_1 }}</td>
                </tr>
                <tr>
                    <td>2. การจัดลำดับขั้นตอนการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_2 }}</td>
                <tr>
                    <td>3. ความเต็มใจและความพร้อมในการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_3 }}</td>
                </tr>
                <tr>
                    @php $rate_all = ($list->rate_1 + $list->rate_2 + $list->rate_3)@endphp
                    <td colspan="2" class="text-center" data-toggle="tooltip" data-placement="bottom" title="{{ $rate_all }} คะแนน">
                        <p>{{ $list->rate_user }}</p>
                        <p>{{ DateTimeThai($list->rate_date) }}</p>
                        @php
                            $rate = $rate_all / 3;
                            $i = 1; while ($i <= $rate) { 
                                echo "<p class='fa fa-star text-yellow'></p>";$i++; 
                            }
                        @endphp
                    </td>
                </tr>
            </table>
        </div>
        @endif
    </div>
</div>

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
