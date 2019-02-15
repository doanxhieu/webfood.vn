$(document).ready(function() {
    table_cate      =   $('#table_danhmuc').DataTable();
    table_product   =   $('#table_product').DataTable();
    table_role      =   $('#table_role').DataTable();
    table_admin     =   $('#table_admin').DataTable();
    
    base_url = window.location.origin;
    href = window.location.href;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function del(__this, url, id, btndel) {
    console.log(url, id, btndel);
    console.log(url.indexOf('role'));
    $('#'+btndel).click(function(event) {
        /* Act on the event */
        event.preventDefault();
        $.ajax({
            url: url,
            type: 'post',
            data: {id: id},
            success:function(data){
                if (data.data_obj==false) {
                    $('#delete_modal').modal('hide');
                    $('#img_tb').html('<img src="'+base_url+'/admin_theme/dist/img/errors.png" style="width: 80px;">');
                    $('#title_tb').html(data.error);
                    $('#thongbao').modal('toggle');
                }else{
                    $('#title_tb').html(data.success);
                    $('#delete_modal').modal('hide');
                    $('#thongbao').modal('toggle');
                    if (url.indexOf('category-manager')>0) {
                        table_cate.row("#row_"+id).remove().draw();
                    }
                    if (url.indexOf('user')>0) {
                        table_admin.row("#row_"+id).remove().draw();
                    }
                    if (url.indexOf('role')>0) {
                        table_role.row("#row_"+id).remove().draw();
                    }
                }
                setTimeout(function() {
                    $('#thongbao').modal('hide');
                },2000);

            }
        });
    });

}
/**
 * show profile user
 * @param  {[type]} __this [description]
 * @return {[type]}        [description]
 */

