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
                                <i class="far fa-clock"></i> Time attendance record
                            </h6>
                            <div class="mb-0">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">
                                                <i class="fas fa-user-cog"></i> ผู้ดูแลระบบงานบุคลากร
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">ระบบบันทึกเวลาเข้างาน</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="daily-tab" data-toggle="pill" href="#daily" role="tab" aria-controls="daily" aria-selected="true">รายงานประจำวัน</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="table-tab" data-toggle="pill" href="#table" role="tab" aria-controls="table" aria-selected="false">รายงานรูปแบบตาราง</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                            @php $curdate = date('Y-m-d'); @endphp
                            <h1><i class="fa fa-calendar-day"></i> {{ FullDateTimeThai($curdate) }}</h1>
                            <table id="time_table" class="table table-sm table-striped compact" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>WID</th>
                                        <th><i class="far fa-clock"></i> เวลาเข้างาน</th>
                                        <th>ชื่อ - สกุล</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ฝ่าย/งาน</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <th>WID</th>
                                        <th><i class="far fa-clock"></i> เวลาเข้างาน</th>
                                        <th>ชื่อ - สกุล</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ฝ่าย/งาน</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="table" role="tabpanel" aria-labelledby="table-tab">
                            <?php
                                $date_data_check=date("Y")."-".date("m")."-";
                                $num_month_day=date("t",strtotime(date("Y")."-".date("m")."-01"));
                                $use_month_check = $date_data_check;        
                                $start_date_check = $date_data_check."01";
                                $end_date_check = $date_data_check.$num_month_day;
                                if($result){
                                    $array = json_decode(json_encode($result), true);
                                    foreach($array as $row){
                                        if(isset($data_arr[$row['name']][$row['date_s']])){
                                            $data_arr[$row['name']][$row['date_s']]+=$row['work_status'];
                                        }else{
                                            $data_arr[$row['name']][$row['date_s']]=$row['work_status'];
                                        }
                                    }
                                }
                            ?>
                             <table id="reportTable" class="compact table table-borderless nowrap table-striped"
                             style="width: 100%; font-size: 14px; position: relative;">
                             <thead class="thead-dark">
                                 <tr>
                                     <th class="text-center">#</th>
                                     <th class="">ชื่อ-สกุล</th>
                                     <?php for($i=1;$i<=$num_month_day;$i++){?>
                                     <?php 
                                         $days = date('w', strtotime("".date("Y")."-".date("m")."-".$i.""));
                                             if($days == 0 or $days == 6){
                                                 $bg = "red";
                                                 $fg = "white";
                                             }else{
                                                 $bg = "";
                                                 $fg = "";
                                             }
                                     ?>
                                     <th class="text-center" style="background-color:<?=$bg;?>;color:<?=$fg;?>;">
                                         <?=$i;?>
                                     </th>
                                     <?php } ?>
                                 </tr>
                             </thead>
                             <?php
                                 if($data_arr){
                                     $num = 0;
                                     $total_data = count($data_arr);
                                         foreach($data_arr as $k_item=>$v_data){ $num++; ?>
                                 <tr>
                                     <td class="text-center"><?=$num;?></td>
                                     <td><?=$k_item?></td>
                                     <?php for($i=0;$i<$num_month_day;$i++){ ?>
                                 <td class="text-center">
                                     <?php
                                     $key_date = date("Y-m-d",strtotime($start_date_check." +$i day"));
                                         if(isset($v_data["$key_date"])&&$v_data["$key_date"]==1){
                                         echo "<span class='badge badge-success' style='font-size:10px;'>เข้างาน</span>";
                                         }
                                     ?>
                                 </td>
                                 <?php } ?>
                             </tr>
                             <?php } } ?>
                         </table>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#time_table').dataTable( {
        ajax: {
            url: "../api/time_api",
            dataSrc: ""
        },
        columns: [
            { 'data': 'work_id', className: "text-center" },
            { 'data': 'work_time', className: "text-center" },
            { 'data': 'name' },
            { 'data': 'position' },
            { 'data': 'dept_name' },
            { 'data': 'time_name', className: "text-center" },
        ],
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
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
        },
         initComplete: function() {
            this.api().columns([3,4,5]).every(function() {
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
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
});

$(document).ready(function() {
    var table = $('#reportTable').DataTable({
        responsive: true,
        scrollX: true,
        autoWidth: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        pageLength: 20,
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        ordering: false,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel',
            text: '<i class="fa fa-file-excel"></i> บันทึกเป็นไฟล์ Excel',
            className: "btn btn-success btn-sm",
        }],
    });
});
</script>
@endsection
