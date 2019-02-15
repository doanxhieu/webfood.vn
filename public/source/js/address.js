$(document).ready(function() {
    
    var base_url = window.location.origin;
    // ========================================================
    // ==================XU LY DIA CHI CART====================
    // ========================================================
    $('#tinhthanh').change(function(event) {
        /* Act on the event */
        event.preventDefault();
        matp = $(this).val();
        $.ajax({
            url: base_url+"/quanhuyen",
            type: 'post',
            data: {matp: matp},
            dataType: 'html',
        })
        .done(function(data) {
            $('#quanhuyen').html(data);
        })
        .fail(function() {
            swal({
              type: 'error',
              title: 'Error!',
              text: 'Lỗi xử lý địa chỉ!',
            });
        });
    });

    $('#quanhuyen').change(function(event) {
        /* Act on the event */
        event.preventDefault();
        maqh = $(this).val();
        $.ajax({
            url: base_url+"/xaphuong",
            type: 'post',
            data: {idqh: maqh},
            dataType: 'html',
        })
        .done(function(data) {
            $('#xaphuong').html(data);
        })
        .fail(function() {
            swal({
              type: 'error',
              title: 'Error!',
              text: 'Lỗi xử lý địa chỉ!',
            });
        });
    });
});
