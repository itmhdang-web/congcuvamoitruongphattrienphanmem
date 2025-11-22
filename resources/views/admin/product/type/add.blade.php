@extends('admin.index')
@section('body')
    <div class="content-wrapper">
        <section class="content-header text-sm">
            <div class="container-fluid">
                <div class="row">
                    <ol class="breadcrumb float-sm-left pl-3">
                        <li class="breadcrumb-item"><a href="{{ route('page-admin-home') }}" title="Bảng điều khiển">Bảng điều
                                khiển</a></li>

                        <li class="breadcrumb-item"><a href="{{ route('page-admin-type-list') }}"
                                title="Quản lý loại sản phẩm">Quản lý loại sản phẩm</a></li>

                        <li class="breadcrumb-item active">Thêm mới loại sản phẩm</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <form class="validation-form" method="post" action="{{ route('do-admin-type-add') }}"
                    enctype="multipart/form-data">
                    <div class="card-footer text-sm sticky-top">
                        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                                class="far fa-save mr-2"></i>Lưu</button>
                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                            lại</button>
                        <a class="btn btn-sm bg-gradient-danger" href="{{ route('page-admin-type-list') }}" title="Thoát"><i
                                class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-default color-palette-box card-primary card-outline text-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin loại sản phẩm</h3>
                                </div>
                                <div class="card-body card-article">
                                    <div class="form-group title">
                                        <label for="name-product">Tên loại sản phẩm:</label>
                                        <input type="text" class="form-control for-seo text-sm" name="tendm"
                                            id="fullname" placeholder="Tên loại sản phẩm"
                                            @error('tendm') is-invalid @enderror>
                                        @error('tendm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </form>
            </div>
        </section>
    </div>
@endsection
