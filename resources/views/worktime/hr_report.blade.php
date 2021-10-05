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
                                        <li class="breadcrumb-item">
                                            <a href="/hrm/worktime">
                                                ระบบบันทึกเวลาเข้างาน
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">รายงาน : {{ getMonth(date("Y")."-".$_REQUEST['month']) }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        $date_data_check=date("Y")."-".$_REQUEST['month']."-";
                        $num_month_day=date("t",strtotime(date("Y")."-".$_REQUEST['month']."-01"));
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
                    <h1><i class="fa fa-calendar-day"></i> {{ getMonth(date("Y")."-".$_REQUEST['month']) }}</h1>
                    <table id="reportTable" class="compact table table-borderless nowrap table-striped"
                     style="width: 100%; font-size: 14px; position: relative;">
                     <thead class="thead-dark">
                         <tr>
                             <th class="text-center">#</th>
                             <th class="">ชื่อ-สกุล</th>
                             <?php for($i=1;$i<=$num_month_day;$i++){?>
                             <?php 
                                 $days = date('w', strtotime("".date("Y")."-".$_REQUEST['month']."-".$i.""));
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
    @include('layouts.footers.auth')
</div>

@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function() {
    var table = $('#reportTable').DataTable({
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
