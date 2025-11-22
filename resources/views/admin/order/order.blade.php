@extends('admin.index')
@section('body')
    <div class="content-wrapper">
        <section class="content-header text-sm">
            <div class="container-fluid">
                <div class="row">
                    <ol class="breadcrumb float-sm-left pl-3">
                        <li class="breadcrumb-item"><a href="{{ route('page-admin-home') }}" title="Bảng điều khiển">Bảng điều
                                khiển</a></li>
                        <li class="breadcrumb-item active">Quản lý đơn hàng</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Tìm kiếm đơn hàng</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('page-admin-order-search') }}" method="GET" id="form-order" class="row">
                            <div class="form-group col-md-3 col-sm-3">
                                <label>Tình trạng:</label>
                                <select id="select-status" name="select_status_order" class="form-control select2">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="pending">Mới Đặt</option>
                                    <option value="paid">Đã thanh toán</option>
                                    <option value="delivering">Đang giao</option>
                                    <option value="delivered">Đã giao</option>
                                    <option value="cancelled">Đã huỷ</option>
                                    <option value="completed">Hoàn tất</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label>Ngày đặt:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control float-right text-sm" name="order_date"
                                        id="order_date" value="">
                                </div>
                            </div>
                            <div class="form-group text-center mt-2 mb-0 col-12">
                                <button type="submit" class="btn btn-sm bg-gradient-success text-white btn-search-order"
                                    title="Tìm kiếm"><i class="fas fa-search mr-1"></i>Tìm kiếm</button>
                                <a class="btn btn-sm bg-gradient-danger text-white ml-1" title="Hủy lọc"
                                    href="{{ route('page-admin-order-list') }}"><i class="fas fa-times mr-1"></i>Hủy lọc</a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card card-primary card-outline text-sm mb-0">
                    <div class="card-header">
                        <h3 class="card-title"><b>Danh sách đơn hàng</b></h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table card-table table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center" width="10%">STT</th>

                                    <th class="align-middle" style="width:10%">Mã Hoá Đơn</th>

                                    <th class="align-middle" style="width:20%">Tên khách hàng</th>

                                    <th class="align-middle" style="width:10%">Số điện thoại</th>

                                    <th class="align-middle" style="width:20%">Trạng Thái</th>

                                    <th class="align-middle" style="width:20%">Tống giá trị Hoá Đơn</th>

                                    <th class="align-middle text-center" style="width:10%">Thao tác</th>
                                </tr>
                            </thead>
                            @if (count($dsOrder))
                                @foreach ($dsOrder as $k => $item)
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">
                                                <input type="number"
                                                    class="form-control form-control-mini m-auto update-numb" min="0"
                                                    value="{{ $serial++ }}" data-id="" data-table="product"
                                                    readonly>
                                            </td>

                                            <td class="align-middle">
                                                <a class="text-dark text-break text-hover"
                                                    href="{{ route('page-admin-order-detail', ['id' => $item->id]) }}"
                                                    title="Mã Hoá Đơn">{{ $item->code }}</a>
                                            </td>

                                            <td class="align-middle">
                                                <a class="text-hover text-dark text-break "
                                                    href="{{ route('page-admin-order-detail', ['id' => $item->id]) }}"
                                                    title="Tên khách hàng">{{ $item->fullname }}</a>
                                            </td>

                                            <td class="align-middle">
                                                <a class="text-dark text-break"
                                                    href="{{ route('page-admin-order-detail', ['id' => $item->id]) }}"
                                                    title="Số điện thoại">{{ $item->phone }}</a>
                                            </td>

                                            <td class="align-middle">
                                                <a class="text-dark text-break"
                                                    href="{{ route('page-admin-order-detail', ['id' => $item->id]) }}"
                                                    title="Trạng thái">
                                                    @if ($item->status == 'pending')
                                                        Mới đặt
                                                    @elseif($item->status == 'paid')
                                                        Đã thanh toán
                                                    @elseif($item->status == 'delivering')
                                                        Đang giao
                                                    @elseif($item->status == 'delivered')
                                                        Đã giao
                                                    @elseif($item->status == 'completed')
                                                        Hoàn tất
                                                    @else
                                                        Đã Huỷ
                                                    @endif
                                                </a>
                                            </td>

                                            <td class="align-middle">
                                                <a class="text-dark text-break" href=""
                                                    title="Tống giá trị Hoá Đơn">{{ formatMoney($item->total_price) }}</a>
                                            </td>

                                            <td class="align-middle text-center text-md text-nowrap">
                                                <a class="text-primary mr-2 modify-item"
                                                    href="{{ route('page-admin-order-detail', ['id' => $item->id]) }}"
                                                    title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="100" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="card-footer text-sm">
                    @if (count($dsOrder))
                        <div class="card-pagination">
                            {!! $dsOrder->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
