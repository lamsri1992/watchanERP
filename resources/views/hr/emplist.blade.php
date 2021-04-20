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
                                <i class="fa fa-user-cog"></i> HR Administrator : ผู้ดูแลระบบงานบุคลากร
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 style="margin-bottom:1rem;">
                        <i class="fa fa-database"></i> ข้อมูลเจ้าหน้าที่ทั้งหมด
                    </h4>
                    <table id="emplist_table" class="table display nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">BID</th>
                                <th>ชื่อ/สกุล</th>
                                <th>ฝ่าย/กลุ่มงาน</th>
                                <th>ตำแหน่ง</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $emps)
                            <tr>
                                <td class="text-center">{{ $emps->barcode }}</td>
                                <td>{{ $emps->name }}</td>
                                <td>{{ $emps->dept_name }}</td>
                                <td>{{ $emps->position }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $emps->ws_text }} btn-block">
                                        <i class="fa fa-{{ $emps->ws_icon }}"></i>&nbsp;
                                        {{ $emps->ws_name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="badge badge-info btn-block">
                                       <i class="fa fa-search"></i>&nbsp;
                                       เพิ่มเติม
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
        $('#emplist_table').dataTable({
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        scrollX: true,
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
        },
         initComplete: function() {
            this.api().columns([2, 3]).every(function() {
                var column = this;
                var select = $(
                        '<select class=""><option value="">แสดงทั้งหมด</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.cells('', column[0]).render('display').sort().unique().each(function(
                    d, j) {
                    select.append('<option value="' + d + '">- ' + d + '</option>')
                });
            });
        }
    });
});
</script>
@endsection
