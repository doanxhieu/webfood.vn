jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    base_url = window.location.href;
    /**
     * show modal insert role
     */
    console.log(base_url);
     if($('#error_role').text() != '')
     {
        $('#modal_add_role').modal('show');
    }

    $('#update-role a').on('click', function(event) {
        event.preventDefault();
        id = $(this).attr('id-update');
        input_id = '<input type="hidden" name="id" value="'+id+'" id="idupdate">';

        str_pers = $(this).closest('tr').find('td:eq(2)').text();
        arr_pers = $.parseJSON(str_pers);
        $.each(arr_pers, function (i,item)
        {
            if (item==true) {
                $('#permissions_'+i).attr('checked','checked');
                // $('#permissions_'+i).parent('div').addClass('checked');
                // $('#permissions_'+i).parent('div').attr('aria-checked','true');
            }else{
                $('#permissions_'+i).removeAttr('checked');
            }
            console.log(i,item);
        });
        $('#input_id').html(input_id);
        $('#modal-tile-role').text('Update Role');
        $('#namerole').val($(this).closest('tr').find('td:eq(1)').text());
        $('#modal_add_role').modal('show');
    });

    // press btn them quyen
    $('#btn-addrole').on('click', function(event) {
        event.preventDefault();
        $('#permissions_create').removeAttr('checked');
        $('#permissions_update').removeAttr('checked');
        $('#permissions_view').removeAttr('checked');
        $('#permissions_delete').removeAttr('checked');
        $('#idupdate').val('');
        $('#namerole').val('');
    });
    /* 
        click thay đổi quyền
        */
    $('[id^="update_role_"]').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        id = $(this).attr('id').substring(12);
        email = $(this).closest('tr').find('td:eq(1)').text();
        role = $(this).closest('tr').find('td:eq(2)').text().trim();
        count_li = ($("#role_user").children().length);
        for (var i = 1; i < count_li; i++) {
            if($('#value_'+i).text() === role){
                $('#value_'+i).attr('selected','selected');
                break;
            }
        }
        $('#myUpdateRole').modal('toggle');
        $('#email_role').val(email);
        $('#id_change_pers').val(id);
        $('#name_role').val(role);
    });

    $('#show_permisstion').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('#modal_add_role').modal('hide');
        $('#setpermissions').modal('show');
    });

    
});
