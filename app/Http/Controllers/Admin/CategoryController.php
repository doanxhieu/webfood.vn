<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Http\Requests\Category\CategoryRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

use DB;

class CategoryController extends Controller
{
    
    private $catejoin;

    function __construct(){
        $this->catejoin = Category::leftJoin('category_translations as cate_t', 'cate_t.category_id', '=', 'categories.id')
        ->select('cate_t.name','cate_t.lang','categories.parent_id', 'categories.slug','categories.created_at','categories.id')
        ->orderBy('categories.id','ASC')
        ->get();
        return $this->catejoin;
    }

    public function whereLang(){
        return $this->catejoin->where('lang',app()->getLocale());
    }
    /**
     * get index category
     * @param
     * */
    public function index() {
        $cate_trans = $this->catejoin->where('lang', '=', app()->getLocale());
        $cate = Category::with('category_translation')->get();
        foreach ($cate as $key => $value) {
            $name[] = $value->category_translation()->first()->name;
        }
        return view('admin.category.index',compact('cate_trans'));
    }
    /**
     * get index form insert
     * 
     * */
    public function insert() {
        $cate =Category::all();
        $cate_trans = $this->catejoin->where('lang',app()->getLocale());
        foreach ($cate_trans as $key) {
            $tt[] = $key->parent_id;
        }
        return view('admin.category.insert',compact('cate_trans','cate'));
    }
    /**
     * insert to DB
     *  
     * */
    public function saveCate(CategoryRequest $request) {
        try {
            $flag = true;
            $locales = config('app.locales');
            $input = $request->all();
            foreach ($locales as $l => $val){
                if (CategoryTranslation::where('name',$input['name'][$l])->first()) {
                    $flag = false;
                    $check = $input['name'][$l];
                    break;
                }                
            }
            if($flag == true){
                $category = new Category;
                $category->slug = SlugService::createSlug(Category::class, 'slug',$input['name']['vi'] ? $input['name']['vi'] : $input['name']['en']);
                $category->parent_id = $request->parent_id;
                $category->save();

                foreach ($locales as $l => $val){
                    $cate_trans = new CategoryTranslation;
                    $cate_trans->category_id = $category->id;
                    $cate_trans->lang = $l;
                    $cate_trans->name = $input['name'][$l] ? $input['name'][$l]:'';
                    $cate_trans->save();
                }
                return redirect()->route('admin.category.view')->with('success','Thêm thành công!');
            }else{
                return redirect(route('admin.category.insert'))->with('notsuccess','Tên danh mục: '.$check.' đã tồn tại');
            }

        } catch (Exception $e) {
            return redirect(route('admin.category.insert'))->with('notsuccess',$e->getMessage());
        }
    }
    /**
     * update to DB
     *  
     * */
    public function saveUpdate(Request $request) {
        if($request->ajax()){
            try {
                $locales = config('app.locales');
                $lang = session('language');
                $id = $request->id;
                $name = $request->name;
                $category = Category::find((int)$id);
                $slug = SlugService::createSlug(Category::class, 'slug',$name);
                $category->slug = $slug;
                $category->parent_id = $request->parent_id;
                $category->updated_at=now();
                $category->save();

                $cate_trans = CategoryTranslation::where('category_id',(int)$id)->where('lang',app()->getLocale())->first();
                $cate_trans->name = $name;
                $cate_trans->save();
                return response()->json(['slug'=>$slug, 'success'=>true]);
            } catch (Exception $e) {
                return back()
                ->withInput()
                ->with('err', $e->getMessage());
            }
        }
    }
    
    public function delete(Request $request){
        try{
            $cate_id = $request->id;
            $cate = Category::findOrFail($cate_id);
            if ($cate) {
                if ($cate->translation()) {
                    $cate->translation()->where('categoryi_d', $cate_id)->delete();
                }
                $cate->delete();
                $success = __('message.Deleted successfully!');
                return response()->json([
                    'data_obj'=>$cate,
                    'success'=>$success
                ]);
            }else{
                $not_success = __('message.Deleted fail!');
                return response()->json([
                    'error'=>$not_success
                ]);
            }
        } catch (\Exception $e) {
            return back()
            ->withInput()
            ->with('err_del_exception', $e->getMessage());
        }
        
    }
}
