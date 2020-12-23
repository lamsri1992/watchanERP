<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                @foreach ($count as $res)
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">จำนวนวันที่ลากิจ</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $res->busy == 0 ? 0 : $res->busy }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm text-center">
                                <small class="text-nowrap">การลากิจควรทำรายการล่วงหน้าอย่างน้อย 3 วันทำการ</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">จำนวนวันที่ลาป่วย</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $res->sick == 0 ? 0 : $res->sick }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-user-injured"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm text-center">
                                <small class="text-nowrap">การลาป่วยให้แจ้งในกลุ่ม <i class="fab fa-line text-success"></i> Watchan Family ทุกครั้ง</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">จำนวนวันที่ลาพักผ่อน</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $res->vacation == 0 ? 0 : $res->vacation }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-umbrella-beach"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm text-center">
                                <small class="text-nowrap">การลาพักผ่อนควรทำรายการล่วงหน้าอย่างน้อย 7 วันทำการ</small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
