<?php

namespace App\Http\Controllers;

use App\Models\DeliveryPoint;
use Illuminate\Http\Request;

class DeliveryPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery=DeliveryPoint::orderBy('id','DESC')->paginate(10);
        return view('backend.delivery.index')->with('deliverys',$delivery);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type'=>'string|required',
            'price'=>'nullable|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        // return $data;
        $status=DeliveryPoint::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery=DeliveryPoint::find($id);
        // if(!$delivery){
        //     request()->session()->flash('error',__('delivery not found'));
        // }
        return view('backend.delivery.edit')->with('delivery',$delivery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $delivery=DeliveryPoint::find($id);
        $this->validate($request,[
            'type'=>'string|required',
            'price'=>'nullable|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        // return $data;
        $status=$delivery->fill($data)->save();
        // if($status){
        //     request()->session()->flash('success',__('delivery successfully updated'));
        // }
        // else{
        //     request()->session()->flash('error',__('Error, Please try again'));
        // }
        return redirect()->route('delivery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery=DeliveryPoint::find($id);
        if($delivery){
            $status=$delivery->delete();
            if($status){
                request()->session()->flash('success',__('delivery successfully deleted'));
            }
            else{
                request()->session()->flash('error',__('Error, Please try again'));
            }
            return redirect()->route('delivery.index');
        }
        else{
            request()->session()->flash('error',__('delivery not found'));
            return redirect()->back();
        }
    }
}
