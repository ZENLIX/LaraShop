<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use Validator;
use Visitor;
use Setting;
use larashop\Gallery;
use larashop\Products;
use larashop\Categories;
use larashop\Info;
use larashop\Purchase;
use larashop\Clients;
use larashop\OrderItems;
use larashop\Comments;
use larashop\Options;
use Sitemap;
use Cart;
use URL;
class HomeController extends Controller
{
    



    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function totalNavLabel() {
        return Cart::count();
    }
    
    public function index() {
        
        //
        Visitor::log();
        $products = Products::orderBy('sort_id', 'asc')->take(6)->get();
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        
        //dd(Setting::get('config.maintitle'));
        
        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');
        
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        
        $data = [
        'PageDescr' => Setting::get('config.maindesc') , 'PageWords' => Setting::get('config.mainwords') , 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle') , 'cats' => $cats, 'totalNavLabel' => $this->totalNavLabel() , 'mainProdImg' => $mainProdImg, 'logoMain' => $logoMain, 'products' => $products, 
        ];
        return view('home')->with($data);
    }
    
    public function indexSitemap() {
        
        //$date=LocalizedCarbon::parse($order->created_at)->format('d M Y H:i:s');
        //Sitemap::addSitemap('/catalog');
        Sitemap::addtag(URL::to('/') , date('Y-m-d H:i:s'));
        Sitemap::addtag(URL::to('/gallery') , date('Y-m-d H:i:s'));
        Sitemap::addtag(URL::to('/catalog') , date('Y-m-d H:i:s'));
        Sitemap::addtag(URL::to('/info') , date('Y-m-d H:i:s'));
        
        $cats = Categories::all();
        
        foreach ($cats as $cat) {
            Sitemap::addtag(URL::to('/' . $cat->urlhash) , $cat->updated_at, 'daily', '0.8');
        }
        
        $products = Products::all();
        
        foreach ($products as $product) {
            Sitemap::addtag(URL::to('/' . $product->urlhash . '.html') , $product->updated_at, 'daily', '0.8');
        }
        
        //$sitemap = App::make("sitemap");
        //$sitemap->add(URL::to('/'), date('Y-m-d H:i:s'), '1.0', 'daily');
        
        return Sitemap::renderSitemap();
    }
    
    //showGallery
    public function showGallery() {
        Visitor::log();
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        
        $images = Gallery::orderBy('sort_id', 'asc')->get();
        
        $data = [
        'PageDescr' => Setting::get('config.galdesc') , 'PageWords' => Setting::get('config.galwords') , 'PageAuthor' => '', 'PageTitle' => Setting::get('config.galtitle') , 'logoMain' => $logoMain, 'totalNavLabel' => $this->totalNavLabel() , 'images' => $images
        ];
        return view('gallery')->with($data);
    }
    
    public function showInfo() {
        Visitor::log();
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        
        $info = Info::find('1');
        
        $data = [
        'PageDescr' => Setting::get('config.infodesc') , 'PageWords' => Setting::get('config.infowords') , 'PageAuthor' => '', 'PageTitle' => Setting::get('config.infotitle') , 'logoMain' => $logoMain, 'totalNavLabel' => $this->totalNavLabel() , 'info' => $info
        ];
        return view('info')->with($data);
    }
    
    //showCheckByCode
    public function showCheckByCode($id) {
        
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        
        //$info=Info::find('1');
        
        $order = Purchase::whereCode($id)->firstorfail();
        $client = $order->client;
        
        $orderItems = OrderItems::whereOrder_id($order->id)->get();
        
        ($order->delivery_type == 'np') ? $delivery_type = 'Склад Новая Почта' : $delivery_type = 'Курьерская доставка по адресу';
        
        //'nal','privat24','privat_terminal','liqpay'
        switch ($order->pay_type) {
            case 'nal':
                $pay_type = 'Наличными';
                // code...
                break;

            case 'privat24':
                $pay_type = 'Privat24. Через онлайн-систему для владельцев карт ПриватБанка.';
                // code...
                break;

            case 'privat_terminal':
                $pay_type = 'На карту. Через пополнение карты, например через терминал самообслуживания.';
                
                //Через пополнение карты, например через терминал самообслуживания.
                // code...
                break;

            case 'liqpay':
                $pay_type = 'LiqPay. Через онлайн систему для владельце карт других банков. (+10% комиссия)';
                // code...
                break;

            default:
                $pay_type = 'Не указано';
                // code...
                break;
        }
        
        if ($order->status == 'paid') {
            $pay_status = '<span class=\'label label-warning\'> Оплачено, ожидает отправку.</label>';
        } 
        else if ($order->status == 'sent') {
            $pay_status = '<span class=\'label label-success\'> Отправлено получателю.</span>';
        } 
        else {
            $pay_status = '<span class=\'label label-primary\'> Новый заказ, ожидает оплату.</span>';
        }
        
        $totalCount = $orderItems->sum('qty');
        
        //$totalCount=$orderItems->sum('qty');
        
        $totalSumm = 0;
        foreach ($orderItems as $value) {
            // code...
            
            if ($value->product_id == 'np') {
                $totalSumm = $totalSumm + Setting::get('product.np');
            } 
            else if ($value->product_id == 'fast') {
                $totalSumm = $totalSumm + Setting::get('product.fast');
            } 
            else if ($value->product_id == 'gift') {
                $totalSumm = $totalSumm + (Setting::get('product.gift') * $value->qty);
            } 
            else {
                

                    if (strpos($value->product_id, '0000') ) {
                        //dd('consist');
                        $pID=explode('0000', $value->product_id);
                        $option=Options::findOrFail($pID[1]);
                        $product=Products::findOrFail($pID[0]);
                        $productPrice= $option->price;
                        $value->productPrice = $productPrice;
                        $value->productName = $product->name . ' (' . $option->name . ')' ;
                        $value->productCover = $product->cover;
                        $value->productUrlhash = $product->urlhash;

                    }
                    else {
                        $productPrice = $value->product->price;
                        $value->productPrice = $value->product->price;
                        $value->productName = $value->product->name;
                        $value->productCover = $value->product->cover;
                        $value->productUrlhash = $value->product->urlhash;
                    }




                //echo   $value->qty."__";
                $totalSumm = $totalSumm + ($value->productPrice * $value->qty);
            }
        }
        
        $data = [
        'PageDescr' => Setting::get('config.maindesc') , 'PageWords' => Setting::get('config.mainwords') , 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle') , 'logoMain' => $logoMain, 'findflag' => true, 'pay_status' => $pay_status, 'orderCode' => $id, 'client' => $client, 'delivery_type' => $delivery_type, 'order' => $order, 'totalNavLabel' => $this->totalNavLabel() , 'pay_type' => $pay_type, 'orderItems' => $orderItems, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm
        ];
        return view('check')->with($data);
    }
    
    public function showCheck() {
        Visitor::log();
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        
        //$info=Info::find('1');
        
        $data = [
        'PageDescr' => Setting::get('config.maindesc') , 'PageWords' => Setting::get('config.mainwords') , 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle') , 'logoMain' => $logoMain, 'totalNavLabel' => $this->totalNavLabel() , 'findflag' => false
        ];
        return view('check')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        //
        
    }
    
    //storeComment
    public function storeComment(Request $request, $id) {
        
        $product = Products::find($id);
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:120', 'email' => 'required|email', 'msg' => 'required|min:5', 'captcha' => 'required|captcha']);
        
        if ($validator->fails()) {
            
            return redirect($product->urlhash . '.html#comment')->withErrors($validator)->withInput();
        } 
        else {
            
            $comment = new Comments;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->msg = $request->msg;
            $comment->product_id = $product->id;
            $comment->save();
            
            $request->session()->flash('alert-success', 'Комментарий отправлен и будет обработан после модерации!');
            return redirect($product->urlhash . '.html#comment');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function destroy($id) {
        
        //
        
    }
}
