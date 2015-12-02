<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use Setting;
use Validator;

use larashop\Purchase;

class MoneyController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.money')->with($data);
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
    public function update(Request $request) {
        
        //
        
        $validator = Validator::make($request->all() , ['privatKey' => 'required', 'privatId' => 'required', 'liqpayKey' => 'required', 'liqpayId' => 'required', 'card' => 'required', 'cardOwner' => 'required', 'fast' => 'required|integer', 'np' => 'required|integer', 'gift' => 'required|integer']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            Setting::set('money.privatKey', $request->privatKey);
            Setting::set('money.privatId', $request->privatId);
            Setting::set('money.liqpayKey', $request->liqpayKey);
            Setting::set('money.liqpayId', $request->liqpayId);
            Setting::set('money.card', $request->card);
            Setting::set('money.cardOwner', $request->cardOwner);
            
            Setting::set('product.fast', $request->fast);
            Setting::set('product.np', $request->np);
            Setting::set('product.gift', $request->gift);
            Setting::save();
            
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('money');
        }
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
