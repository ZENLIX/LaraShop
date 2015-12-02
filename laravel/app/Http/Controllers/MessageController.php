<?php
namespace larashop\Http\Controllers;

use Illuminate\Http\Request;

use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;

use larashop\Purchase;

use larashop\Clients;

use Validator;
use Mail;
use Setting;

class MessageController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //
        
        $data = ['NewOrderCounter' => Purchase::Neworders()->count() ];
        return view('admin.message')->with($data);
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
        
        $validator = Validator::make($request->all() , ['subj' => 'required', 'text' => 'required']);
        
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } 
        else {
            
            (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');
            
            $data = ['logoMain' => $logoMain, 'msg' => $request->text];
            
            $clients = Clients::all();
            $counter = 0;
            $counterTime = 5;
            foreach ($clients as $client) {
                
                $subj = $request->subj;
                $email = $client->email;
                
                if (++$counter % 5 === 0) {
                    $counterTime = $counterTime + 10;
                }
                
                Mail::later($counterTime, 'mail.message', $data, function ($message) use ($email, $subj) {
                    
                    $message->from(Setting::get('config.email') , Setting::get('config.sitename'));
                    $message->subject($subj);
                    $message->to($email);
                });
            }
            
            $data = ['count' => $counter];
            
            Mail::later($counterTime, 'mail.messageSuccess', $data, function ($message) {
                $message->from(Setting::get('config.email') , Setting::get('config.sitename'));
                $message->subject('Рассылка завершена!');
                $message->to(Setting::get('config.email'));
            });
            // code...*/
            
            /*//dd($client->email);
            $subj=$request->subj;
            $email=$client->email;
            
            Mail::later(5, 'mail.message', $data, function ($message) use ($email,$subj) {
            
                $message->from(Setting::get('config.email') , Setting::get('config.sitename'));
                $message->subject($subj);
                $message->to($email);
            
            });*/
            
            //}
            
            $request->session()->flash('alert-success', 'Рассылка будет создана в ближайшее время!');
            return redirect('message');
        }
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
