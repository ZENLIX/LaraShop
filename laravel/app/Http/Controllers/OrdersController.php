<?php
namespace larashop\Http\Controllers;

use File;
use Illuminate\Http\Request;
use larashop\Clients;
use larashop\Http\Requests;
use larashop\Options;
use larashop\OrderFiles;
use larashop\OrderItems;
use larashop\Products;
use larashop\Purchase;
use Mail;
use Setting;
use Validator;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Purchase::all();

        foreach ($orders as $order) {

            if ($order->status == 'paid') {
                $order->rowStyle = 'warning';
            } else if ($order->status == 'sent') {
                $order->rowStyle = 'success';
            } else {
                $order->rowStyle = '';
            }

            $totalCount = 0;
            $totalSumm = 0;

            $itemFast = false;
            $itemGift = false;

            foreach ($order->items as $item) {

                if ($item->product_id == 'np') {
                    $totalSumm = $totalSumm + (Setting::get('product.np'));
                } else if ($item->product_id == 'fast') {
                    $itemFast = true;
                    $totalSumm = $totalSumm + (Setting::get('product.fast'));
                } else if ($item->product_id == 'gift') {
                    $itemGift = true;
                    $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
                } else {


                    if (strpos($item->product_id, '0000')) {
                        $pID = explode('0000', $item->product_id);
                        $option = Options::findOrFail($pID[1]);
                        $product = Products::findOrFail($pID[0]);
                        $productPrice = $option->price;
                        $item->productPrice = $productPrice;
                        $item->productName = $product->name . ' (' . $option->name . ')';

                    } else {
                        $productPrice = $item->product->price;
                        $item->productPrice = $item->product->price;
                        $item->productName = $item->product->name;
                    }


                    $totalCount = $totalCount + $item->qty;
                    $totalSumm = $totalSumm + ($productPrice * $item->qty);
                }
            }
            $order->itemFast = $itemFast;
            $order->itemGift = $itemGift;
            $order->totalCount = $totalCount;
            $order->totalSumm = $totalSumm;
        }

        $data = ['orders' => $orders, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.orders')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function storeItem(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $validator = Validator::make($request->all(), ['qty' => 'required|integer']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $item = new OrderItems;

            if ($request->options != '0') {

                $item->product_id = $request->item . '0000' . $request->options;

            } else {
                $item->product_id = $request->item;

            }
            $item->order_id = $id;
            $item->qty = $request->qty;


            $item->save();

            $request->session()->flash('alert-success', 'Заказ отредактирован!');
            return redirect('orders/edit/' . $id);
        }
    }

    public function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Purchase::findOrFail($id);

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

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        if ($order->status == 'paid') {
            $pay_status = 'Оплачено, ожидает отправку.';
        } else if ($order->status == 'sent') {
            $pay_status = 'Отправлено получателю.';
        } else {
            $pay_status = 'Новый заказ, ожидает оплату.';
        }

        $data = ['order' => $order, 'delivery_type' => $delivery_type, 'pay_type' => $pay_type, 'pay_status' => $pay_status, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.order')->with($data);;
    }

    public function showFile($id)
    {

        $file = OrderFiles::where('hash', '=', $id)->firstOrFail();

        $filePath = 'files/uploads/' . $file->hash . '.' . $file->extension;

        $headers = array(
            'Content-Type' => $file->mime
        );

        return response()->download($filePath, $file->name, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Purchase::findOrFail($id);

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {

            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        $dNP = true;
        $dADR = false;

        if ($order->items()->where('product_id', 'np')->exists()) {
            $dNP = false;
            $dADR = true;
        }

        $privat24 = false;
        $privat_terminal = false;
        $liqpay = false;

        switch ($order->pay_type) {
            case 'privat24':
                // code...
                $privat24 = true;
                break;

            case 'privat_terminal':
                // code...
                $privat_terminal = true;
                break;

            case 'liqpay':
                // code...
                $liqpay = true;
                break;

            default:
                // code...
                break;
        }

        $prods = Products::all();
        $prods_arr = [];
        foreach ($prods as $key => $value) {
            $prods_arr[$value->id] = $value->name;
        }

        $options = Options::all();
        $opt_arr = [];
        $opt_arr[0] = 'Нет';
        foreach ($options as $key => $value) {
            $opt_arr[$value->id] = $value->name;
        }


        $data = [
            'Options' => $opt_arr,
            'order' => $order, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'dNP' => $dNP, 'dADR' => $dADR, 'Prods' => $prods_arr, 'privat24' => $privat24, 'privat_terminal' => $privat_terminal, 'liqpay' => $liqpay, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.orderEdit')->with($data);;
    }

    //showCart
    public function showCart($id)
    {
        $order = Purchase::findOrFail($id);

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {
            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {

                if (strpos($item->product_id, '0000')) {
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        $data = ['order' => $order, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.cartOrder')->with($data);
    }

    //updateDelivery
    public function updateDelivery(Request $request, $id)
    {
        $status = $request->status;

        $order = Purchase::findOrFail($id);

        if ($status == 'true') {

            if ($order->items()->where('product_id', 'np')->exists()) {
                $item = OrderItems::where('product_id', 'np')->where('order_id', $id);
                $item->delete();
            }

            else {

                $newItem = new OrderItems;
                $newItem->order_id = $id;
                $newItem->product_id = 'np';
                $newItem->save();
            }
        } else if ($status == 'false') {
            $item = OrderItems::where('product_id', 'np')->where('order_id', $id);
            $item->delete();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function updateFast(Request $request, $id)
    {

        $order = Purchase::findOrFail($id);

        if ($order->items()->where('product_id', 'fast')->exists()) {
            $item = OrderItems::where('product_id', 'fast')->where('order_id', $id);
            $item->delete();
        }

        else {

            $newItem = new OrderItems;
            $newItem->order_id = $id;
            $newItem->product_id = 'fast';
            $newItem->save();
        }
    }

    public function updateGift(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);

        if ($order->items()->where('product_id', 'gift')->exists()) {
            $item = OrderItems::where('product_id', 'gift')->where('order_id', $id);
            $item->delete();
        }

        else {

            $newItem = new OrderItems;
            $newItem->order_id = $id;
            $newItem->qty = 1;
            $newItem->product_id = 'gift';
            $newItem->save();
        }
    }

    public function update(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);

        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255', 'tel' => 'required|min:2', 'email' => 'required|email']);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $client = Clients::findOrFail($order->client_id);

            $client->update(['name' => $request->name, 'tel' => $request->tel, 'email' => $request->email]);

            $order->update(['code' => $request->code, 'delivery_type' => $request->delivery_type, 'pay_type' => $request->pay_type, 'delivery_city' => $request->delivery_city, 'delivery_np' => $request->delivery_np, 'delivery_adr' => $request->delivery_adr, 'comment' => $request->comment, 'ttn' => $request->ttn]);

            $request->session()->flash('alert-success', 'Заказ отредактирован!');
            return redirect('orders/' . $id);
        }
    }

    //updateQty
    public function updateQty(Request $request, $id)
    {
        $item = OrderItems::where('order_id', $id)->where('id', $request->el)->first();
        $item->update(['qty' => $request->qty]);
    }

    //updateStatusNew
    public function updateStatusNew(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $order->status = 'new';
        $order->save();

        $client = $order->client;
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $data = ['orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.new', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ОЖИДАЕМ ОПЛАТЫ');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateStatusPaid(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $order->status = 'paid';
        $order->save();
        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        $client = $order->client;
        $data = ['orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.paid', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ОПЛАТА ПРИНЯТА');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateStatusSent(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $order->status = 'sent';
        $order->save();

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $client = $order->client;
        $data = ['order' => $order, 'orderCode' => $order->code, 'logoMain' => $logoMain, 'appURL' => config('app.url')];
        Mail::queue('mail.sent', $data, function ($message) use ($client) {
            $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
            $message->subject(Setting::get('config.sitename') . ' - ЗАКАЗ ОТПРАВЛЕН');
            $message->to($client['email']);
        });

        $request->session()->flash('alert-success', 'Статус изменён!');
        return back();
    }

    public function updateTtn(Request $request, $id)
    {
        $order = Purchase::findOrFail($id);
        $order->ttn = $request->ttn;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showPrint($id)
    {
        $order = Purchase::findOrFail($id);

        ($order->delivery_np == 'np') ? $delivery_type = 'Склад Новая Почта' : $delivery_type = 'Курьерская доставка по адресу';

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

        $totalCount = 0;
        $totalSumm = 0;
        foreach ($order->items as $item) {
            if ($item->product_id == 'np') {
                $totalSumm = $totalSumm + (Setting::get('product.np'));
            } else if ($item->product_id == 'fast') {
                $totalSumm = $totalSumm + (Setting::get('product.fast'));
            } else if ($item->product_id == 'gift') {
                $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
            } else {


                if (strpos($item->product_id, '0000')) {
                    $pID = explode('0000', $item->product_id);
                    $option = Options::findOrFail($pID[1]);
                    $product = Products::findOrFail($pID[0]);
                    $productPrice = $option->price;
                    $item->productPrice = $productPrice;
                    $item->productName = $product->name . ' (' . $option->name . ')';
                    $item->productCover = $product->cover;
                    $item->productUrlhash = $product->urlhash;

                } else {
                    $item->productPrice = $item->product->price;
                    $item->productName = $item->product->name;
                    $item->productCover = $item->product->cover;
                    $item->productUrlhash = $item->product->urlhash;
                }


                $totalCount = $totalCount + $item->qty;
                $totalSumm = $totalSumm + ($item->productPrice * $item->qty);
            }
        }

        if ($order->status == 'paid') {
            $pay_status = 'Оплачено, ожидает отправку.';
        } else if ($order->status == 'sent') {
            $pay_status = 'Отправлено получателю.';
        } else {
            $pay_status = 'Новый заказ, ожидает оплату.';
        }

        $data = ['order' => $order, 'delivery_type' => $delivery_type, 'pay_type' => $pay_type, 'pay_status' => $pay_status, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm];
        return view('admin.orderPrint')->with($data);;
    }

    public function destroyElement(Request $request, $id)
    {
        $item = OrderItems::where('order_id', $id)->where('id', $request->el)->first();
        $item->delete();
    }

    //destroyElement
    public function destroy($id)
    {
        $order = Purchase::findOrFail($id);
        $order->delete();
    }
}
