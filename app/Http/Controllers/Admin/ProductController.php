<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Translations;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\SavelFileImage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Sentinel;
use DB;
use App\Models\User;

class ProductController extends Controller
{
    private $cate_trans;
    private $product_trans;

    public function __construct(){
        $this->cate_trans = new CategoryController;
        $this->product_trans = Product::Join('product_translations as pt','pt.product_id','products.id')
        ->select('products.*',
            'pt.lang',
            'pt.title',
            'pt.brief',
            'pt.description')
        ->orderBy('products.id','DESC')
        ->get();
    }

    public function index() {
        // dd(Product::with('product_translations')->find(9)->translation()->title);
        $product_t = $this->product_trans->where('lang',app()->getLocale());
        $product=Product::all();
        foreach ($product as $value) {
            $user_p = User::with('products')->where('id',$value->user_id)->first();
        }
        return view('admin.product.index',compact('product_t','user_p'));
    }

    public function insert() {
        $cate_value = $this->cate_trans->whereLang();
        return view('admin.product.insert',compact('cate_value'));
    }

    public function readMore(Request $request){
        if ($request->ajax()) {
            $id =$request->id_product;
            $des = Product::find($id)->translation()->description;
            $output = ['readmore'=>$des];
            return json_encode($output);
        }
    }

    public function update($slug){
        $cate_value = $this->cate_trans->whereLang();
        $products_update = Product::findBySlugOrFail($slug);
        return view('admin.product.insert',compact('products_update','cate_value'));
    }

    public function SoftDelete(Request $request) {
        if ($request->ajax()) {
            $id = $request->id_product;
            $name = $request->name;
            $product = Product::find($id);
            $locales = config('app.locales');
            if ($product->delete()) {
                foreach ($locales as $l => $value) {
                    $product_trans = $product->translation($l);
                    $product_trans->delete();
                }
                
                $success = '<div class="alert alert-success"><strong>'.__('message.Deleted successfully!').'!</strong>'.$name.'</div>';
            }else{
             $success = '<div class="alert alert-success"><strong>'.__('message.Deleted fail!').'!</strong>'.$name.'</div>';
         }
         $output =['success'=>$success];
         return  json_encode($output);
     }
 }

 public function saveupdate(UpdateRequest $request,$id){
    DB::beginTransaction();
    if ($request->isMethod('post')) {
        try {
            $input =  $request->all();
            $product = Product::find($id);
            if ($request->File('file')) {
                $name_exp = SavelFileImage::saveFile($request);
                $name_image = implode('__', $name_exp);
            }else{
                $name_image = $input['file'];
            }
            $product->slug = SlugService::createSlug(Product::class, 'slug', $input['title']['vi']?$input['title']['vi']:$input['title']['en']);
            $product->category_id = $input['category_id'];
            $product->photo = $name_image;
            $product->price = $input['price'];
            $product->quantity = $input['quantity'];
            $product->updated_at = now();
            $product->save();

            $locales = config('app.locales');
            foreach ($locales as $l=>$val){
                $product_translation = Product_Translations::where('product_id','=',$id)->where('lang',$l)->first();
                $product_translation->title = $input['title'][$l]?$input['title'][$l]:'';
                $product_translation->brief = $input['brief'][$l]?$input['brief'][$l]:'';
                $product_translation->description= $input['description'][$l]?$input['description'][$l]:'';
                $product_translation->updated_at = now();
                $product_translation->save();
            }
            DB::commit();
            return redirect(route('admin.product.update',$product->slug))->with('success_update',__('message.update_success'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.product.update'))->with('err_update',$e->getMessage());
        }
    }
    
}

public function saveInsert(ProductRequest $request) {
    DB::beginTransaction();
    if ($request->isMethod('post')) {
        try {
            $flag=true;
            $product = new Product;
            $name_file = array();
            $name_file = SavelFileImage::saveFile($request);
            $img =  implode('__', $name_file);
            $user_id = Sentinel::getUser()->id;

            $locales = config('app.locales');
            $lang = app()->getLocale();
            $input = $request->all();

            foreach ($locales as $l => $val){
                if (Product_Translations::where('title',$input['title'][$l])->first()) {
                    $flag = false;
                    $check = $input['title'][$l];
                    break;
                }                
            }
            if ($flag==false) {
                return redirect()->back()->with('err','Tiêu đề sản phẩm: '.$check.' đã tồn tại!');
            }else{

                $product->slug = SlugService::createSlug(Product::class, 'slug',$input['title']['vi']?$input['title']['vi']:$input['title']['en']);
                $product->category_id = $input['category_id'];
                $product->photo = $img;
                $product->user_id = $user_id;
                $product->price = $input['price'];
                $product->quantity = $input['quantity'];
                $product->created_at = now();
                $product->save();

                foreach ($locales as $l => $value) {
                    $product_trans = new Product_Translations;
                    $product_trans->product_id = $product->id;
                    $product_trans->lang = $l;
                    $product_trans->title = $input['title'][$l] ? $input['title'][$l]:'';
                    $product_trans->brief = $input['brief'][$l] ? $input['brief'][$l]:'';
                    $product_trans->description = $input['description'][$l] ? $input['description'][$l]: '';
                    $product_trans->save();
                }
                DB::commit();
                return redirect()->route('admin.product.insert')->with('success','success');
            }

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

}
}
