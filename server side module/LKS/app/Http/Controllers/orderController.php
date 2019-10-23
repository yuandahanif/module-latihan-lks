<?php

namespace App\Http\Controllers;

use App\order;
use App\bus;
use App\driver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderAll = order::all();
        $orderConcat = [];
        foreach ($orderAll as $o ) {
            array_push($orderConcat,[$o,order::find($o->id)->bus,order::find($o->id)->driver]);
        }
        return view('order.order',['order' => $orderConcat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = order::all();
        $Order = [[],[]];
        foreach ($data as $o ) {
            array_push($Order[0],order::find($o->id)->bus->id);
            array_push($Order[1],order::find($o->id)->driver->id);
        }
        return view('order.createOrder',['bus'=> bus::all()->except($Order[0])
                                         ,'driver' => driver::all()->except($Order[1])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = order::all();
        $order = [[],[]];
        foreach ($data as $o ) {
            array_push($order[0],order::find($o->id)->bus->id);
            array_push($order[1],order::find($o->id)->driver->id);
        }
        //
        $this->validate($request,[
            'bus' => ['required','numeric'],
            'driver' => ['required','numeric'],
            'contact_name' => ['required','string'],
            'contact_phone' => ['required','string'],
            'start_rent_date' => ['date','after_or_equal:tomorrow'],
            'total_rent_days' => ['numeric','gte:1']
        ]);

        order::firstOrCreate([
            'bus_id' => $request->bus,
            'driver_id' => $request->driver,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'start_rent_date' =>$request->start_rent_date,
            'total_rent_days' => $request->total_rent_days
        ]);
        return redirect('order')->with('status','order berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        $data = order::all();
        $orderTmp = [[],[]];
        foreach ($data as $o ) {
            array_push($orderTmp[0],order::find($o->id)->bus->id);
            array_push($orderTmp[1],order::find($o->id)->driver->id);
        }
        //
        return view('order.editOrder',['order'=>order::find($order->id),'bus'=> bus::all()->except($orderTmp[0])
        ,'driver' => driver::all()->except($orderTmp[1])]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
        $this->validate($request,[
            'bus' => ['required','numeric'],
            'driver' => ['required','numeric'],
            'contact_name' => ['required','string'],
            'contact_phone' => ['required','string'],
            'start_rent_date' => ['date','after_or_equal:tomorrow'],
            'total_rent_days' => ['numeric','gte:1']
        ]);
        order::where('id',$order->id)->update([
            'bus_id' => $request->bus,
            'driver_id' => $request->driver,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'start_rent_date' =>$request->start_rent_date,
            'total_rent_days' => $request->total_rent_days
        ]);
        return redirect('order')->with('status','order berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
        order::destroy($order->id);
        return redirect('order')->with('status','data berhasil dihapus'); 
    }
}
