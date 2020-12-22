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
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#addLeave">
                                <i class="far fa-edit"></i> ขออนุมัติวันลา
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-light btn-block">
                                รอการอนุมัติ <span class="badge badge-light text-white">0</span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-light btn-block">
                                รอดำเนินการ <span class="badge badge-light text-white">0</span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-block">
                                อนุมัติแล้ว <span class="badge badge-success text-white">0</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="ls-1 mb-1">
                        <i class="fa fa-history"></i> ประวัติการลางาน
                    </h6>
                    <table id="leave_list" class="table display" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">รหัสรายการ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ประเภทการลา</th>
                                <th class="text-center">วันที่ลา</th>
                                <th class="text-center">วันที่สิ้นสุด</th>
                                <th class="text-center">จำนวน (วัน)</th>
                                <th class="text-center">ผู้รับผิดชอบงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $res)                                
                            <tr>
                                <td class="text-center">{{ "HR-".$res->leave_id }}</td>
                                <td class="text-center">
                                    {{ $res->leave_status }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_type }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_start }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_end }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_num }}
                                </td>
                                <td class="text-center">
                                    {{ $res->leave_stead }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- New Leave Modal -->
<div class="modal fade" id="addLeave" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> ขออนุมัติวันลา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addLeave">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-12 control-label">ประเภทการลา</label>
                        <div class="col-md-12">
                            <select name="ltype" class="custom-select" required>
                                <option value="">เลือกประเภทการลา</option>
                                <option value="1">- ลากิจ</option>
                                <option value="2">- ลาป่วย</option>
                                <option value="3">- ลาพักผ่อน</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-12 control-label">ระยะเวลา</label>
                        <div class="col-md-12">
                            <select name="ltime" class="custom-select" required>
                                <option value="">เลือกระยะเวลา</option>
                                <option value="1">- เต็มวัน (8.00น. - 16.00น.)</option>
                                <option value="2">- ครึ่งเช้า (8:00น. - 12:00น.)</option>
                                <option value="3">- ครึ่งบ่าย (12.00น. - 16.00น.)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="dateStr" name="dstart" type="text" class="form-control input-md"
                                placeholder="วันที่ลา" readonly required>
                        </div>
                        <div class="col-md-6">
                            <input id="dateEnd" name="dend" type="text" class="form-control input-md"
                                placeholder="วันที่สิ้นสุด" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 control-label">หมายเหตุ</label>
                        <div class="col-md-12">
                            <textarea name="leave_note" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 control-label">ผู้รับผิดชอบงานระหว่างลา</label>
                        <div class="col-md-12">
                            <select class="js-single" name="leave_stead" required>
                                <option></option>
                                @php
                                    foreach ($uname as $arr){ echo "<option value='".$arr->name."'>".$arr->name."</option>"; }
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSave" type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i>
                        บันทึกรายการ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#leave_list').dataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            searching: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
        });
    });

    $(document).ready(function() {
        $('.js-single').select2({
            width: '100%',
            placeholder: "เลือกผู้รับผิดชอบงานแทน",
            allowClear: true
        });
    });

    // datePicker
$(function() {
    $.datetimepicker.setLocale('th');
    var dt = new Date();
    dt.setDate(dt.getDate() + 3);
    $("#dateStr").datetimepicker({
        format: 'Y/m/d',
        timepicker: false,
        lang: 'th',
        minDate: dt,
        onShow: function(ct) {
            this.setOptions({
                maxDate: jQuery('#dateEnd').val() ? jQuery('#dateEnd').val() : false
            })
        },
        beforeShowDay: function(date) {
            var day = date.getDay();
            return [day == 1 || day == 2 || day == 3 || day == 4 || day == 5, ""];
        }
    });
    $("#dateEnd").datetimepicker({
        format: 'Y/m/d',
        timepicker: false,
        lang: 'th',
        minDate: dt,
        onShow: function(ct) {
            this.setOptions({
                minDate: jQuery('#dateStr').val() ? jQuery('#dateStr').val() : false
            })
        },
        beforeShowDay: function(date) {
            var day = date.getDay();
            return [day == 1 || day == 2 || day == 3 || day == 4 || day == 5, ""];
        }
    });
});

</script>
@endsection
