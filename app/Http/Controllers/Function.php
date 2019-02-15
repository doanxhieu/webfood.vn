<?php
function multiCates_select($data, $id =0, $str='',$select = 0)
{
    foreach ($data as $value) {
        if($value->parent_id == $id){
            $tt[] = $value->parent_id;
            if ($select != 0 && $value->id == $select) {
                echo '<option id="cate_'.$value->id.'" value="'.$value->id.'" selected>'.$str." ".$value->name.'</option>';
            }else{
                echo '<option id="cate_'.$value->id.'" value="'.$value->id.'">'.$str." ".$value->name.'</option>';
            }
            multiCates_select($data,$value->id, $str.'--',$select);
        }
    }
}



