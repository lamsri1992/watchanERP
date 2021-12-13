<div class="col-xl-5 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('img') }}/employee/{{ $data->barcode }}.jpg">
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div style="margin-top: 35%;">
                    <div class="h5 mt-2">
                        <a href="#">
                            <i class="fa fa-camera"></i> อัพโหลดรูปโปรไฟล์
                        </a>
                    </div>
                    <span class="font-weight-light">{{ $data->barcode }}</span>
                    <div class="h3 mt-2">
                        {{ $data->name }}
                    </div>
                    <div class="h4 mt-2">
                        ตำแหน่ง : {{ $data->position }}
                    </div>
                    <div class="h5 font-weight-300">
                        {{ $data->dept_name }}
                    </div>
                    <div class="h5 font-weight-300">
                        <span style="font-weight: bold;">เลขบัญชีธนาคาร</span> {{ $data->acc_no }}
                    </div>
                </div>
            </div>
            <div style="margin-top: 10%;">
                <div class="h5 font-weight-200">
                    ข้อมูลการปฏิบัติงาน
                </div>
                <table class="table table-sm">
                    <tr>
                        <th>ประเภทบุคลากร</th>
                        <td>{{ $data->job_name }}</td>
                    </tr>
                    <tr>
                        <th>วันที่เริ่มงาน/บรรจุ</th>
                        <td>{{ DateThai($data->work_start) }}</td>
                    </tr>
                    <tr>
                        <th>สถานะการปฏิบัติงาน</th>
                        <td>{{ $data->work_status = 'work' ? 'ปฏิบัติงาน' : 'ลาออก/โอนย้าย' }}
                        </td>
                    </tr>
                    <tr>
                        <th>ผู้บังคับบัญชา</th>
                        <td>{{ $unit->name }}</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 10%;">
                <div class="h5 font-weight-200">
                    สิทธิ์วันลา
                </div>
                <table class="table table-sm">
                    <tr>
                        <th>ลากิจ</th>
                        <td>{{ $data->busy }}</td>
                    </tr>
                    <tr>
                        <th>ลาป่วย</th>
                        <td>{{ $data->sick }}</td>
                    </tr>
                    <tr>
                        <th>ลาพักผ่อน</th>
                        <td>{{ $data->balance_new }}</td>
                    </tr>
                </table>
            </div>
            <div class="text-center" style="margin-top: 10%;">
                <small class="text-gray"><i class="far fa-question-circle"></i>
                    หากข้อมูลไม่ถูกต้องกรุณาแจ้งงานบริหาร
                </small>
            </div>
        </div>
    </div>
</div>
