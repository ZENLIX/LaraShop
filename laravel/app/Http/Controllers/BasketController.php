<?php
namespace larashop\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use larashop\Http\Requests;
use larashop\Options;
use larashop\Products;
use Setting;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        if ($emptyFlag == true) {
            Cart::destroy();
        }

        $data = ['cart' => $cart, 'i' => 1, 'totalSumm' => Cart::total(), 'totalCount' => Cart::count()];
        if (Cart::count() == 0) {
            return view('emptycart');
        }

        return view('cart')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFast(Request $request)
    {
        $cart = Cart::search(['id' => 'fast']);

        if (!$cart[0]) {

            Cart::add('fast', 'Быстрая доставка', 1, intval(Setting::get('product.fast')), []);
        } else {
            $cart = Cart::search(['id' => 'fast']);
            Cart::remove($cart[0]);
        }
    }

    /**
     * @param Request $request
     */
    public function updateGift(Request $request)
    {
        $cart = Cart::search(['id' => 'gift']);

        if (!$cart[0]) {

            Cart::add('gift', 'Подарочная упаковка', 1, intval(Setting::get('product.gift')), []);
        } else {
            $cart = Cart::search(['id' => 'gift']);
            Cart::remove($cart[0]);
        }
    }

    /**
     * @param Request $request
     */
    public function updateDelivery(Request $request)
    {
        $status = $request->status;

        if ($status == 'true') {
            $cart = Cart::search(['id' => 'np']);

            if (!$cart[0]) {

                Cart::add('np', 'Доставка по адресу', 1, intval(Setting::get('product.np')), []);
            }
        } else if ($status == 'false') {
            $cart = Cart::search(['id' => 'np']);
            Cart::remove($cart[0]);
        }
    }

    public function create()
    {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //

    }

    public function storeProduct(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        if ($request->opt != "Null") {
            $option = Options::findOrFail($request->opt);
            $product->name = $product->name . " (" . $option->name . ") ";
            $product->price = $option->price;
            $product->id = $product->id . "0000" . $option->id;

        }

        Cart::add(intval($product->id), $product->name, 1, intval($product->price), []);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->qty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Cart::destroy();
    }

    public function destroyElement($id)
    {
        Cart::remove($id);
    }
}
