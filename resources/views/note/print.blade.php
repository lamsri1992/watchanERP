<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>เลขที่หนังสือ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/font_sarabun.css">
    {{-- <style type="text/css">
        body {
            overflow: hidden;
        }
    </style> --}}
</head>
    <body>
        <div id="body" class="n">
            <div style="margin:0px auto;width:210mm;background-color: #ffffff;" class="page_breck">
                <img src="{{ asset('img') }}/thai_government.png" style="width:21mm;margin-top: 60px;margin-left: 60px;">
                <div style="font-size: 22px;font-weight:bold;width:350px;margin-left:350px;margin-top: -30px;">บันทึกข้อความ
                </div>
                <div style="margin-left:60px;margin-top: 50px;"><b>ส่วนราชการ</b>
                    <div class="div_edit" id="div_edit1"
                        style="width:580px;height:30px; solid #000000;margin-left: 100px;margin-top:-26px;">
                        โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา โทร 0-53484010
                    </div>
                </div>
                <div style="margin-left:60px;margin-top: 3px;"><b>ที่</b>
                    <div class="div_edit" id="div_edit2"
                        style="width:300px;height:30px; solid #000000;margin-left: 50px;margin-top:-26px;">
                        เลขที่หนังสือ
                    </div>
                    <div style="margin-left: 400px;margin-top: -28px;"><b>วันที่</b>
                        <div class="div_edit" id="div_edit3"
                            style="width:300px;height:30px; solid #000000;margin-left: 40px;margin-top:-26px;">
                            วันที่แบบเต็ม
                        </div>
                    </div>
                </div>
                <div style="margin-left:60px;"><b>เรื่อง</b>
                    <div class="div_edit" id="div_edit4"
                        style="width:630px;height:30px; solid #000000;margin-left: 50px;margin-top:-26px;">
                        ขออนุมัติเดินทางไปราชการ
                    </div>
                </div>
                <hr>
                <div style="margin-left:60px;margin-top:20px;"><b>เรียน</b>
                    <div style="width:630px;height:30px;margin-left: 50px;margin-top:-26px;">
                        ผู้อำนวยการโรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
                    </div>
                </div>
                <div style="margin-left:60px;margin-top:20px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ข้าพเจ้า&nbsp;&nbsp;&nbsp;&nbsp;
                    ชื่อผู้ทำรายการ
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    ตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;
                    ชื่อตำแหน่ง
                </div>
                <div style="margin-left:60px;margin-top:10px;">
                    ฝ่าย&nbsp;&nbsp;&nbsp;&nbsp;
                    ชื่อฝ่าย
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา พร้อมด้วยผู้มีรายชื่อดังต่อไปนี้
                </div>
                <div style="margin-left:110px;margin-top:10px;">
                    <table width="85%">
                        <tr>
                            <td class="b">
                               ผู้ร่วมเดินทาง
                            </td>
                            <td class="b">
                                ตำแหน่ง ผู้ร่วมเดินทาง
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="margin-left:111px;margin-top:10px;">
                    มีความประสงค์ขออนุมัติไปราชการ
                </div>
                <div style="margin-left:60px;margin-top:10px;">
                    ที่ <span class="b">สถานที่</span>
                </div>
                <div style="margin-left:60px;margin-top:10px;">
                    เพื่อปฏิบัติราชการ <span class="b">เรื่อง</span>
                </div>
                <div class="b" style="margin-left:60px;margin-top:10px;">
                    ใน วันที่เริ่ม - สิ้นสุด
                </div>
                <div style="margin-left:60px;margin-top:10px;">
                    จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ โดยขอเบิกค่าใช้จ่ายในเดินทางไปราชการครั้งนี้ตามระเบียบฯ ของทางราชการ
                </div>
                <div style="margin-left:450px;margin-top:40px;">
                    <table width="300px">
                        <tr>
                            <td>(ลงชื่อ)</td>
                        </tr>
                        <tr class="text-center">
                            <td>( ชื่อผู้ทำรายการ )</td>
                        </tr>
                        <tr class="text-center">
                            <td>ตำแหน่ง ชื่อตำแหน่ง</td>
                        </tr>
                    </table>
                </div>
                <div style="margin-left:60px;margin-top:40px;">
                    <table width="675px">
                        <tr style="text-decoration:underline;font-size:18px" class="b text-center">
                            <td>ความคิดเห็นของหัวหน้าฝ่าย</td>
                            <td>ความคิดเห็นของผู้บังคับบัญชา</td>
                        </tr>
                        <tr class="text-center">
                            <td>เรียน ผู้อำนวยการโรงพยาบาลฯ</td>
                            <td>
                                <input type="radio"> อนุมัติ
                                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                <input type="radio"> ไม่อนุมัติ
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>.................................................................</td>
                            <td>.................................................................</td>
                        </tr>
                        <tr class="text-center">
                            <td>.................................................................</td>
                            <td>.................................................................</td>
                        </tr>
                        <tr>
                            <td>(ลงชื่อ)</td>
                            <td>(ลงชื่อ)</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                ชื่อหัวหน้า
                            </td>
                            <td>( นายประจินต์ เหล่าเที่ยง )</td>
                        </tr>
                        <tr class="text-center">
                            <td>ตำแหน่ง ชื่อตำแหน่งหัวหน้า</td>
                            <td>ผู้อำนวยการโรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print()
    </script>
</html>