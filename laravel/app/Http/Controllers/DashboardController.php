<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;

use larashop\Clients;
use larashop\Purchase;
use larashop\Products;

use larashop\OrderItems;
use Auth;
use Setting;

//use Tracker;
use DB;

//use DateTime;
use Visitor;
use Carbon\Carbon;
use Validator;
use larashop\User;
use Hash;

class DashboardController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        
        $clients = Clients::all();
        $purchase = Purchase::all();
        $products = Products::all();
        
        //$orders=Purchase::all();
        $ordersLim = Purchase::orderBy('id', 'desc')->take(5)->get();
        
        foreach ($ordersLim as $order) {
            
            if ($order->status == 'paid') {
                $order->rowStyle = 'warning';
            } 
            else if ($order->status == 'sent') {
                $order->rowStyle = 'success';
            } 
            else {
                $order->rowStyle = '';
            }
            
            $ordertotalCount = 0;
            $ordertotalSumm = 0;
            
            $itemFast = false;
            $itemGift = false;
            
            foreach ($order->items as $item) {
                
                if ($item->product_id == 'np') {
                    $ordertotalSumm = $ordertotalSumm + (Setting::get('product.np'));
                } 
                else if ($item->product_id == 'fast') {
                    $itemFast = true;
                    $ordertotalSumm = $ordertotalSumm + (Setting::get('product.fast'));
                } 
                else if ($item->product_id == 'gift') {
                    $itemGift = true;
                    $ordertotalSumm = $ordertotalSumm + ((Setting::get('product.gift')) * $item->qty);
                } 
                else {
                    $ordertotalCount = $ordertotalCount + $item->qty;
                    $ordertotalSumm = $ordertotalSumm + ($item->product->price * $item->qty);
                }
            }
            
            $order->itemFast = $itemFast;
            $order->itemGift = $itemGift;
            $order->totalCount = $ordertotalCount;
            $order->totalSumm = $ordertotalSumm;
        }
        
        //dd($order->totalSumm);
        
        $orders = Purchase::where('status', 'sent')->get();
        
        $totalSumm = 0;
        $totalCount = 0;
        
        foreach ($orders as $order) {
            
            foreach ($order->items as $item) {
                
                if ($item->product_id == 'np') {
                    $totalSumm = $totalSumm + (Setting::get('product.np'));
                } 
                else if ($item->product_id == 'fast') {
                    $totalSumm = $totalSumm + (Setting::get('product.fast'));
                } 
                else if ($item->product_id == 'gift') {
                    $totalSumm = $totalSumm + ((Setting::get('product.gift')) * $item->qty);
                } 
                else {
                    $totalCount = $totalCount + $item->qty;
                    $totalSumm = $totalSumm + ($item->product->price * $item->qty);
                }
            }
        }
        
        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('5')
        
        //->lists('total','product_id')
        ->get();
        
        $topProdsArr = [];
        
        //dd($topProds);
        
        foreach ($topProds as $topprod) {
            
            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {
                $prodName = Products::findOrFail($topprod->product_id);
                
                //echo $prodName->name;
                
                array_push($topProdsArr, ['name' => $prodName->name, 'urlhash' => $prodName->urlhash, 'qty' => $topprod->total]);
                // code...
                
                
            }
        }
        
        /*OrderItems::whereNotIn('product_id', ['np','fast','gift'])
            ->orderBy('qty')
            ->groupBy('product_id')
            ->get();*/
        
        //dd($topProdsArr);
        //$NewOrderCounter=Purchase::Neworders()->count();
        
        $data = ['totalClients' => $clients->count() , 'totalPurchase' => $purchase->count() , 'totalPurchaseOk' => $purchase->where('status', 'sent')->count() , 'totalProducts' => $products->count() , 'totalMoney' => $totalSumm, 'totalCount' => $totalCount, 'orders' => $ordersLim, 'topProds' => $topProdsArr, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        
        return view('admin.dashboard')->with($data);
    }
    
    public function showStat() {
        
        //$sessions = Tracker::sessions(5 * 60 * 24)->all();
        
        $d1 = Visitor::range(Carbon::now()->format('Y-m-d') , Carbon::now()->format('Y-m-d'));
        $d2 = Visitor::range(Carbon::now()->subDay(1)->format('Y-m-d') , Carbon::now()->subDay(1)->format('Y-m-d'));
        $d3 = Visitor::range(Carbon::now()->subDay(2)->format('Y-m-d') , Carbon::now()->subDay(2)->format('Y-m-d'));
        $d4 = Visitor::range(Carbon::now()->subDay(3)->format('Y-m-d') , Carbon::now()->subDay(3)->format('Y-m-d'));
        $d5 = Visitor::range(Carbon::now()->subDay(4)->format('Y-m-d') , Carbon::now()->subDay(4)->format('Y-m-d'));
        
        //dd(Purchase::Neworders()->count());
        
        //dd(Config('mail.username'));
        
        //dd($d1);
        
        $data = [[Carbon::now()->subDay(4)->format('Y-m-d') , $d5], [Carbon::now()->subDay(3)->format('Y-m-d') , $d4], [Carbon::now()->subDay(2)->format('Y-m-d') , $d3], [Carbon::now()->subDay(1)->format('Y-m-d') , $d2], [Carbon::now()->format('Y-m-d') , $d1], 
        ];
        
        return response()->json($data);
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
    
    //DashboardController
    public function editPersonal() {
        
        //
        
        $user = Auth::user();
        
        $data = ['user' => $user, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.personal')->with($data);
    }
    

//updatePersonalMail
public function updatePersonalMail(Request $request) {
        $user = User::findOrFail(Auth::user()->id);

                $validator = Validator::make($request->all(), 

                    ['email' => 'required|email']);
        
        if ($validator->fails()) {

            return back()->withErrors($validator);
        }
        else {

            $user->email = $request->email;
            $user->save();

            $request->session()->flash('alert-success', 'Конфигурация успешно обновлена!');
            return back();

        }
    }




    public function updatePersonal(Request $request) {
        $user = User::findOrFail(Auth::user()->id);
        
        //dd($request->password);
        
        Validator::extend('passcheck', function ($attribute, $value, $parameters) {
            return Hash::check($value, Auth::user()->getAuthPassword());
        });
        
        $validator = Validator::make($request->all() , ['password' => 'required|confirmed|min:6', 'old_password' => 'required|passcheck|min:6'], ['passcheck' => 'Your old password was incorrect']);
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } 
        else {
            $user->password = bcrypt($request->password);
            $user->save();
            
            $request->session()->flash('alert-success', 'Конфигурация успешно обновлена!');
            return back();
        }
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
