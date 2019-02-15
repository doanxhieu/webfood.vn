  <!-- Modal DELETE -->
    <div class="modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-sm" style="top:130px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p>Bạn có chắc chắc muốn xóa trường này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-delete"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="thongbao" role="dialog">
        <div class="modal-dialog modal-sm" style="top:130px; border-top: 3px solid #00a65a;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body row" id="body-thongbao">
                    <div class="col-sm-4" id="img_tb">
                         <img src="{{asset('admin_theme/dist/img/success.gif')}}" style="width: 80px;">
                    </div>
                    <div class="col-sm-8" style="padding:5px;">
                       <h3 style="font-size: 18px;" id="title_tb"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
