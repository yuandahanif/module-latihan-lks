<?php

namespace App\Http\Controllers;

use App\driver;
use Illuminate\Http\Request;

class driverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('driver.driver',['driver' => driver::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return \view('driver.driverCreate');
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
            'name' => ['required','string','max:255'],
            'age' => ['gte:18','required','integer'],
            'id_numbers' => ['required','min:16','string']
        ]);
        driver::firstOrCreate([
            'name' => $request->name,
            'age' => $request->age,
            'id_numbers' => $request->id_numbers
        ]);
        return redirect('driver')->with('session','data driver berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(driver $driver)
    {
        //
        return view('driver.driverEdit',['driver' => driver::find($driver->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, driver $driver)
    {
        //
        $this->validate($request,[
            'name' => ['required','string','max:255'],
            'age' => ['gte:18','required','integer'],
            'id_numbers' => ['required','min:16','string']
        ]);
        driver::where('id',$driver->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'id_numbers' => $request->id_numbers
        ]);
        return redirect('driver')->with('status','data driver berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(driver $driver)
    {
        //
        driver::destroy($driver->id);
        return \redirect('driver')->with('status','data driver berhasil di hapus');
    }
}
