<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo.png" class="navbar-brand-img"
                alt="WATCHAN ERP"> WATCHAN :: ERP
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder"
                                src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">
                            {{ __('ยินดีต้อนรับ!') }}
                        </h6>
                    </div>
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('ข้อมูลส่วนตัว') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power"></i>
                        <span>{{ __('ออกจากระบบ') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li
                    class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-tachometer-alt text-primary"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            <h6 class="navbar-heading text-muted">เมนูระบบ</h6>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-office" data-toggle="collapse" role="button" aria-controls="navbar-office">
                        <i class="far fa-folder-open text-success"></i>
                        <span
                            class="nav-link-text">{{ __('งานบริหารทั่วไป') }}
                        </span>
                    </a>
                    <div class="collapse {{ (request()->is('leave*','note*','worktime*')) ? 'show' : '' }}" id="navbar-office">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('leave*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/leave">
                                    {{ __('ระบบวันลาออนไลน์') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('note*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/note">
                                    {{ __('ระบบขออนุมัติเดินทาง') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('worktime*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/worktime">
                                    {{ __('ระบบบันทึกเวลาเข้างาน') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-repair" data-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="navbar-repair">
                        <i class="fas fa-wrench text-dark"></i>
                        <span
                            class="nav-link-text">{{ __('ระบบงานแจ้งซ่อม') }}
                        </span>
                    </a>
                    <div class="collapse {{ (request()->is('helpdesk*')) ? 'show' : '' }}" id="navbar-repair">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('helpdesk*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/helpdesk">
                                    {{ __('แจ้งซ่อมคอมพิวเตอร์') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    {{ __('แจ้งงานซ่อมทั่วไป') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('hr')) ? 'active' : '' }}">
                    <a class="nav-link" href="/hr">
                        <i class="fas fa-users text-warning"></i> ฐานข้อมูลบุคลากร
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-download text-info"></i> ดาวน์โหลดแบบฟอร์ม
                    </a>
                </li>
            </ul>
            {{-- Unit Head --}}
            @if (isset(Auth::user()->permission))
            <hr class="my-3">
            <h6 class="navbar-heading text-muted">ระบบอนุมัติวันลา</h6>
            <ul class="navbar-nav mb-md-3">
                @if (Auth::user()->permission == 1 || Auth::user()->permission == 4)
                <li class="nav-item {{ (request()->is('approve*')) ? 'active' : '' }}">
                    <a class="nav-link" href="/approve">
                        <i class="far fa-calendar"></i> สำหรับหัวหน้าฝ่าย
                    </a>
                </li>
                @endif
                @if (Auth::user()->permission == 2 || Auth::user()->permission == 4)
                <li class="nav-item {{ (request()->is('authorize*')) ? 'active' : '' }}">
                    <a class="nav-link" href="/authorize">
                        <i class="far fa-calendar-check"></i> สำหรับผู้อำนวยการ
                    </a>
                </li>
                @endif
                @if (Auth::user()->permission == 3 || Auth::user()->permission == 4)
                <li class="nav-item {{ (request()->is('hrm*')) ? 'active' : '' }}">
                    <a class="nav-link" href="/hrm/dashboard">
                        <i class="far fa-calendar-alt"></i> ผู้ดูแลระบบงานบุคลากร
                    </a>
                </li>
                @endif
            </ul>
            @endif
            {{-- End --}}
            <hr class="my-3">
            <h6 class="navbar-heading text-muted">คู่มือการใช้งาน</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
