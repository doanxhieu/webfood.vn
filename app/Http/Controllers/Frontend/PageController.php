<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Models\Slide; 
use App\Models\Product; 
use App\Models\Category; 
class PageController extends Controller
{
    public function sendcart(){
        return view('mail.mailCart');
    }
    public function index(){
        $slide = Slide::all();
        $category=Category::with('translation')->get();
        $new_product = Product::with('translation')->orderBy('id','DESC')->offset('1')->limit('8')->get();
        return view('frontend.page.index',compact('slide','new_product'));
    }

    public function getProduct($cate=null){
        $category = Category::with('translation')->get();
        if(is_null($cate)){
            $all_product = Product::with('translation')->orderBy('id','DESC')->paginate(12);
            return view('frontend.page.all_product',compact('all_product','category'));
        }else{
            $id_category = $category->where('slug','=',$cate)->first()->id;
            $all_product = Product::with('translation')->where('category_id',$id_category)->orderBy('id','DESC')->paginate(12);
            return view('frontend.page.all_product',compact('all_product','category'));
        }
    }

    public function getProductDetail(Request $request){
        $chitietsp = Product::with('translation')->where('slug','=', $request->slug)->first();
        return view('frontend.page.product_detail',compact('chitietsp'));
    }

    // public function getContact(){
    // 	return view('frontend.page.contact');
    // }

    // public function sendContact(ContactRequest $request){
    //     $data = $request->all();
    //     Mail::send('mail.mail_contact', $data, function($msg) use($data){
    //         $msg->from(config('mail.username'), 'ADMIN_COLORSHOP');
    //         $msg->to($data['email'],$data['fullname'])->subject('SHOPLARAVEL');
    //     });
    //     Contact::create($data);
    //     return redirect()->back()->with('success','Cảm ơn bạn đã gửi góp ý. Chúng tôi sẽ phản hồi lại trong thời gian sớm nhất.');
    // }

    // public function getAbout(){
    // 	return view('frontend.page.about');
    // }

}
