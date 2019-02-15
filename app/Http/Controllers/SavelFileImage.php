<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavelFileImage extends Controller
{
    public static function saveFile(Request $request){

            if ($files=$request->File('file')) {
                $images=array();
                $flag = true;
                // biến kiểm tra lỗi file;
                $err = false; 
                $allowedfileExtension=['jpg','png','jpeg'];
                $target_dir='upload/products';
                foreach ($files as $file) {
                    $timestamp = time();
                // $time = strftime($format,$timestamp);
                    $name = time().''.$file->getClientOriginalName();
                    $size = $file->getSize();
                    $target_file = $target_dir.$name;
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);
                    if ($size > 1048576) {
                        $err=true;
                        $errsize="Kích cỡ file < 1MB!";
                        $request->session()->put('size',$errsize);
                    }
                    if (!$check) {
                        $err=true;
                        $request->session()->put('type','Không đúng định dạng file ảnh.(*.jpg/png/jpeg)');
                    }
                    if ($err==false) {
                        $file->move($target_dir,$name);
                        $images[]=$name;
                        $flag=true;
                    }else{
                        $flag=false;
                    }
            } // endforeach
            if ($flag==true) return $images;
        }
    }
}
