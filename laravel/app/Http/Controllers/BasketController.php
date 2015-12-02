<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use Cart;
use larashop\Products;
use Setting;

class BasketController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        
        /*
        если в корзине нет товаров с ID
        то опустошить корзину
        */
        
        $cart = Cart::content();
        $emptyFlag = true;
        foreach ($cart as $value) {
            
            if (is_int($value->id)) {
                $emptyFlag = false;
            }
        }
        
        //dd($cart);
        if ($emptyFlag == true) {
            Cart::destroy();
        }
        
        $data = ['cart' => $cart, 'i' => 1, 'totalSumm' => Cart::total() , 'totalCount' => Cart::count() ];
        if (Cart::count() == 0) {
            return view('emptycart');
        }
        return view('cart')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //updateFast
    public function updateFast(Request $request) {
        $status = $request->status;
        
        $cart = Cart::search(['id' => 'fast']);
        
        if (!$cart[0]) {
            
            Cart::add('fast', 'Быстрая доставка', 1, intval(Setting::get('product.fast')) , []);
        } 
        else {
            $cart = Cart::search(['id' => 'fast']);
            Cart::remove($cart[0]);
            
            //return $cart;
            
        }
    }
    
    //updateGift
    public function updateGift(Request $request) {
        $cart = Cart::search(['id' => 'gift']);
        
        if (!$cart[0]) {
            
            Cart::add('gift', 'Подарочная упаковка', 1, intval(Setting::get('product.gift')) , []);
        } 
        else {
            $cart = Cart::search(['id' => 'gift']);
            Cart::remove($cart[0]);
            
            //return $cart;
            
        }
    }
    public function updateDelivery(Request $request) {
        $status = $request->status;
        
        if ($status == 'true') {
            $cart = Cart::search(['id' => 'np']);
            
            if (!$cart[0]) {
                
                Cart::add('np', 'Доставка по адресу', 1, intval(Setting::get('product.np')) , []);
            }
        } 
        else if ($status == 'false') {
            $cart = Cart::search(['id' => 'np']);
            Cart::remove($cart[0]);
            
            //return $cart;
            
        }
    }
    
    public function create() {
        
        //
        
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
    
    //storeProduct
    public function storeProduct(Request $request, $id) {
        
        //
        
        $product = Products::findOrFail($id);
        
        //Cart::add('293ad', 'Product 1', 1, 9.99, array('size' => 'large'));
        
        //dd($prod_arr);
        //$cartEl=Cart::search(['id' => intval($product->id)]);
        //dd($cartEl);
        
        //Cart::destroy();
        Cart::add(intval($product->id) , $product->name, 1, intval($product->price) , []);
        
        //Cart::add('192ao12', 'Product 1', 1, 9.99);
        //Cart::add('192ao12', 'Product 1', 1, 9.99);
        //$cart=Cart::content();
        //dd($cart);
        
        // return dd(Cart::content());
        
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
        
        Cart::update($id, $request->qty);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy() {
        
        //
        Cart::destroy();
    }
    
    //destroyElement
    public function destroyElement($id) {
        
        //
        Cart::remove($id);
    }
}
