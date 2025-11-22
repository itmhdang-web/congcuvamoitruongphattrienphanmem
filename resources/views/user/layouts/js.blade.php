<script>
    var InfinityShop = InfinityShop || {};
</script>
<script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('assets/user/js/app.js') }}"></script>
<script src="{{ asset('assets/user/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/user/owlcarousel2/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/user/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/user/select2/select2.full.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script>
    $(document).ready(function () {
        $('.chay-sp1,.chay-sp2,.chay-sp3').slick({
            lazyLoad: 'progressive',
            infinite: true,
            accessibility: true,
            vertical: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: true,
            centerMode: false,
            dots: false,
            draggable: true,
            responsive: [{
                breakpoint: 871,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: true
                }
            }]
        });
        $('.chay-tt').slick({
            lazyLoad: 'progressive',
            infinite: true,
            accessibility: true,
            vertical: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            centerMode: false,
            dots: false,
            draggable: true,
            responsive: [{
                breakpoint: 871,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }]
        });
        $('.chay-photo').slick({
            lazyLoad: 'progressive',
            infinite: true,
            accessibility: true,
            vertical: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            centerMode: false,
            dots: false,
            draggable: true,
            asNavFor: '.chay-gallery',
            responsive: [{
                breakpoint: 871,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }]
        });
        $('.chay-gallery').slick({
            lazyLoad: 'progressive',
            infinite: true,
            accessibility: true,
            vertical: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            centerMode: false,
            dots: false,
            draggable: true,
            asNavFor: '.chay-photo',
            responsive: [{
                breakpoint: 871,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }]
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".show-dropdown").on("click", function () {
            $(this).parents(".dropdown").find(".dropdown-menu").slideToggle(500);
        });
    });
</script>

<script>
    $(function () {
        $("#slider-range").slider({
            orientation: "horizontal",
            range: true,
            min: {{ $min_price_range }},
        max: {{ $max_price_range }},
        values: [{{ $min_price }}, {{ $max_price }}],
        step: 200000,
        slide: function (event, ui) {
            $("#amount").val(ui.values[0] + " đ" + " - " + ui.values[1] + " đ");

            $("#start_price").val(ui.values[0]);
            $("#end_price").val(ui.values[1]);
        }
        });
    $("#amount").val($("#slider-range").slider("values", 0) + " đ" + " - " +
        $("#slider-range").slider("values", 1) + " đ");
    });
</script>


<script>
    $(document).ready(function () {
        load_comment();

        function load_comment() {
            const id_product = $('.id_product').val();
            $.ajax({
                url: `/product/detail/${id_product}/comment`,
                method: "GET",
                success: function (data) {
                    $("#comment_show").html(data);
                }
            })
        }

        $('.send-comment').click(function () {
            var id_user = $('.id_user').val();
            var id_product = $('.id_product').val();
            var avatar = $('.avatar').val();
            var content = $('.content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: `/product/detail/${id_product}/comment`,
                method: "POST",
                data: {
                    id_user: id_user,
                    avatar: avatar,
                    id_product: id_product,
                    content: content,
                    _token: _token,
                },
                success: function (data) {
                    if (data == 'Bình luận thành công') {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Gửi bình luận thành công!",
                        });
                        load_comment();
                        $('.content').val('');
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Thông Báo",
                            text: "Vui lòng đăng nhập hoặc mua hàng để gửi bình luận !",
                        });
                    }
                }
            })
        });
    });
</script>
<script>
    function remove_background(product_id) {
        for (var count = 1; count <= 5; count++) {
            $('#' + product_id + '-' + count).css('color', '#ccc');
        }
    }
</script>
<script>
    function cancelOrder(id) {
        $.ajax({
            url: "{{ route('do-user-order-cancel') }}",
            method: "DELETE",
            data: {
                code: id,
            },
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    title: "Thông Báo",
                    text: "Hủy đơn hàng thành công",
                });
                location.reload();
            }
        })
    }
</script>
