$(document).ready(function() {
    var base_url = window.location.href;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $('.col_update_cate a').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        id = $(this).attr('id-update');
        parent_id = $(this).attr('data-parentid');
        name = $(this).closest('tr').find('td:eq(1)').text();
        length = $('#parent_cate_update option').length-1;
        for (var i = 1; i <=length; i++) {
            if($('#cate_'+i).val()==parent_id){
                $('#cate_'+i).attr('selected','selected');
            }
        }
        $('#name_update').val(name);
        $('#id_update').val(id);
    });

     $('#frmUpdate_Cate').submit(function(event) {
        /* Act on the event */
        event.preventDefault();
        id          = $('#id_update').val();
        name        = $('#name_update').val();
        parent_id   = $('#parent_cate_update').val();
        $.ajax({
            url: base_url+'/update',
            type: 'post',
            data:{id: id, name:name,parent_id:parent_id},
            success:function(data){
              if(data.success==true){
                // $('.alert-error').html('<div class="alert alert-success">Cập nhật thành công!</div>');
                $('#body-thongbao').append('<h3class="text-center">Cập nhật thành công!</h3>');
                $('#update_cate').modal('hide');
                $('#thongbao').modal('toggle');
                setTimeout(function() {
                    $('#thongbao').modal('hide');
                },2000);
                $('#name_'+id).text(name);
                $('#slug_'+id).text(data.slug);
            }else{
                $('.alert-error').html('<div class="alert alert-danger">Cập nhật không thành công danh mục: '+name+'</div>');
                $('div.alert').delay(5000).slideUp();
            }
        }
    });
    });
 });
