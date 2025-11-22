@extends('admin.index')
@section('body')
    <div class="content-wrapper">
        <section class="content-header text-sm">
            <div class="container-fluid">
                <div class="row">
                    <ol class="breadcrumb float-sm-left pl-3">
                        <li class="breadcrumb-item"><a href="{{ route('page-admin-home') }}" title="Bảng điều khiển">Bảng điều
                                khiển</a></li>
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="flex_statistical">
                    <a href="{{ route('do-admin-statistic', ['type' => 'order']) }}">
                        <div class="item_statistical text-center btn btn-sm bg-gradient-primary">
                            <div class="content_statistical">
                                <p class="text-white">Xuất file excel danh sách hoá đơn</p>
                            </div>
                            <div class="img_statistical">
                                <img src="{{ asset('assets/admin/images/download-to-storage-drive.png') }}" alt="Tải file">
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
