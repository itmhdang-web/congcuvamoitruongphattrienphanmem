@extends('user.index')
@section('body')
@if (count($dsProductNew))
<div class="box-sanpham-tc">
    <div class="wap_1200">
        <div class="box-title">
            <div class="title-main"><span>Sản phẩm mới</span></div>
            <div class="deco"></div>
        </div>
        <div class="chay-sp1 arrow-run">
            @foreach ($dsProductNew as $item)
            <div class="product">
                <a href="{{ route('page-user-product-detail', ['id' => $item->id]) }}" class="box-product text-decoration-none">
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
                        <span class="price-per">-
                            {{ round(100 - ($item->sale_price / $item->price_regular) * 100) }}%</span>
                        @else
                        <span class="price-new">{{ formatMoney($item->price_regular) ? formatMoney($item->price_regular)
                            : 'Liên hệ' }}</span>
                        @endif
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="box-sanpham-tc">
    <div class="wap_1200">
    <img class=""  src="{{ asset('upload/slide/banner-1.jpg') }}" style="" alt="" />
    </div>
</div>
<div class="box-sanpham-tc">
    <div class="wap_1200">
        <div class="box-title">
            <div class="title-main"><span>Sản phẩm nổi bật</span></div>
            <div class="deco"></div>
        </div>
        <div class="chay-sp2 arrow-run">
            @foreach ($dsProductOutStanding as $item)
            <div class="product">
                <a href="{{ route('page-user-product-detail', ['id' => $item->id]) }}" class="box-product text-decoration-none">
                    <p class="pic-product scale-img">
                        <img class="rounded" onerror="src='{{ asset('assets/admin/images/noimage.png') }}'"
                            src="{{ asset('upload/product/' . $item->photo) }}" alt="Alt Photo" style=""
                            alt="{{ $item->name }}" />
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
                        <span class="price-per">-
                            {{ round(100 - ($item->sale_price / $item->price_regular) * 100) }}%</span>
                        @else
                        <span class="price-new">{{ formatMoney($item->price_regular) ? formatMoney($item->price_regular)
                            : 'Liên hệ' }}</span>
                        @endif
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="box-sanpham-tc">
    <div class="wap_1200">
    <img class=""  src="{{ asset('upload/slide/banner-2.jpg') }}" style="" alt="" />
    </div>
</div>
<div class="box-sanpham-tc">
    <div class="wap_1200">
        <div class="box-title">
            <div class="title-main"><span>Sản phẩm khuyến mãi</span></div>
            <div class="deco"></div>
        </div>
        <div class="chay-sp3 arrow-run">
            @foreach ($dsProductDiscount as $item)
            <div class="product">
                <a href="{{ route('page-user-product-detail', ['id' => $item->id]) }}" class="box-product text-decoration-none">
                    <p class="pic-product scale-img">
                        <img class="rounded" onerror="src='{{ asset('assets/admin/images/noimage.png') }}'"
                            src="{{ asset('upload/product/' . $item->photo) }}" alt="Alt Photo" style=""
                            alt="{{ $item->name }}" />
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
                        <span class="price-per">-
                            {{ round(100 - ($item->sale_price / $item->price_regular) * 100) }}%</span>
                        @else
                        <span class="price-new">{{ formatMoney($item->price_regular) ? formatMoney($item->price_regular) : 'Liên hệ' }}</span>
                        @endif
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
