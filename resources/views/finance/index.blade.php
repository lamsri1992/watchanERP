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
                    <div class="col-md-12">
                        <form id="frmImport" method="POST" enctype="multipart/form-data" action="{{ url('finance/import') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <h1><i class="fa fa-cloud-upload-alt"></i> อัพโหลดข้อมูลเงินเดือน</h1>
                                </div>
                                <div class="col-md-12" style="margin-top: 0.5rem;">
                                    <div class="custom-file">
                                        <input id="select-file" name="select-file" type="file" class="custom-file-input" required>
                                        <label class="custom-file-label" for="select-file">เลือกไฟล์ที่จะอัพโหลด </label>
                                        <small class="text-danger">(ไฟล์นามสกุล .xlsx หรือ .xls เท่านั้น สามารถดูได้จากคู่มือการอัพโหลด)</small>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 0.5rem;">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> อัพโหลดไฟล์</button>
                                    @if (count($salog) > 0)
                                    <div class="">
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
                        </form>
                    </div>
                </div>
               <div class="card-body">
                <table id="datatableBasic" class="table table-borderless table-striped"
                    style="border-collapse: collapse; border-radius: 4px; overflow: hidden;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>เจ้าหน้าที่</th>
                            <th>ตำแหน่ง</th>
                            <th>Book Bank</th>
                            <th class="text-right">เงินเดือน</th>
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
                            <td class="text-right">{{ number_format($res->salary,2) }} ฿</td>
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
    </div>
</div>
@include('layouts.footers.auth')
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
