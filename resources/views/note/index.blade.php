@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card">
                <div class="card-header bg-traresparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="far fa-folder-open"></i> งานบริหารทั่วไป
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ขออนุมัติเดินทาง</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="" style="margin-bottom: 1rem;">
                        <h6 class="ls-1 mb-1">
                            <i class="fas fa-clipboard-list"></i> รายการขออนุมัติเดินทาง
                        </h6>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#addNewNote">
                                <i class="fas fa-shuttle-van"></i> ขออนุมัติเดินทาง
                            </button>
                        </div>
                    </div>
                    <table id="list_table" class="table display nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">NID</th>
                                <th class="text-center">ผู้ทำรายการ</th>
                                <th class="text-center">วันที่</th>
                                <th>เรื่อง</th>
                                <th>สถานที่</th>
                                <th class="text-center">พิมพ์แบบฟอร์ม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $res)
                            <tr>
                                <td class="text-center">
                                    <strong>{{ $res->note_no.$res->note_id }}</strong>
                                </td>
                                <td class="text-center">
                                    @foreach ($emplist as $name)
                                        @if ($res->note_emp == $name->id)
                                            {{ $name->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{ DateTimeThai($res->note_start)." - ".DateTimeThai($res->note_end) }}
                                </td>
                                <td>{{ $res->note_title }}</td>
                                <td>{{ $res->note_place }}</td>
                                <td class="text-center">
                                    <a href="{{ route('note.print',base64_encode($res->note_id)) }}" target="_blank" class='badge badge-success'>
                                        <i class='fa fa-print'></i> พิมพ์เอกสาร
                                    </a>
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

<!-- Modal -->
<div class="modal fade" id="addNewNote" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-plus-circle"></i> แบบฟอร์มขออนุมัติเดินทางไปราชการ
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addNote">
                <div class="modal-body">
                    <div class="form-group">
                        <table class="table table-bordered text-center" style="font-size:13px;">
                            <span style="font-size:14px;">ผู้ทำรายการ</span>
                            <tr>
                                <td>
                                    <b>ชื่อ-สกุล :</b>
                                    {{ Auth::user()->name }}
                                </td>
                                <td>
                                    <b>ตำแหน่ง :</b>
                                    {{ Auth::user()->position }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <span style="font-size:14px;">ระบุสถานที่</span>
                        <input type="text" name="place" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <span style="font-size:14px;">ระบุชื่อเรื่อง</span>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="dateStr" name="dstart" type="text" class="form-control input-md"
                                placeholder="วันที่ไป" readonly required>
                        </div>
                        <div class="col-md-6">
                            <input id="dateEnd" name="dend" type="text" class="form-control input-md"
                                placeholder="วันที่กลับ" readonly required>
                        </div>
                    </div>
                    <div class="form-group" style="font-size:14px;">
                        <span>รายชื่อผู้เข้าร่วม</span>
                        <select id="list" name="list[]" class="form-control" multiple="multiple" style="width:100%;">
                            @foreach ($emplist as $emps)
                            <option value="{{ $emps->id }}">{{ $emps->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> บันทึกรายการ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#list_table').dataTable( {
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        oLanguage: {
                sSearch: "<i class='fa fa-search'></i> ค้นหา : ",
                oPaginate: {
                    sFirst: '<small>หน้าแรก</small>',
                    sLast: '<small>หน้าสุดท้าย</small>',
                    sNext: '<small>ถัดไป</small>',
                    sPrevious: '<small>กลับ</small>'
                },
                sInfo: "<small>ทั้งหมด _TOTAL_ รายการ</small>",
                sLengthMenu: "<small>แสดง _MENU_ รายการ</small>",
        },
        order: [[ 0, 'asc' ]],
        scrollX: true,
    });
});

$('select').select2({
    createTag: function(params) {
        if (params.term.indexOf('@') === -1) {
            return null;
        }
        return {
            id: params.term,
            text: params.term
        }
    },
    placeholder: "ระบุผู้ร่วมเดินทาง",
});

$('#addNote').on("submit", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกรายการขออนุมัติเดินทาง ?',
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('note.addNote') }}",
                    data: $('#addNote').serialize(),
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกรายการขออนุมัติเดินทางสำเร็จ',
                            text: 'กรุณาพิมพ์เอกสาร แล้วส่งงานบริหาร',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        window.setTimeout(function () {
                            location.replace('/note')
                        }, 2900);
                    }
                });
            }
        })
    });

$(function() {
    $.datetimepicker.setLocale('th');
    var dt = new Date();
    dt.setDate(dt.getDate());
    $("#dateStr").datetimepicker({
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
        lang: 'th',
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
