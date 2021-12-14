<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap" rel="stylesheet">
    <title>ใบรับรองการจ่ายเงินเดือน โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา</title>
</head>

<style>
    body {
        font-family: 'Sarabun', sans-serif;
    }

</style>

<body>
    <div class="container">
        <div class="" style="margin-top: 1rem;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-title" style="font-weight: bold;">
                                        โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
                                    </p>
                                    <p class="card-title" style="font-weight: bold;">
                                        ประจำเดือน {{ MonthThai(date($data->year."-".$data->month))." ".$data->year }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-title" style="font-weight: bold;">
                                        {{ "ชื่อ - สกุล : ".$data->name }}
                                    </p>
                                    <p class="card-title" style="font-weight: bold;">
                                        {{ "ตำแหน่ง : ".$data->position }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @php 
                            $income = $data->salary + $data->pos_incom + $data->son + $data->school + $data->ot 
                                    + $data->health + $data->store + $data->life + $data->other_income;
                            $outcome = $data->tax + $data->co_ordinate + $data->dead + $data->car + $data->house 
                                    + $data->trat_store + $data->save_life + $data->water_elect + $data->other_pay
                                    + $data->p5 + $data->p7;
                            $total = $income - $outcome;
                        @endphp
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6" style="font-size: 14px;">
                                    <h6 style="font-weight: bold;">รายรับ</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>เงินเดือน</td>
                                            <td>{{ number_format($data->salary,2) }}</td>
                                            <td>(ตกเบิก) ปีใหม่</td>
                                            <td>{{ number_format($data->sal_1,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>เงินเดือนตกเบิก</td>
                                            <td>{{ number_format($data->pos_incom,2) }}</td>
                                            <td>เงินช่วยเหลือบุตร</td>
                                            <td>{{ number_format($data->son,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>ค่ารักษาพยาบาล</td>
                                            <td>{{ number_format($data->health,2) }}</td>
                                            <td>เบี้ยเลี้ยงเหมาจ่าย</td>
                                            <td>{{ number_format($data->life,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>ค่าไม่ทำเวชฯ</td>
                                            <td>{{ number_format($data->store,2) }}</td>
                                            <td>เงิน พ.ต.ส.</td>
                                            <td>{{ number_format($data->ot,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>ค่าช่วยเหลือการศึกษาบุตร</td>
                                            <td>{{ number_format($data->school,2) }}</td>
                                            <td>ค่าครองชีพฯ</td>
                                            <td>{{ number_format($data->other_income,2) }}</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>รวมรายรับ</td>
                                            <td colspan="3">
                                                {{ number_format($income,2) }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6" style="font-size: 14px;">
                                    <h6 style="font-weight: bold;">รายจ่าย</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>ภาษีหัก ณ ที่จ่าย</td>
                                            <td>{{ number_format($data->tax,2) }}</td>
                                            <td>ฌกส.</td>
                                            <td>{{ number_format($data->dead,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>สหกรณ์ออมทรัพย์</td>
                                            <td>{{ number_format($data->co_ordinate,2) }}</td>
                                            <td>รถตามโครงการฯ</td>
                                            <td>{{ number_format($data->car,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>ธกส.</td>
                                            <td>{{ number_format($data->trat_store,2) }}</td>
                                            <td>ค่าน้ำ/ค่าไฟฟ้า</td>
                                            <td>{{ number_format($data->water_elect,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>ปกส.</td>
                                            <td>{{ number_format($data->save_life,2) }}</td>
                                            <td>ภาษีหัก ณ ที่จ่าย</td>
                                            <td>{{ number_format($data->sav_1,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>เบี้ยประกันชีวิต</td>
                                            <td>{{ number_format($data->p7,2) }}</td>
                                            <td>ธนาคารออมสิน</td>
                                            <td>{{ number_format($data->house,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>กองทุนสำรองเลี้ยงชีพ</td>
                                            <td>{{ number_format($data->p5,2) }}</td>
                                            <td>กองทุนศพ</td>
                                            <td>{{ number_format($data->other_pay,2) }}</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>รวมรายจ่าย</td>
                                            <td colspan="3">
                                                {{ number_format($outcome,2) }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // window.print();
    </script>
</body>

</html>
