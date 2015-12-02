<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;

use Setting;
use Validator;

use Image;
use File;
use Hash;

use larashop\Purchase;

class ConfigController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.config')->with($data);
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
        
        $validator = Validator::make($request->all() , [
        'logo' => 'mimes:jpeg,bmp,png', 'mainprod' => 'mimes:jpeg,bmp,png', 'sitename' => 'required', 'email' => 'required|email', 'maintitle' => 'required', 'mainwords' => 'required', 'maindesc' => 'required', 'galtitle' => 'required', 'galwords' => 'required', 'galdesc' => 'required', 'infotitle' => 'required', 'infowords' => 'required', 'infodesc' => 'required', 'mainprodtitle' => 'required', 'mainproddesc' => 'required', 'mainprodlink' => 'required'
        ]);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            $logoName = Setting::get('config.logo');
            
            $logoReq = $request->file('logo');
            if (isset($logoReq)) {
                $extension = $logoReq->getClientOriginalExtension();
                $logo = Image::make($logoReq);
                
                // resize image
                $logo->fit(140, 50);
                
                // save image
                $string = str_random(40);
                $logoName = $string . '.' . $extension;
                $logo->save('files/img/' . $logoName);
            }
            
            $mainprodName = Setting::get('config.mainprod');
            $mainprodReq = $request->file('mainprod');
            if (isset($mainprodReq)) {
                $mainprodextension = $mainprodReq->getClientOriginalExtension();
                $mainprod = Image::make($mainprodReq)->fit(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // save image
                $mainprodstring = str_random(40);
                $mainprodName = $mainprodstring . '.' . $mainprodextension;
                $mainprod->save('files/img/' . $mainprodName);
            }
            
            Setting::set('config.logo', $logoName);
            Setting::set('config.mainprod', $mainprodName);
            //sitecolor
            Setting::set('config.sitecolor', $request->sitecolor);
            Setting::set('config.sitename', $request->sitename);
            Setting::set('config.email', $request->email);
            Setting::set('config.maintitle', $request->maintitle);
            Setting::set('config.mainwords', $request->mainwords);
            Setting::set('config.maindesc', $request->maindesc);
            Setting::set('config.galtitle', $request->galtitle);
            Setting::set('config.galwords', $request->galwords);
            Setting::set('config.galdesc', $request->galdesc);
            Setting::set('config.infotitle', $request->infotitle);
            Setting::set('config.infowords', $request->infowords);
            Setting::set('config.infodesc', $request->infodesc);
            Setting::set('config.mainprodtitle', $request->mainprodtitle);
            Setting::set('config.mainproddesc', $request->mainproddesc);
            Setting::set('config.mainprodlink', $request->mainprodlink);
            
            Setting::save();
            
            $request->session()->flash('alert-success', 'Конфигурация сохранена!');
            return redirect('config');
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
