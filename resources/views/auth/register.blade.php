@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row text-center">
            <div class="col-lg-12">
                <h1 class="text-white">ระบบนี้ยังไม่เปิดให้บริการ</h1>
                <small>
                    <a href="login" class="text-dark">กลับไปหน้าเข้าสู่ระบบ</a>
                </small>
            </div>
        </div>
    </div>
@endsection
