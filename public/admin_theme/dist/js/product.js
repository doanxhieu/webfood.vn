$(document).ready(function() {
    $('#table_product').DataTable();
    base_url  = window.location.href;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                // alert(this.files && this.files.length ? this.files[i].name: '');
                reader.onload = function(event) {
                    $($.parseHTML('<img style="width:260px;height: 200px;border:1px solid #ccc;margin-right:3px;"/>'))
                    .attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#fileToUpload').on('change', function() {
        $('#view_images').find('img').remove('img');
        imagesPreview(this, '#view_images');
        // lấy tên hình ảnh
        var filesAmount = this.files.length;
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        strname = names.join('__');
    });
});

    $('input').keypress(function() {
        /* Act on the event */
        $(this).next('div.help-block').css('display', 'none');
        $(this).parent('div').removeClass('has-error has-danger');
    });
    
    $('[id^="readmore_"]').on('click', function(event) {
        event.preventDefault();
        id_product = $(this).attr('id').substring(9);
        $.ajax({
            url: base_url+'/readmore',
            type: 'post',
            dataType: 'json',
            data: {id_product: id_product},
        })
        .done(function(data) {
           $('#des_'+id_product).html(data.readmore);
       });
    });

    $('[id^="delete_product_"]').on('click',function(event) {
        event.preventDefault();
        id=$(this).attr('id').substring(15);
        name = $(this).closest('tr').find('td:eq(1)').text();
        $('#product_id_del').val(id);
        $('#product_name_del').val(name);
    });

    $('#btn-delete-product').on('click', function(event) {
        event.preventDefault();
        id_product = $('input[name="del_id_product"]').val();
        name = $('input[name="product_name_del"]').val();
        $.ajax({
            url: base_url+'/delete',
            type: 'post',
            dataType: 'json',
            data: {id_product: id_product, name:name},
        })
        .done(function(data) {
            $('#delete_product').modal('toggle');
            $('#row_product_'+id_product).remove();
            $('.alert-error').html(data.success);
            $('div.alert').delay(5000).slideUp();
        });
    });
});
