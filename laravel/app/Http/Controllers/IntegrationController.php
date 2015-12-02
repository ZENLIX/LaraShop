<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;

use Setting;
use Validator;

use larashop\Purchase;

class IntegrationController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.integration')->with($data);
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
        $validator = Validator::make($request->all() , ['np' => 'required']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            
            Setting::set('integration.np', $request->np);
            Setting::set('integration.habr', $request->habr);
            Setting::set('integration.insta', $request->insta);
            Setting::set('integration.youtube', $request->youtube);
            Setting::set('integration.twitter', $request->twitter);
            Setting::set('integration.tel', $request->tel);
            Setting::set('integration.skype', $request->skype);
            
            Setting::save();
            
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('integration');
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
