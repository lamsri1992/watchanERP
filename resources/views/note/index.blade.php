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
                                data-target="#addNew">
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
                                    {{ $res->note_id }}
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
                                    <a href="{{ route('note.print') }}" target="_blank" class='badge badge-primary'>
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
                    url: "{{ route('helpdesk.addHelpdesk') }}",
                    data: $('#addFrm').serialize(),
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
</script>
@endsection
