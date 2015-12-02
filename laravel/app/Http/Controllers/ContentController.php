<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use Validator;
use larashop\Categories;
use larashop\Products;
use larashop\Info;
use larashop\Gallery;
use larashop\Purchase;
use larashop\Comments;
use Image;
use File;
use Hash;
use DB;

//use Input;

class ContentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        
        
    }
    
    public function indexCat() {
        
        //
        
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        
        $data = ['cats' => $cats, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.content.category')->with($data);
    }
    public function createCat() {
        
        //
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.content.categoryCreate')->with($data);
    }
    
    public function editCat($id) {
        
        //
        $cat = Categories::findOrFail($id);
        
        $data = ['cat' => $cat, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.content.categoryEdit')->with($data);
    }
    
    public function updateCat(Request $request, $id) {
        
        $cat = Categories::findOrFail($id);
        
        if (isset($cat->cover)) {
            File::delete('files/cats/img/' . $cat->cover);
        }
        
        $cover = $request->file('cover');
        
        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        
        //$extension = $cover->getClientOriginalExtension();
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:255', 'description' => 'required|min:2|max:255', 'urlhash' => 'required|min:2|max:255', 'cover' => 'mimes:jpeg,bmp,png']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            $coverdb = $cat->cover;
            if (isset($cover)) {
                $img = Image::make($cover);
                
                // resize image
                $img->fit(200, 200);
                
                // save image
                $string = str_random(40);
                $img->save('files/cats/img/' . $string . '.' . $extension);
                
                $coverdb = $string . '.' . $extension;
            }
            $arr = array(
                'name' => $request->name,
                'description' => $request->description,
                'cover' => $coverdb,
                'urlhash' => $request->urlhash
            );
            $cat->update($arr);
            
            $request->session()->flash('alert-success', 'Категория успешно обновлена!');
            return redirect('content/cat');
        }
    }
    
    public function storeCat(Request $request) {
        
        //
        
        $cover = $request->file('cover');
        
        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        
        //$extension = $cover->getClientOriginalExtension();
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:255', 'description' => 'required|min:2|max:255', 'urlhash' => 'required|min:2|max:255', 'cover' => 'mimes:jpeg,bmp,png']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            $coverdb = Null;
            if (isset($cover)) {
                $img = Image::make($cover);
                
                // resize image
                $img->fit(200, 200);
                
                // save image
                $string = str_random(40);
                $img->save('files/cats/img/' . $string . '.' . $extension);
                
                $coverdb = $string . '.' . $extension;
            }
            $arr = array(
                'name' => $request->name,
                'description' => $request->description,
                'cover' => $coverdb,
                'urlhash' => $request->urlhash
            );
            Categories::create($arr);
            $request->session()->flash('alert-success', 'Категория успешно создана!');
            return redirect('content/cat');
        }
    }
    
    public function sortCat(Request $request) {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {
            
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('categories')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }
        
        //dd($tap);
        
        
    }
    public function destroyCat(Request $request, $id) {
        
        $cat = Categories::findOrFail($id);
        
        if (isset($cat->cover)) {
            File::delete('files/cats/img/' . $cat->cover);
        }
        
        $cat->delete();
        
        //$request->session()->flash('alert-success', 'Категория успешно удалена!');
        //return redirect('content/cat');
        
        
    }
    
    public function indexProduct() {
        
        //
        $products = Products::orderBy('sort_id', 'asc')->get();
        
        $data = ['products' => $products, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.content.product')->with($data);
    }
    
    public function createProduct() {
        
        //
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $cats_arr = [];
        foreach ($cats as $key => $value) {
            $cats_arr[$value->id] = $value->name;
        }
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->name;
        }
        
        //dd($prods_arr);
        $data = ['CatList' => $cats_arr, 'Prods' => $prods_arr, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.content.productCreate')->with($data);
    }
    
    public function storeProduct(Request $request) {
        
        //
        
        $cover = $request->file('cover');
        
        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 'true' : $isset = 'false';
        
        //$extension = $cover->getClientOriginalExtension();
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:255', 'description' => 'required|min:2', 'urlhash' => 'required|min:2|max:255', 'cover' => 'mimes:jpeg,bmp,png', ]);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            $coverdb = Null;
            if (isset($cover)) {
                
                $img = Image::make($cover);
                
                // resize image
                $img->fit(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);
                
                // resize image
                $img_small = Image::make($cover)->fit(50, 50, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // save image
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);
                
                $coverdb = $string . '.' . $extension;
            }
            $arr = array(
                'name' => $request->name,
                'title' => $request->title,
                'keywords' => $request->keywords,
                'description' => $request->description,
                'description_full' => $request->description_full,
                'values' => $request->values,
                'cover' => $coverdb,
                'price' => $request->price,
                'price_old' => $request->price_old,
                'label' => $request->label,
                'isset' => $isset,
                'urlhash' => $request->urlhash,
                'categories_id' => $request->categories_id
            );
            
            $product = Products::create($arr);
            $product->recommendProds()->attach($request->related);
            $request->session()->flash('alert-success', 'Продукт успешно создан!');
            return redirect('content/prod');
        }
    }
    
    public function sortProduct(Request $request) {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {
            
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('products')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }
        
        //dd($tap);
        
        
    }
    
    public function editProduct($id) {
        
        //
        $product = Products::findOrFail($id);
        
        //dd($product->recommendProd);
        
        $myprod = $product->recommendProd;
        $myprods_arr = [];
        foreach ($myprod as $key => $value) {
            
            //$myprods_arr[] = $value->id;
            array_push($myprods_arr, $value->product_id_recommend);
        }
        
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $prods = Products::orderBy('sort_id', 'asc')->get();
        $cats_arr = [];
        foreach ($cats as $key => $value) {
            $cats_arr[$value->id] = $value->name;
        }
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->name;
        }
        
        //dd($prods_arr);
        ($product->isset == 'false') ? $product->isset = Null : $product->isset;
        
        //dd($product->isset);
        $data = ['CatList' => $cats_arr, 'Prods' => $prods_arr, 'myProds' => $myprods_arr, 'product' => $product, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.content.productEdit')->with($data);
    }
    
    public function updateProduct(Request $request, $id) {
        $product = Products::findOrFail($id);
        
        $cover = $request->file('cover');
        
        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;
        ($request->isset == 'true') ? $isset = 'true' : $isset = 'false';
        
        //$extension = $cover->getClientOriginalExtension();
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:255', 'description' => 'required|min:2', 'urlhash' => 'required|min:2|max:255', 'cover' => 'mimes:jpeg,bmp,png', ]);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            
            if ($cover) {
                if (isset($product->cover)) {
                    File::delete('files/cats/img/' . $product->cover);
                    File::delete('files/cats/img/small/' . $product->cover);
                }
                $img = Image::make($cover);
                
                // resize image
                $img->fit(900, 800);
                
                // save image
                $string = str_random(40);
                $img->save('files/products/img/' . $string . '.' . $extension);
                
                // resize image
                $img_small = Image::make($cover)->fit(50, 50, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // save image
                $img_small->save('files/products/img/small/' . $string . '.' . $extension);
                
                $coverdb = $string . '.' . $extension;
            } 
            else {
                $coverdb = $product->cover;
            }
            
            $arr = array(
                'name' => $request->name,
                'title' => $request->title,
                'keywords' => $request->keywords,
                'description' => $request->description,
                'description_full' => $request->description_full,
                'values' => $request->values,
                'cover' => $coverdb,
                'price' => $request->price,
                'price_old' => $request->price_old,
                'label' => $request->label,
                'isset' => $isset,
                'urlhash' => $request->urlhash,
                'categories_id' => $request->categories_id
            );
            
            $product->update($arr);
            
            $product->recommendProds()->detach();
            $product->recommendProds()->attach($request->related);
            
            $request->session()->flash('alert-success', 'Продукт успешно отредактирован!');
            return redirect('content/prod');
        }
    }
    
    public function destroyProduct(Request $request, $id) {
        
        $prod = Products::findOrFail($id);
        
        if (isset($prod->cover)) {
            File::delete('files/cats/img/' . $prod->cover);
            File::delete('files/cats/img/small/' . $prod->cover);
        }
        
        $prod->delete();
        
        //$request->session()->flash('alert-success', 'Категория успешно удалена!');
        //return redirect('content/cat');
        
        
    }
    
    public function indexGallery() {
        
        //
        
        $images = Gallery::orderBy('sort_id', 'asc')->get();
        
        $data = ['images' => $images, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.content.gallery')->with($data);
    }
    
    //sortImage
    public function sortImage(Request $request) {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {
            
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('gallery')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }
        
        //dd($tap);
        
        
    }
    
    //storeImage
    public function storeImage(Request $request) {
        
        $validator = Validator::make($request->all() , ['imagefile' => 'required|mimes:jpeg,bmp,png', ]);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            
            $imagefile = $request->file('imagefile');
            $extension = $imagefile->getClientOriginalExtension();
            $string = str_random(40);
            $filename = $string . '.' . $extension;
            
            $file = Image::make($imagefile)->fit(1200, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // save image
            $file->save('files/gallery/' . $filename);
            
            $filesmall = Image::make($imagefile)->fit(220, 220, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filesmall->save('files/gallery/small/' . $filename);
            
            $image = new Gallery;
            $image->filename = $filename;
            $image->save();
            
            $request->session()->flash('alert-success', 'Файл загружен!');
            return redirect('content/gallery');
        }
    }
    
    //indexComments
    public function indexComments() {
        
        $comments = Comments::orderby('created_at', 'desc')->orderby('approve')->get();
        $data = ['comments' => $comments, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.content.comments')->with($data);
    }
    
    //updateCommentsApprove
    public function updateCommentsApprove(Request $request, $id) {
        $comment = Comments::find($id);
        
        //dd($id);
        $comment->update(['approve' => 'true']);
        $request->session()->flash('alert-success', 'Комментарий активен!');
        return redirect('content/comments');
    }
    
    //destroyComments
    public function destroyComments(Request $request, $id) {
        
        $comment = Comments::find($id);
        $comment->delete();
        $request->session()->flash('alert-success', 'Комментарий удалён!');
        return redirect('content/comments');
    }
    
    public function indexInfo() {
        
        //
        $info = Info::find('1');
        $data = ['info' => $info, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.content.info')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        //
        
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function updateInfo(Request $request) {
        
        $info = Info::find('1');
        
        $info->update(['text' => $request->text]);
        $request->session()->flash('alert-success', 'Информация обновлена!');
        return redirect('content/info');
    }
    
    public function store(Request $request) {
        
        //
        
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        //
        
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        //
        
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        //
        
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroyImage($id) {
        
        //
        $image = Gallery::find($id);
        
        File::delete('files/gellery/' . $image->filename);
        File::delete('files/gellery/small/' . $image->filename);
        
        $image->delete();
    }
    
    public function destroy($id) {
        
        //
        
        
    }
}
