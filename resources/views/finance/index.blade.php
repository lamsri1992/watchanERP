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
                                <i class="fa fa-database"></i> FINANCIAL SYSTEM : ระบบงานการเงิน
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-salary-tab" data-toggle="pill" 
                            href="#pills-salary" role="tab" aria-controls="pills-salary" aria-selected="true">
                            ข้อมูลเงินเดือนเจ้าหน้าที่
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" 
                            href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                            ข้อมูลค่าล่วงเวลาเจ้าหน้าที่
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-salary" role="tabpanel" aria-labelledby="pills-salary-tab">
                            <div class="col-md-12 jumbotron">
                                <div class="row" style="margin-bottom: 1rem;">
                                    <div class="col-md-6">
                                        <h1>
                                            <i class="fa fa-money-check-alt"></i> ข้อมูลเงินเดือน
                                            <small class="text-muted">พนักงานกระทรวง , ลูกจ้างเหมาบริการ</small>
                                        </h1>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#import">
                                            <i class="fa fa-cloud-upload-alt"></i> นำเข้าข้อมูลเงินเดือน
                                        </button>
                                    </div>
                                </div>
                                <table id="datatableBasic" class="table table-borderless table-striped"
                                    style="border-collapse: collapse; border-radius: 4px; overflow: hidden;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>เจ้าหน้าที่</th>
                                            <th>ตำแหน่ง</th>
                                            <th>Book Bank</th>
                                            <th class="text-center">ปี</th>
                                            <th class="text-center">เดือน</th>
                                            <th class="text-center"><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach ($result as $res)
                                        @php $i++; @endphp
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $res->name }}</td>
                                            <td>{{ $res->position }}</td>
                                            <td>{{ $res->acc_no }}</td>
                                            <td class="text-center">{{ $res->year }}</td>
                                            <td class="text-center">{{ MonthThai(date('Y-'.$res->month.'-d')) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-outline-info btn-sm btn-block">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="col-md-12 jumbotron">
                                <div class="row" style="margin-bottom: 1rem;">
                                    <div class="col-md-6">
                                        <h1>
                                            <i class="fa fa-money-check-alt"></i> ข้อมูลค่าล่วงเวลาเจ้าหน้าที่
                                            <small class="text-muted">ทุกประเภทบุคลากร</small>
                                        </h1>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#importOT">
                                            <i class="fa fa-cloud-upload-alt"></i> นำเข้าข้อมูลค่าล่วงเวลา
                                        </button>
                                    </div>
                                </div>
                                <table id="datatableBasic2" class="table table-borderless table-striped"
                                    style="border-collapse: collapse; border-radius: 4px; overflow: hidden;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>เจ้าหน้าที่</th>
                                            <th>ตำแหน่ง</th>
                                            <th>ประเภท</th>
                                            <th>Book Bank</th>
                                            <th class="text-center">ปี</th>
                                            <th class="text-center">เดือน</th>
                                            <th class="text-center"><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach ($ot as $ots)
                                        @php $i++; @endphp
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>{{ $ots->name }}</td>
                                            <td>{{ $ots->position }}</td>
                                            <td>{{ $ots->job_name }}</td>
                                            <td>{{ $ots->acc_no }}</td>
                                            <td class="text-center">{{ $ots->year }}</td>
                                            <td class="text-center">{{ MonthThai(date('Y-'.$ots->month.'-d')) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-outline-info btn-sm btn-block">
                                                    <i class="fa fa-info-circle"></i>
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
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<!-- Modal -->
<div class="modal fade" id="import" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel"><i class="fa fa-cloud-upload-alt"></i> นำเข้าข้อมูลเงินเดือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmImport" method="POST" enctype="multipart/form-data" action="{{ url('finance/import') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input id="select-file" name="select-file" type="file" class="custom-file-input" required>
                                <label class="custom-file-label" for="select-file">เลือกไฟล์ที่จะอัพโหลด </label>
                                <small class="text-danger">(ไฟล์นามสกุล .xlsx หรือ .xls เท่านั้น สามารถดูได้จากคู่มือการอัพโหลด)</small>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> อัพโหลดไฟล์</button>
                            </div>
                        </div>
                    </div>
                </form>
                @if (count($salog) > 0)
                <div class="" style="margin-top: 1rem;">
                    <small>ประวัติการอัพโหลด</small>
                    <ul>
                        @foreach ($salog as $sals)
                        <li>
                            <small class="text-muted">{{ $sals->sal_file }} / {{ $sals->create_at }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importOT" tabindex="-1" aria-labelledby="importOTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importOTModalLabel"><i class="fa fa-cloud-upload-alt"></i> นำเข้าข้อมูลค่าล่วงเวลา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmImportOT" method="POST" enctype="multipart/form-data" action="{{ url('finance/importOT') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input id="select-file" name="select-file" type="file" class="custom-file-input" required>
                                <label class="custom-file-label" for="select-file">เลือกไฟล์ที่จะอัพโหลด </label>
                                <small class="text-danger">(ไฟล์นามสกุล .xlsx หรือ .xls เท่านั้น สามารถดูได้จากคู่มือการอัพโหลด)</small>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> อัพโหลดไฟล์</button>
                            </div>
                        </div>
                    </div>
                </form>
                @if (count($salog) > 0)
                <div class="" style="margin-top: 1rem;">
                    <small>ประวัติการอัพโหลด</small>
                    <ul>
                        @foreach ($salog as $sals)
                        <li>
                            <small class="text-muted">{{ $sals->sal_file }} / {{ $sals->create_at }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#frmImport').on("submit", function (event) {
        let timerInterval
        Swal.fire({
        title: 'กำลังทำการ Upload',
        timer: 1000000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
        })
    });

    $('#frmImportOT').on("submit", function (event) {
        let timerInterval
        Swal.fire({
        title: 'กำลังทำการ Upload',
        timer: 1000000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
        })
    });
</script>
@if ($message = Session::get('success'))
<script>
    Swal.fire({
       position: 'top-center',
       icon: 'success',
       title: '{{ $message }}',
       showConfirmButton: false,
       timer: 3000
       })
</script>
@endif
<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
