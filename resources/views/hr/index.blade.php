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
                                <i class="fa fa-database"></i> HR DATABASE : ฐานข้อมูลบุคลากร
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="hr_table" class="table display nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th><i class="far fa-address-card"></i> ID</th>
                                <th>ชื่อ - สกุล</th>
                                <th>กลุ่มงาน/หน่วยบริการ</th>
                                <th>ตำแหน่ง</th>
                                <th><i class="fa fa-plus-circle"></i></th>
                            </tr>
                        </thead>
                        <tfoot class="thead-dark">
                            <tr>
                                <th><i class="far fa-address-card"></i> ID</th>
                                <th>ชื่อ - สกุล</th>
                                <th>กลุ่มงาน/หน่วยบริการ</th>
                                <th>ตำแหน่ง</th>
                                <th><i class="fa fa-plus-circle"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Modal -->
<div class="modal fade" id="hrModal" tabindex="-1" role="dialog" aria-labelledby="hrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="hrModalLabel"></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div id="x"></div>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th>ชื่อ - สกุล</th>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <th>กลุ่มงาน/หน่วยบริการ</th>
                            <td id="dept_name"></td>
                        </tr>
                        <tr>
                            <th>ตำแหน่ง</th>
                            <td id="position"></td>
                        </tr>
                        <tr>
                            <th>ประเภทบุคลากร</th>
                            <td id="job_name"></td>
                        </tr>
                        <tr>
                            <th>ที่อยู่</th>
                            <td id="address"></td>
                        </tr>
                        <tr>
                            <th>เบอร์โทร</th>
                            <td id="tel"></td>
                        </tr>
                        <tr>
                            <th>ผู้ติดต่อยามฉุกเฉิน</th>
                            <td id="person_name"></td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรผู้ติดต่อ</th>
                            <td id="person_tel"></td>
                        </tr>
                        <tr>
                            <th>ที่อยู่ผู้ติดต่อ</th>
                            <td id="person_address"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">ปิดหน้าต่าง</button>
        </div>
      </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#hr_table').dataTable( {
        ajax: {
            url: "api/hr_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'barcode', className: "text-center" },
            { 'data': 'name' },
            { 'data': 'dept_name', className: "text-center" },
            { 'data': 'position', className: "text-center" },
            { 'targets': -1, 'data': null, className: "text-center",
                'defaultContent': '<button class="btn btn-sm btn-success btn-block"><i class="fa fa-plus-circle"></i> เพิ่มเติม</button>'}
        ],
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
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

    var table = $('#hr_table').DataTable();
    $('#hr_table tbody').on('click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var img = document.createElement("img");
        if (data['img'] == null){
            img.src = "{{ asset('img') }}/user-profile.png";
        }else{
            img.src = "{{ asset('img') }}/employee/"+(data['img'])+"";
        }
            img.className = 'rounded img-fluid img-thumbnail';
        var src = document.getElementById("x");
            src.appendChild(img);
        // alert(data['name']);
        $("#hrModalLabel").text(data['barcode']);
        $("#name").text(data['name']);
        $("#position").text(data['position']);
        $("#dept_name").text(data['dept_name']);
        $("#job_name").text(data['job_name']);
        $("#address").text(data['address']);
        $("#tel").text(data['tel']);
        $("#person_name").text(data['person_name']);
        $("#person_tel").text(data['person_tel']);
        $("#person_address").text(data['person_address']);
        $("#hrModal").modal("show");
    });

    $(document).ready(function() {
        $("#hrModal").on("hidden.bs.modal", function() {
            $("#x").html("");
        });
    });
});
</script>
@endsection
