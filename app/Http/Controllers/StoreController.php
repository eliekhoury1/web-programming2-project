<?php

namespace App\Http\Controllers;

use App\Models\store;
use App\Models\menufacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=store::all();
        $data=store::where("Admin_reply","0")->get();
        //return $data;
        return view('adminlist')->with("listdata",$data);
        

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=new store();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->number=$request->number;
        $data->Admin_reply=0;
        $data->user_id=session('id');
        $data->save();
        return redirect (route('signin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(store $store)
    {
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, store $store)
    {
        
        $data1=new store();
        //$data=store::select("user_id","Admin_reply","name","email","number","user_id")->find($store->id);
        $data=store::find($store->id);
        $data->delete();

        $data1->name=$store->name;
        $data1->email=$store->email;
        $data1->number=$store->number;
        $data1->user_id=$store->user_id;
        $data1->Admin_reply=1;
        $data1->save();

     
            
        DB::table('users')->where('id', $store->user_id)->update([
        'role' =>'Role2'
        ]);
        $data2=new menufacts();
        $data2->user_id=$store->user_id;
        $data2->save();

        $data->delete();
        return redirect (route('store.index'));

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(store $store)
    {
        //
        $data=store::find($store->id);
        $data->delete();
        return redirect (route('store.index'));
    }


    public function index1()
    { 
        return view('adminpage');
        

    }
     public  static function perm ()
    {
        $data=store::where("Admin_reply","0")->get();
        $count=$data->count();
        return $count;
    }
}
