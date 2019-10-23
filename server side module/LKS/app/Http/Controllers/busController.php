<?php

namespace App\Http\Controllers;

use App\bus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class busController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bus = bus::all();
        return view('bus.bus',['bus'=>$bus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bus.createBus');
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
        $this->validate($request,[
            'plat_number'=>'required|string',
            'brand' =>['required',Rule::in(['merchedes','fuso','scania'])],
            'seat' => 'required|numeric|gte:11',
            'price' => 'required|numeric|gte:100000'
        ]);

        bus::firstOrCreate(['plat_number'=>$request->plat_number],
        [
        'brand'=>$request->brand,
        'seat'=>$request->seat,
        'price_per_day'=>$request->price
        ]);
        
        return redirect('bus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(bus $bus)
    {
        //
        $order = bus::find($bus->id)->order;
        return view('bus.busShow',['bus' => bus::findOrFail($bus),
                                    'order' => $order == null ? 'tidak ada order' : $order->start_rent_date]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(bus $bus)
    {
        //
        return view('bus.busEdit',['bus'=>bus::find($bus)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bus $bus)
    {
        //
        $this->validate($request,[
            'plat_number' => 'required|string',
            'brand' => ['required',Rule::in(['merchedes','fuso','scania'])],
            'seat' => 'required|numeric|gte:11',
            'price' => 'required|numeric|gte:100000'
        ]);

        bus::where('id',$bus->id)->update([
        'plat_number'=>$request->plat_number,
        'brand'=>$request->brand,
        'seat'=>$request->seat,
        'price_per_day'=>$request->price
        ]);
        return redirect('bus')->with('status','update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(bus $bus)
    {
        //
        bus::destroy($bus->id);
        return redirect('bus')->with('status','hapus bis berhasil');
    }
}
