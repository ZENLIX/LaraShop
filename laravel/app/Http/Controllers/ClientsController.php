<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use larashop\Clients;
use Validator;

use larashop\Purchase;

class ClientsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        $clients = Clients::all();
        
        $data = ['clients' => $clients, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.clients')->with($data);;
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
        $client = Clients::findOrFail($id);
        $data = ['client' => $client, 'NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.client')->with($data);
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
        
        $validator = Validator::make($request->all() , ['name' => 'required|min:2|max:255', 'tel' => 'required|min:2', 'email' => 'required|email']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            
            $client = Clients::findOrFail($id);
            
            $client->update(['name' => $request->name, 'tel' => $request->tel, 'email' => $request->email]);
            
            $request->session()->flash('alert-success', 'Клиент отредактирован!');
            return redirect('clients');
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
        $client = Clients::findOrFail($id);
        $client->delete();
    }
}
