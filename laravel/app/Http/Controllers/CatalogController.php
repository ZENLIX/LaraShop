<?php
namespace larashop\Http\Controllers;

use Cart;
use DB;
use Illuminate\Http\Request;
use larashop\Categories;
use larashop\Http\Requests;
use larashop\Products;
use Setting;
use Visitor;

class CatalogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function totalNavLabel()
    {
        return Cart::count();
    }

    public function index()
    {

        //
        Visitor::log();
        $cats = Categories::orderBy('sort_id', 'asc')->get();
        $products = Products::orderBy('sort_id', 'asc')->get();

        (Setting::get('config.mainprod', Null)) ? $mainProdImg = asset('/files/img/' . Setting::get('config.mainprod')) : $mainProdImg = asset('dist/img/photo4.jpg');

        (Setting::get('config.logo', Null)) ? $logoMain = asset('/files/img/' . Setting::get('config.logo')) : $logoMain = asset('dist/img/logo.png');

        $topProds = DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderBy('total', 'desc')->take('5')
            ->get();
        $topProdsArr = [];
        foreach ($topProds as $topprod) {

            if (!in_array($topprod->product_id, ['fast', 'np', 'gift'])) {

                if (strpos($topprod->product_id, '0000')) {
                    $pID = explode('0000', $topprod->product_id);
                    $prodID = $pID[0];

                } else {
                    $prodID = $topprod->product_id;
                }


                $prodName = Products::findOrFail($prodID);

                array_push($topProdsArr, ['name' => $prodName->name, 'cover' => $prodName->cover, 'link' => $prodName->urlhash]);
            }
        }

        $data = ['cats' => $cats, 'products' => $products, 'PageDescr' => Setting::get('config.maindesc'), 'PageWords' => Setting::get('config.mainwords'), 'PageAuthor' => '', 'PageTitle' => Setting::get('config.maintitle'), 'mainProdImg' => $mainProdImg, 'logoMain' => $logoMain, 'topProds' => $topProdsArr, 'totalNavLabel' => $this->totalNavLabel(),];

        return view('catalogPage')->with($data);
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
