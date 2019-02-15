<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Product;
use  App\Mail\SendMailController;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class BillController extends Controller
{
    public function index($status) {
        switch (substr($status,7)) {
            // hủy
            case 3:
            $bill = Bill::with('user','bill_detail')->where('status','=',3)->orderBy('created_at', 'desc')->get();
            break;
            // đang vận chuyển
            case 1:
            $bill = Bill::with('user','bill_detail')->where('status','=',1)->orderBy('created_at', 'desc')->get();
            break;
            // đã giao hàng
            case 2:
            $bill = Bill::with('user','bill_detail')->where('status','=',2)->orderBy('created_at', 'desc')->get();
            break;
            // Chưa xử lý
            default:
            $bill = Bill::with('user','bill_detail')->where('status','=',0)->orderBy('created_at', 'desc')->get();
            break;
        }
        return view('admin.bill.index',compact('bill'));
    }

    public function saveChangeStatus(Request $request) {
        $input =$request->all();
        if ($request->checkmail) {
            $sendmail = (bool) $request->get('checkmail', true);
        }else{
            $sendmail = (bool) $request->get('checkmail', false);
        }
        $bill = Bill::findOrFail($input['id']);
        $customer_id = $bill->customer_id;
        $customer = User::findOrFail($customer_id);
        $bill->status = $input['status'];
        $save = $bill->save();
        // Lấy thông tin hiện thị email
        $bill_r = Bill::with('user','bill_detail')->where('bills.id','=',$input['id'])->first();
        $customer = ($bill_r->user()->first());
        $email_customer = $customer->email;
        $bill_detail = $bill_r->bill_detail()->get();
        // lay ten san pham
        foreach ($bill_detail as $key => $value) {
            $name_product[] = $product = Product::with('translation')->Where('products.id','=',$value->product_id)->first();
        }
        $data=[$customer,$bill_detail,$bill_r,$name_product];
        if ($sendmail && $save) {
            Mail::to($email_customer)->send(new SendMailController($data));
        }
        return redirect()->back()->with('success','Thay đổi trạng thái đơn hàng thành công!');
    }
    
    public function detail(Request $request) {
        try {
            $bill = Bill::with('bill_detail','user')->where('id','=',$request->id)->first();
            $dt = $bill->bill_detail()->get();
            $html='';
            foreach ($dt as $key => $value) {
                $product = Product::with('translation')->Where('products.id',$value->product_id)->first();
                $html .='<tr>
                <td>'.$product->translation()->first()->title.'</td>
                <td>'.$value->quantity.'</td>
                <td>'.number_format($value->amount).'</td>
                </tr>';
            }
            return response()->json(['bill'=>$bill,'html'=>$html]);

        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }



}
