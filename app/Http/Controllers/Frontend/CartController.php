<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Redirect;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Bill_detail;
use Cart;
use App\Models\Devvn_tinhthanhpho;
use App\Models\Devvn_quanhuyen;
use App\Models\Devvn_xaphuongthitran;
use DB;
use Sentinel;
use Mail;

class CartController extends Controller
{
    /**
     * 'id_user', 'address', 'phone', 'status', 'total_product', 'total_amount', 'payment'
     * 
     * */
    public function saveCartDB(Request $request){
     DB::beginTransaction();
     try 
     {   
        $cart       = new Bill;
        $matinh     = $request->tinhthanh;
        $maqh       = $request->quanhuyen;
        $maxa       = $request->xa;
        $add_detail = $request->detail_add;
        $name_t     = Devvn_tinhthanhpho::find($matinh)->name;
        $name_h     = Devvn_quanhuyen::find($maqh)->name;
        $name_xa    = Devvn_xaphuongthitran::find($maxa)->name;
        $add_tmp    = array(
            $add_detail, $name_xa, $name_h,$name_t
        );
        // 'id_user', 'address', 'phone', 'status', 'total_product', 'total_amount', 'payment'
        $address        = implode("-",$add_tmp);
        $contentcart    = Cart::content();
        $total_product  = Cart::count();
        $total_amount = Cart::subtotal(0);

        $cart->customer_id =  Sentinel::getUser()->id;
        $cart->address = $address;
        $cart->phone = $request->phone_number;
        $cart->status = 0;
        $cart->total_product = $total_product;
        $cart->total_amount = (int)$total_amount;
        $cart->payment = $request->payment;
        $cart->created_at = now();
        $saveCart = $cart->save();

        $data = [
            'customer_id'=> Sentinel::getUser()->id,
            'email' => Sentinel::getUser()->email,
            'address'=> $address, 
            'phone' => $request->phone_number, 
            'total_product' => $total_product, 
            'total_amount' => (int)$total_amount, 
            'payment' => $request->payment
        ];

        if ($saveCart) {
            $idmax = Bill::whereRaw('id = (select max(id) from bills)')->get();
            if ($idmax->isEmpty()) {
                $maxid =1;
            }else{
                foreach ($idmax as $value) {
                    $maxid = $value->id;
                }
            }
            foreach ($contentcart as $value) {
                $cart_detail = new Bill_detail();
                $cart_detail->bill_id = $maxid;
                $cart_detail->product_id = $value->id;
                $cart_detail->quantity = $value->qty;
                $cart_detail->amount = $value->price*$value->qty;
                $cart_detail->created_at = now();
                $cart_detail->save();
            }
            DB::commit();
            Cart::destroy();
            $emailto = Sentinel::getUser()->email;
            Mail::send('frontend.mail.mailCart', $data, function($msg) use($data){
                $msg->from(config('mail.username'), 'ADMIN');
                $msg->to($data['email'])->subject('Thông báo mua hàng thành công');
            });
            return redirect(route('cart.viewordered'))->with('success_store','Mua hàng thành công! Cảm ơn quý khách!');
        }else{
            return redirect()->back()->with('err_store','ERROR! Mua hàng không thành công!');
        }
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('err_store', $e->getMessage());
    }
}
public function storeCartAjax(Request $request){
    DB::beginTransaction();
    if ($request->ajax()) {
        $flag= true;
        $err_array = array();
        $success_output = '';

        try{
                $add= $request->add_detail; //địa chị cụ thể số nhà, đường
                $matinh = $request->matp;
                $maqh =$request->maqh;
                $maxa = $request->maxa;
                $tinh = Devvn_tinhthanhpho::where('matp',(int)$matinh)->get();
                $huyen = Devvn_quanhuyen::where('maqh',(int)$maqh)->get();
                $xa = Devvn_xaphuongthitran::where('xaid',(int)$maxa)->get();
                foreach ($tinh as $value) {
                    $name_t = $value->name;
                }
                foreach ($huyen as $value) {
                    $name_h = $value->name;
                }
                foreach ($xa as $value) {
                    $name_xa = $value->name;
                }
                $add_tmp = array(
                    $add, $name_xa, $name_h,$name_t
                );
                $address = implode("-",$add_tmp);
                $data_cart = [
                    'id_user'=> Sentinel::getUser()->id,
                    'address'=> $address, 
                    'phone' => $request->phone, 
                    'total_product' => $request->total_product, 
                    'total_amount' => $request->total_amount, 
                    'payment' => $request->payment
                ];

                $save = CartDB::create($data_cart);
                
                if ($save) {
                    DB::commit();
                    $success_output = '<div class="alert alert-success">Đã thêm vào table cart</div>';
                }else{
                    $success_output = '<div class="alert alert-danger">Lỗi thêm vào table cart</div>';
                }

            }catch (ErrorException $e){
                DB::rollBack();
                $err_array[]  =  'ERROR CART:'+$e->getMessage();
                // return back()
                // ->withInput()
                // ->with('err', $e->getMessage());
            }

            $output=array(
                'error'=>$err_array,
                'success' => $success_output
            );
            return json_encode($output);
        }
    }

    public function insertCartDetail(Request $request) {
        if ($request->ajax()) {
            $flag= true;
            $err_array = array();
            $success_output = '';
            DB::beginTransaction();
            try{
                $cart_detail = new CartDetail;
                $cart = CartDB::whereRaw('id = (select max(id) from cart)')->get();
                if ($cart->isEmpty()) {
                    $maxid =1;
                }else{
                    foreach ($cart as $value) {
                        $maxid = $value->id;
                    }
                }

                $data= [
                    'id_cart' => $maxid, 
                    'id_product' => $request->idsp, 
                    'quantity' => $request->qty, 
                    'amount' => $request->amount
                ];
                // $save = CartDetail::create($data);
                $cart_detail->id_cart = $maxid;
                $cart_detail->id_product = $request->idsp;
                $cart_detail->quantity = $request->qty;
                $cart_detail->amount = $request->amount;
                $save = $cart_detail->save();
                if ($save) {

                    $success_output = '<div class="alert alert-success"><strong>Success!</strong> Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ liên hệ lại với bạn.</div>';
                }else{
                    $success_output = '<div class="alert alert-danger"><strong>ERROR!</strong> Lỗi lưu CartDetail</div>';
                }
            }catch (Exception $e){
                DB::rollBack();
                $err_array[] = 'ERROR!transaction cart';
                // return back()
                // ->withInput()
                // ->with('err', $e->getMessage());
            }
            DB::commit();
            $output=array(
                'error'=>$err_array,
                'success' => $success_output
            );
            return json_encode($output);
        }
    }
    /**
     * 
     * 
     * */
    public function addCart(Request $request){
        if ($request->ajax()) {
            $result='';
            $id = $request->id;
            // tham số danh sach cart
            $count_li= $request->count_li;
            $price = $request->price;
            $product = Product::with('translation')->where('id',$id)->first();
            $name_product = $product->translation()->first()->title;
            if($name_product==null){
                $name_product = $product->translation('vi')->first()->title;
            }
            $img = $product->photo;
            $images = explode("__", $img);
            $cart = Cart::add([
                'id'=>$id, 
                'name'=>$name_product, 
                'qty'=>1,
                'price'=>(int)$price,
                'options'=>['image'=>$images[0],'slug'=>$product->slug,'thanhtien'=>number_format((int)$price)]]);
            $total_amount = Cart::subtotal(0);

            $result .='
            <li class="header-cart-item"  style="border-bottom: 1px solid #f3f3f3;">
            <div class="header-cart-item-img">
            <img src="upload/products/'.$images[0].'" alt="image">
            </div>
            <div class="header-cart-item-txt">
            <a href="'.$request->base_url.'"/product/"'.$product->slug.'" class="header-cart-item-name">
            '.$product->translation()->first()->title.'
            </a>
            <span class="header-cart-item-info">
            <span id="qty_'.$count_li.'">1</span> x <span id="price_'.$count_li.'">'.$product->price.'</span> <strong style="color:red;">(VNĐ)</strong>
            </span>
            </div>
            </li>
            ';
            return response()->json(['html'=>$result,'total'=>$total_amount]);
        }
    }

    public function updateCart(Request $request){
        $idsp = $request->id;
        $soluongmoi = $request->soluongmoi;
        $dongia = $request->dongia;
        $product = Product::where('id',$idsp)->first();
        $quantity = $product->quantity;
        $rowId= $request->rowId;
        if ($soluongmoi > $quantity) {
            $err = 'errors';
            $qty = $quantity;
        }else{
            $err = null;
            $qty = null;
            
            Cart::update($rowId,['qty'=>$soluongmoi]);
        }
        $contentcart = Cart::content();
        $total_amount = Cart::subtotal(0);
        return response()->json(['cart'=>$contentcart,'err'=>$err, 'quantity'=>$qty, 'total'=>$total_amount, 'thanhtien'=>number_format($soluongmoi*$dongia)]);
    }

    public function viewCart(){
        $tinh = Devvn_tinhthanhpho::all();
        $contentcart = Cart::content();
        // dd($contentcart);
        $total = Cart::subtotal(0);
        return view('frontend.page.cart',compact('contentcart','total','tinh'));
    }
    /**
     * Deletes a product from the shopping cart.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function count(){
        $count_cart = Cart::count();
        return $count_cart;
    }
     /**
     * Deletes a product from the shopping cart.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
     public function destroy(){
        $destroy=Cart::destroy();
        if ($destroy) {
            return "true";
        }
    }
    /**
     * 
     * */
    public function getquanhuyen(Request $request){
        $html ='';
        $matp = $request->matp;
        $quanhuyen=Devvn_quanhuyen::where('matp',$matp)->get();
        foreach ($quanhuyen as $value) {
            $html .= '<option value="'.$value->maqh.'">'.$value->name.'</option>';
        }
        return $html;
    }
    /**
     * 
     * */
    public function getxa(Request $request){
        $html ='';
        $maqh = (int)$request->idqh;
        $xa=Devvn_xaphuongthitran::where('maqh',$maqh)->get();
        foreach ($xa as $value) {
            $html .= '<option value="'.$value->xaid.'">'.$value->name.'</option>';
        }
        return $html;
    }

    public function viewOrdered(){
        if($bill = Bill::with('user','bill_detail')
            ->where('customer_id','=',Sentinel::getUser()->id)
            ->get())
        {
            $order =$bill;
        }else{
            $order = null;
            $product = null;
        }
        if ($order !=null) {
            $product = Product::with('translation')->get();
        }
        return view('frontend.page.ordered',compact('order','product'));
    }
}
