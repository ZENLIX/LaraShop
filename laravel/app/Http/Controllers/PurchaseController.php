<?php
namespace larashop\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Input;
use larashop\Clients;
use larashop\Http\Requests;
use larashop\NPCity;
use larashop\NPUnit;
use larashop\Options;
use larashop\OrderFiles;
use larashop\OrderItems;
use larashop\Products;
use larashop\Purchase;
use Mail;
use NovaPoshta\ApiModels\Address;
use NovaPoshta\Config;
use Setting;
use Validator;
use Visitor;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function npSync()
    {

        Config::setApiKey(Setting::get('integration.np'));

        $unitArr = Address::getWarehouses();
        $adrArr = Address::getCities();

        NPCity::truncate();
        NPUnit::truncate();

        foreach ($adrArr->data as $value) {
            NPCity::create(['name' => $value->DescriptionRu, 'ref' => $value->Ref]);
        }

        foreach ($unitArr->data as $value) {
            NPUnit::create(['name' => $value->DescriptionRu, 'ref' => $value->CityRef]);
        }
    }

    public function index()
    {
        $cart = Cart::content();
        $cartEmpty = false;
        if (Cart::count() == 0) {
            $cartEmpty = true;
        }

        $npcity = NPCity::all();
        $np_city = [];
        foreach ($npcity as $value) {
            // code...
            $np_city[$value->ref] = $value->name;
        }

        $cartNP = Cart::search(['id' => 'np']);
        $dNP = true;
        $dADR = false;

        if ($cartNP[0]) {
            $dNP = false;
            $dADR = true;
        }

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
        $data = ['cart' => $cart, 'i' => 1, 'totalSumm' => Cart::total(), 'totalCount' => Cart::count(), 'cartEmpty' => $cartEmpty, 'np_city' => $np_city, 'dNP' => $dNP, 'dADR' => $dADR, 'PageDescr' => Setting::get('config.maindesc'), 'PageWords' => Setting::get('config.mainwords'), 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle'), 'logoMain' => $logoMain, 'totalNavLabel' => $this->totalNavLabel(),];

        return view('purchase')->with($data);
    }

    public function npGetUnit($id)
    {
        $npunit = NPUnit::where('ref', $id)->get();

        $np_unit = [];
        foreach ($npunit as $value) {

            // code...
            array_push($np_unit, ['id' => $value->name, 'text' => $value->name]);
        }

        return $np_unit;
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
    public function store(Request $request)
    {
        if (Cart::count() == 0) {
            $request->session()->flash('alert-danger', 'У Вас пустая корзина. Что бы оформить заказ, наполните её.');
            return back()->withInput();
        }

        $rules = ['name' => 'required|min:5|max:255', 'tel' => 'required|min:6|max:255', 'mail' => 'required|email',];

        $nbr = count(Input::file('files')) - 1;
        foreach (range(0, $nbr) as $index) {
            $rules['files.' . $index] = 'mimes:jpeg,bmp,png,pdf,psd|max:10000';
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $client = new Clients;
            $client->name = $request->name;
            $client->email = $request->mail;
            $client->tel = $request->tel;
            $client->save();

            $orderCode = strtoupper(str_random(5));

            //delivery_city_adr
            if ($request->delivery_type == 'np') {
                $city = NPCity::whereRef($request->delivery_city)->first();
            } else if ($request->delivery_type == 'adr') {
                $city = NPCity::whereRef($request->delivery_city_adr)->first();
            }

            $order = new Purchase;
            $order->client_id = $client->id;
            $order->code = $orderCode;
            $order->delivery_type = $request->delivery_type;
            $order->delivery_city = $city->name;

            if ($request->delivery_type == 'np') {
                $order->delivery_np = $request->delivery_np;
            }
            if ($request->delivery_type == 'adr') {
                $order->delivery_adr = $request->delivery_adr;
            }

            $order->pay_type = $request->pay_type;
            $order->comment = $request->comment;
            $order->save();

            $cart = Cart::content();
            $itemArr = [];
            foreach ($cart as $value) {
                array_push($itemArr, ['order_id' => $order->id, 'product_id' => $value->id, 'qty' => $value->qty]);
            }

            OrderItems::insert($itemArr);
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

            //COUNT QTY
            //COUNT SUMM
            $totalCount = $orderItems->sum('qty');

            $totalSumm = 0;
            foreach ($orderItems as $value) {

                // code...

                if ($value->product_id == 'np') {
                    $totalSumm = $totalSumm + Setting::get('product.np');
                } else if ($value->product_id == 'fast') {
                    $totalSumm = $totalSumm + Setting::get('product.fast');
                } else if ($value->product_id == 'gift') {
                    $totalSumm = $totalSumm + (Setting::get('product.gift') * $value->qty);
                } else {

                    if (strpos($value->product_id, '0000')) {
                        $pID = explode('0000', $value->product_id);
                        $option = Options::findOrFail($pID[1]);
                        $product = Products::findOrFail($pID[0]);
                        $productPrice = $option->price;
                        $value->productPrice = $productPrice;
                        $value->productName = $product->name . ' (' . $option->name . ')';

                    } else {
                        $productPrice = $value->product->price;
                        $value->productPrice = $value->product->price;
                        $value->productName = $value->product->name;
                    }

                    $totalSumm = $totalSumm + ($productPrice * $value->qty);
                }
            }
            (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

            $data = ['orderCode' => $orderCode, 'client' => $client, 'delivery_type' => $delivery_type, 'order' => $order, 'pay_type' => $pay_type, 'orderItems' => $orderItems, 'totalCount' => $totalCount, 'totalSumm' => $totalSumm, 'PageDescr' => Setting::get('config.maindesc'), 'PageWords' => Setting::get('config.mainwords'), 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle'), 'logoMain' => $logoMain, 'totalNavLabel' => $this->totalNavLabel(), 'appURL' => config('app.url')];

            if (!empty(Input::file('files') [0])) {
                $destinationPath = 'files/uploads/';

                // upload path

                foreach ($request->file('files') as $file) {

                    // code...

                    $extension = $file->getClientOriginalExtension();

                    // getting image extension

                    $mime = $file->getClientMimeType();
                    $originalName = $file->getClientOriginalName();
                    $hash = str_random(40);
                    $fileName = $hash . '.' . $extension;

                    // renameing image
                    $file->move($destinationPath, $fileName);

                    $isimage = 'false';
                    if (substr($mime, 0, 5) == 'image') {
                        $isimage = 'true';
                    }

                    $fileDB = OrderFiles::create(['order_id' => $order->id, 'name' => $originalName, 'hash' => $hash, 'mime' => $mime, 'extension' => $extension, 'status' => 'success', 'image' => $isimage]);
                }
            }

            Cart::destroy();

            Mail::queue('mail.neworder', $data, function ($message) use ($client) {
                $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
                $message->subject(Setting::get('config.sitename') . ' - НОВЫЙ ЗАКАЗ');
                $message->to($client['email']);
            });

            Mail::queue('mail.neworder', $data, function ($message) use ($client) {
                $message->from(Setting::get('config.email'), Setting::get('config.sitename'));
                $message->subject(Setting::get('config.sitename') . ' - НОВЫЙ ЗАКАЗ');
                $message->to(Setting::get('config.email'));
            });

            return view('orderConfirm')->with($data);
        }
    }

    //showLiqpay
    public function showLiqpay(Request $request)
    {

        $incoming_signature = $request->signature;
        $incoming_xml = base64_decode($request->operation_xml);
        $liqpay_signature = Setting::get('money.liqpayKey');
        $signature = base64_encode(sha1($liqpay_signature . $incoming_xml . $liqpay_signature, 1));

        $xml_data = simplexml_load_string($incoming_xml);
        $response['version'] = $xml_data->version;
        $response['action'] = $xml_data->action;

        // result_url, server_url
        $response['merchant_id'] = $xml_data->merchant_id;
        $response['order_id'] = $xml_data->order_id;
        $response['amount'] = $xml_data->amount;
        $response['currency'] = $xml_data->currency;
        $response['description'] = $xml_data->description;
        $response['status'] = $xml_data->status;

        // Transaction status
        $response['code'] = $xml_data->code;

        // Transaction error code
        $response['transaction_id'] = $xml_data->transaction_id;

        // LiqPay transaction Id
        $response['pay_way'] = $xml_data->pay_way;
        $response['sender_phone'] = $xml_data->sender_phone;

        if ($incoming_signature == $signature) {
            if ($response['status'] == 'success') {
                $id = $response['order_id'];

                $order = Purchase::where('code', $id)->first();
                $order->update(['status' => 'paid']);
                return redirect('/');
            }
        }
        return redirect('/');
    }

    //showPrivat24
    public function showPrivat24(Request $request)
    {

        $payment = $request->payment;
        $signature = $request->signature;

        $pass = Setting::get('money.privatKey');

        $checkSignature = sha1(md5($payment . $pass));

        if ($signature == $checkSignature) {

            // Ответ от настоящего сервера
            //echo ("Опа! проверка прошла успешно");

            // Далее парсим $payment
            parse_str($payment, $data);
            $id_cart = $data['order'];
            if ($data['state'] == 'test' || $data['state'] == 'ok') {

                $order = Purchase::where('code', $id_cart)->first();
                $order->update(['status' => 'paid']);

                return redirect('/');
            }
        }

        return redirect('/');
    }

    //showMail
    public function showMail()
    {
        Visitor::log();

        return 'ok';
    }

    public function settingSet()
    {

        Setting::set('product.np', '50');
        Setting::set('product.fast', '50');
        Setting::set('product.gift', '50');
        Setting::save();
    }

    public function settingGet()
    {
        return Setting::get('foo', 'default value');
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


    //updateDelivery
    public function totalNavLabel()
    {
        return Cart::count();
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

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //


    }
}
