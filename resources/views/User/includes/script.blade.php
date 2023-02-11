<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/skrollr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
@if(!Request::is('women', 'men', 'index-affiliate/*'))
<script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
@endif

{{-- Date Range Picker --}}
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('admin-assets-old/js/plugin/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/vendors/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/vendors/mail-script.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('admin_assets/js/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/scripts/sweetalert2.js') }}" type="text/javascript"></script>

<script src="{{ asset('admin_assets/js/custom.js') }}" type="text/javascript"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
    // $(document).ready(function(){
        var arrProduct = [];
        var sizeDefault = $('#sizeDefault').val();
        var sizeProduct = 0;

        $(document).on('click', '.btn-size', function(e){
            e.preventDefault();
            $('.btn-size').removeClass('active-size');
            $(this).toggleClass('active-size');

            var size_id = $(this).attr('size_id');
            var quantity = $(this).attr('quantitySize');
            // $('#totalProduct').val(quantitySize);
            $('.quantityProduct').html('Có '+quantity+' sản phẩm có sẵn');
            sizeProduct = $(this).attr('nameSize');
            $('#noti-checksize').html('');
            $('#display-size').css({'background': '#fff'});
            $('#c-size').css({'color': '#777'});
        });
        $(document).on('click', '.add-to-cart', function(e){
            console.log(arrProduct);
            var id = arrProduct.slice(-1)[0];
            e.preventDefault();
            var quantity = $('#sst').val();
            
            if(sizeProduct == "" && sizeDefault == 0){
                $('#noti-checksize').html('Vui lòng chọn Size!');
                $('#display-size').css({'background': '#ff8080'});
                $('#c-size').css({'color': '#000'});
            }else if(sizeDefault == 1){
                sizeProduct = 1;
            }
            $.ajax({
                type: "GET",
                url: "/cart/"+id,
                data: {quantity: quantity, sizeProduct: sizeProduct, sizeDefault: sizeDefault},
                success: function (data) {
                    if(data == 1){
                        notification('center', 'error', 'Bạn đã thêm số lượng tối đa của sản phẩm', 650, false, 2000);
                    }else{
                        $('#load-count').load(' .count-cart');
                        notification('center', 'success', 'Sản phẩm đã được thêm vào giỏ hàng', 650, false, 2000);
                    }
                }
            });

        });
    // });
</script>

@yield('ajax')
