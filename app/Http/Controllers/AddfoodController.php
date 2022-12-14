<?php

namespace App\Http\Controllers;

use App\Models\addfood;
use Illuminate\Http\Request;
use DB;

class AddfoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //badde zabbta 3al loggedin in cook ma3 l info taba3o
        //$data=addfood::all();
        $data1=addfood::where("user",session('id'))->get();
        return view("displaymenu")->with('listdata',$data1);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("addfood");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

       
        $product = new addfood();
        $product->name=$request->name;
        $product->price= $request->price;
        $product->cuisine= $request->cuisine;
        $product->diet= $request->diet;
        $product->user_id=session('id');
        //$product->photo=$request->image;
        $tmp= $request->file('photo')->store('public/images'); 
        $product->photo= str_replace('public', '', $tmp);
        $product->save();
        return redirect(route('addfood.index'));
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\addfood  $addfood
     * @return \Illuminate\Http\Response
     */
    public function show(addfood $addfood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\addfood  $addfood
     * @return \Illuminate\Http\Response
     */
    public function edit(addfood $addfood)
    {
        //
        $data=addfood::find($addfood->id);
        return view("Editfood")->with("addfood",$data);
        //$data=addfood::find($addfood->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\addfood  $addfood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, addfood $addfood)
    {
        //
        $data=addfood::find($addfood->id);
        $data->name=$request->name;
        $data->price= $request->price;
        $data->cuisine= $request->cuisine;
        $data->diet= $request->diet;
        $tmp= $request->file('photo')->store('public/images'); 
        $data->photo= str_replace('public', '', $tmp);
        $data->save();
        return redirect(route('addfood.index'));


     
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\addfood  $addfood
     * @return \Illuminate\Http\Response
     */
    public function destroy(addfood $addfood)
    {
        //
        $data=addfood::find($addfood->id);
        $data->delete();
        return redirect (route('addfood.index'));
    }
}
