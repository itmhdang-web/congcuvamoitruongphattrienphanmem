@extends('user.index')
@section('body')
<div class="wap_1200">
    <div class="template-pro">

        <div class="title-main">
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="container-fluid">
                    <div class="navbar-nav">
                        @foreach($productTypes as $k => $type)
                            <li class="nav-item">
                                <a class="nav-link py-2 px-3 rounded-3 text-dark font-weight-bolder" href="{{ route('page-user-product-list', ['productType' => $type->id]) }}">{{$type->name}}</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-9">
            </div>
{{--            <div class="col-md-3" style="font-weight:bold width:100%">--}}
{{--                <label for="amount" style="font-weight:bold">Lọc Giá:</label>--}}
{{--                <form>--}}
{{--                    <div id="slider-range" class="col-md-12">--}}
{{--                    </div>--}}
{{--                    <div style="width:100%" class="col-md-12">--}}
{{--                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">--}}
{{--                        <input type="hidden" name="start_price" id="start_price"/>--}}
{{--                        <input type="hidden" name="end_price" id="end_price"/><br>--}}

{{--                    </div>--}}
{{--                    <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-warning">--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>
        <div class="content-main w-clear">
            @if (count($dsProduct))
            <div class="css_flex_ajax">
                @foreach ($dsProduct as $item)
                <div class="product">
                    <a href="{{ route('page-user-product-detail', ['id' => $item->id]) }}"
                        class="box-product text-decoration-none">
                        <p class="pic-product scale-img">
                            <img class="" onerror="src='{{ asset('assets/admin/images/noimage.png') }}'"
                                src="{{ asset('upload/product/' . $item->photo) }}" style="" alt="{{ $item->name }}" />
                        </p>
                        <div class="info-product">
                            <h3 class="name-product text-split">{{ $item->name }}</h3>
                        </div>
                    </a>
                    <div class="layout-price">
                        <p class="price-product">
                            <span class="label-price">Giá:</span>
                            @if ($item->sale_price > 0)
                            <span class="price-new">{{ formatMoney($item->sale_price) }}</span>
                            <span class="price-old">{{ formatMoney($item->price_regular) }}</span>
                            <span class="price-per">-{{ round(100 - ($item->sale_price / $item->price_regular) * 100)
                                }}%</span>
                            @else
                            <span class="price-new">{{ $item->price_regular > 0 ? formatMoney($item->price_regular) :
                                'Liên hệ' }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="col-12">
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Không có sản phẩm nào!!!</strong>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12">
            @if (count($dsProduct))
            <div class="pagination-home w-100">
                {!! $dsProduct->links() !!}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
