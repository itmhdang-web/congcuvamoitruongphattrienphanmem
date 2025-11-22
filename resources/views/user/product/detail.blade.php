@extends('user.index')
@section('body')
<img class=""  src="{{ asset('upload/slide/product-banner-1.jpg') }}" style="" alt="" />
    <div class="wap_detail">

        <div class="grid-pro-detail w-clear" data-id="{{ $rowDetail->id }}">
            <div class="row">
                <div class="left-pro-detail col-md-6 col-lg-6 mb-4">
                    <div class="photo-prodetail">
                        <div class="chay-photo">
                            <div class="item-gallery">
                                <img class="rounded" onerror="src='{{ asset('assets/admin/images/noimage.png') }}'"
                                     src="{{ asset('upload/product/' . $rowDetail->photo) }}" style=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-pro-detail col-md-6 col-lg-6 mb-4">
                    <p class="title-pro-detail mb-2">
                        <?= $rowDetail->name ?>
                    </p>
                    <ul class="attr-pro-detail">
                        <li class="w-clear">
                            <label class="attr-label-pro-detail">Mã:</label>
                            <div class="attr-content-pro-detail">{{ $rowDetail->code }}</div>
                        </li>
                        <li class="w-clear">
                            <label class="attr-label-pro-detail">Giá:</label>
                            <div class="attr-content-pro-detail">
                                @if ($rowDetail->sale_price > 0)
                                    <span class="price-new-pro-detail">{{ formatMoney($rowDetail->sale_price) }}</span>
                                    <span
                                        class="price-old-pro-detail">{{ formatMoney($rowDetail->price_regular) }}</span>
                                @else
                                    <span class="price-new-pro-detail">{{ $rowDetail->price_regular > 0 ?
                                formatMoney($rowDetail->price_regular) : 'Liên hệ' }}
                            </span>
                                @endif
                            </div>
                        </li>
                        <li class="w-clear">
                            <label class="attr-label-pro-detail d-block">Số lượng:</label>
                            <div class="attr-content-pro-detail d-flex align-items-center ">
                                <div class="quantity-pro-detail">
                                <span class="quantity-minus-pro-detail decrease"><i
                                        class="fa-solid fa-minus"></i></span>
                                    <input type="number" class="qty-pro" min="1" value="1" readonly/>
                                    <span class="quantity-plus-pro-detail increase"><i
                                            class="fa-solid fa-plus"></i></span>
                                </div>
                            </div>
                        </li>
                        <input type="hidden" value="{{ $rowDetail->id }}" class="id-pro-detail"/>
                    </ul>
                    <div class="cart-pro-detail">
                        <a class="btn btn-success add-cart rounded-0 mr-2" data-id="{{ $rowDetail->id }}" data-is-auth="{{is_null(Auth::guard('user')->user()) == 0}}">
                            <div class="bg-add">
                                <i class="fas fa-cart-plus mr-1"></i>
                                <span>Thêm vào giỏ hàng</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home"
                       aria-selected="true">Thông tin sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment" role="tab"
                       aria-controls="comment" aria-selected="true">Đánh giá</a>
                </li>
            </ul>
            <div class="tab-content pt-4 pb-4" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if (!empty($rowDetail->content))
                        <div class="w-clear" id="content">{!! htmlspecialchars_decode($rowDetail->content) !!}</div>
                    @else
                        <div class="col-12 text-2xl">
                            Thông tin đang cập nhật
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                    <div class="col-sm-12" id="comment_style">
                        <form>
                            <div id="comment_show"></div>
                            <input type="hidden" class="id_product" data-status="0" name="id_product"
                                   value="{{ $rowDetail->id }}"/>
                            @if(Auth::guard('user')->check())
                                <input type="hidden" class="id_user" name="id_user" value="{{ Auth::guard('user')->user()->id }}"/>
                                <input type="hidden" class="avatar" name="avatar" value="{{ Auth::guard('user')->user()->avatar }}"/>
                            @else
                                <input type="hidden" class="" name="" value=""/>
                                <input type="hidden" class="" name="" value=""/>
                            @endif
                        </form>
                        @if(Auth::guard('user')->check())
                            @foreach($id_order_product as $k => $id_user)
                                @if(Auth::guard('user')->user()->id==$id_user->id_user)
                                    <form action="#">
                                        <p><b>Viết đánh giá của bạn</b></p>
                                        <div class="col-md-12 comment_style">
                                            <span>
                                                <textarea name="content" class="form-control content" placeholder="Nội dung bình luận" rows="5"></textarea>
                                            </span>
                                            <div class="notify_comment"><p></p></div>
                                            <button type="button" class="btn btn-warning send-comment">Gửi bình luận</button>
                                        </div>
                                    </form>
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
