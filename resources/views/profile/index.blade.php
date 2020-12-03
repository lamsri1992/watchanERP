@extends('layouts.app')

@section('content')
@include('users.partials.header', [
'title' => __('สวัสดี') . ' คุณ'. Auth::User()->name,
'class' => 'col-lg-12'
])

<div class="container-fluid mt--7">
    <div class="row">
        @include('profile.profile')
        @include('profile.edit')
    </div>
    @include('layouts.footers.auth')
</div>
@endsection