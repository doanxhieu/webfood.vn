

$(document).ready(function() {
    $.ajaxSetup({
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var base_url = window.location.origin;
    // ==============================================
// ADD TO LIST CART
$('.block2-btn-addcart').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
    $(this).click(function(){
        id= $(this).find('button').attr('data-id');
        count_cart = parseInt($('#count_product_cart').text());
        count_cart++;
        price = $(this).find('button').attr('data-price');
            // cập nhật tổng tiền
            price_p=parseInt($('.block2-price_'+id).text());
            // độ dài của danh sách đơn hàng
            count_li=$('#item-cart').find('li').length;
            count_li++;
            $.ajax({
                url: base_url+"/cart/add-to-list",
                type: 'POST',
                dataType: 'json',
                data: {id: id, count_li: count_li, base_url: base_url,price:price},
            })  
            .done(function(data) {
                $('#total-cart').html(data.total); 
                $('#count_product_cart').html(count_cart);
                if (count_li > 1) {
                    $('.header-cart-wrapitem').append(data.html);
                }else{
                    $('.header-cart-wrapitem').html(data.html);
                }
                swal(nameProduct, "Thêm vào giỏ hàng thành công!", "success");
            })
            .fail(function(data) {
                swal(nameProduct, "Mua hàng không thành công!", "error");
            });

        });
});

$('#frm-store').submit(function(event) {
    event.preventDefault();
    total_product=parseInt($('#count_product_cart').text());
    matp = $('#tinhthanh').val();
    maqh = $('#quanhuyen').val();
    maxa = $('#xaphuong').val();
    add_detail = $('#detail_add').val();
    phone = $('#phone').val();
    token = $('input[name="_token"]').val();
    checkbox = document.getElementsByName("payment");
    for (var i = 0; i < checkbox.length; i++){
        if (checkbox[i].checked === true){
            payment = checkbox[i].value;
        }
    }
        // id_user, address, phone, status, total_product, total_amount, payment,
        rows = $('tbody')[0].rows.length;
        total_amount = 0;
        for (var i = 1; i <= rows; i++) {
            t = parseInt($('.thanhtien_'+i).text());
            total_amount += t;
        }
        $.ajax({
            url:base_url+"/cart/storecart",
            type: 'POST',
            dataType: 'json',
            data: {
                matp: matp,
                maqh: maqh,
                maxa: maxa,
                phone: phone,
                total_product:total_product,
                total_amount: total_amount,
                payment: payment,
                add_detail: add_detail,
            },
            success: function(data){
                if (data.error.length > 0) {
                    for(var i=0; i<data.error.length; i++){
                        var error_html = '<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error[i]+'</div>';
                    }
                    $('#thongbao-cart').html(error_html);
                }else{
                    $('#thongbao-cart').html(data).success;
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        for(var j = 1; j<=rows; j++){
            amount = $(".thanhtien_"+j).closest('tr').find('td:eq(4)').text();
            idsp = $('#tr_'+j).attr('data-idsp');
            qty = $('#num_product_'+idsp).text();

            $.ajax({
                url:"http://shoplaravel.local.com/cart/insertCartDetail",
                type: 'post',
                dataType: 'json',
                data: {idsp: idsp, qty: qty, amount: amount},
            })
            .done(function(result) {
                if (result.error.length > 0) {
                    for(var i=0; i < result.error.length; i++){
                        var error_not = '<div class="alert alert-danger"><strong>ERROR!</strong>'+result.error[i]+'</div>';
                    }
                    $('#thongbao-cart').html(error_not);
                }else{
                    $('#thongbao-cart').html(result).success;
                }
            })
            .fail(function(data) {
                console.log(data);
            })
        }
    });

    // ================STORE DATABASE CART ========
    // DELETE CART
    $('#btn-destroy-cart').each(function(){
        $(this).on('click', function(){ 
            if (confirm('Bạn có muốn xóa giỏ hàng?')) {
                $.ajax({
                    url:base_url+"cart/destroy",
                    type: 'post',
                    dataType: 'html',
                })
                .done(function(data) {
                   if(swal({
                      type: 'success',
                      title: 'Xóa giỏ hàng thành công!',
                      showConfirmButton: false,
                      timer: 1500
                  })){
                    window.location.reload();
                }

            })
                .fail(function() {
                    swal("Xảy ra lỗi xóa giỏ hàng!", "error");
                })                    
            }
        });
    });
    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "Đã thêm vào sản phẩm đã thích!", "success");
        });
    });
    /**========================================================================
    /*tăng số lượng sản phẩm*/
    $('.btn-num-product-up').click(function() {
        idsp = $(this).attr('data-id');
        soluongmoi=parseInt($(this).prev('#num_product_'+idsp).text());
        soluongmoi++;
        dongia= parseInt($(this).closest('tr').find('td:eq(2)').text());
        rowId = $(this).closest('tr').attr('data-rowId');
        rows = $('tbody')[0].rows.length;
        tongtien_moi = 0;
        $.ajax({
            url:base_url+"/cart/update",
            type: 'post',
            data: {id: idsp, soluongmoi: soluongmoi, dongia: dongia, rowId: rowId},
            dataType: 'json',
        })
        .done(function(data) {
            // console.log(Object.keys(data.cart).length);
            // console.log(Object.keys(data.cart));
            if (data.err!=null && data.quantity != null) {
                swal({
                    type: 'error',
                    title: 'Số lượng sản phẩm đã vượt quá số lượng hàng trong kho!',
                    showConfirmButton: false,
                    timer: 5000
                });
                $(this).attr("disabled", true);
            }else{
                $.each(data.cart, function( key, value ) {
                    console.log( key + ": " + value );
                });
                $('#num_product_'+idsp).html(soluongmoi);
                // Tổng tiền của từng sản phẩm
                $('#thanhtien_'+idsp).html(data.thanhtien);
                // tăng số lượng sản phẩm trong giỏ lên 1
                count_product_cart=parseInt($('#count_product_cart').text());
                count_product_cart++;
                $('#count_product_cart').html(count_product_cart);
                $('#total_cart').html(data.total);
            }
        })
        .fail(function() {
            swal("Xảy ra lỗi cập nhật giỏ hàng!", "error");
        }) 
    });
    /*Giảm số lượng sản phẩm*/
    $('.btn-num-product-down').click(function() {
        idsp = $(this).attr('data-id');
        soluongmoi=parseInt($(this).next('#num_product_'+idsp).text());
        if (soluongmoi==1) {
            $(this).bind('click', false);
        }else{
            soluongmoi--;
            dongia= parseInt($(this).closest('tr').find('td:eq(2)').text());
            tongtien_cu=parseInt($('#total_cart').text());
            rowId = $(this).closest('tr').attr('data-rowId');
            rows = $('tbody')[0].rows.length;
            tongtien_moi = 0;
            $.ajax({
                url:base_url+"/cart/update",
                type: 'post',
                data: {id: idsp, soluongmoi: soluongmoi, dongia: dongia, rowId: rowId},
                dataType: 'json',
            })
            .done(function(data) {
                if (data.err!=null && data.quantity != null) {
                    swal({
                      type: 'error',
                      title: 'Không thể giảm số lượng sản phẩm!',
                      showConfirmButton: false,
                      timer: 5000
                  });
                    $(this).attr("disabled", true);
                }else{
                    console.log(data.cart);
                    $('#num_product_'+idsp).html(soluongmoi);
                    $('#thanhtien_'+idsp).html(data.thanhtien);
                    // Giảm số lượng sản phẩm trong giỏ - 1
                    count_product_cart=parseInt($('#count_product_cart').text());
                    count_product_cart--;
                    $('#count_product_cart').html(count_product_cart);
                    // tổng tiền giỏ hàng
                    $('#total_cart').html(data.total);
                }
                
            })
            .fail(function() {
                swal("Xảy ra lỗi cập nhật số lượng giỏ hàng!", "Error!");
            }) 
        }
    });

    $('#login-to-cart').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        alert('Bạn phải đăng nhập trước khi đặt hàng!');
        window.location.href=base_url+'/login';
    });

    //xoa  sản phẩm trong gio hàng 
    $('[id^="del_product_cart_"]').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        alert($(this).attr('id').substring(17));
    });
});

