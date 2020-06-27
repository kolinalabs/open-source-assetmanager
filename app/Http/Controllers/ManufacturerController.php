<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $manufacturers = Manufacturer::paginate(4);

    //     return view('manufacturers.index', [
    //         'manufacturers' => $manufacturers
    //     ]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name ?? null;
        $manufacturers = Manufacturer::when($name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })
        ->paginate(4);

        return view('manufacturers.index', [
            'manufacturers' => $manufacturers
        ]);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function search(Request $request)
    // {
    //     $manufacturers = Manufacturer::where('name', 'like', "%{$request->name}%")
    //                                  ->get();
    //     return view('manufacturers.index', [
    //         'manufacturers' => $manufacturers
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manufacturers.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manufacturer = new Manufacturer;
        $manufacturer->name = $request->name;
        $manufacturer->save();
        return redirect()->route('manufacturer.index');
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
    public function edit(Manufacturer $manufacturer)
    {
        return view('manufacturers.form', ['manufacturer' => $manufacturer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());
        return redirect()->route('manufacturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return response()->json([]);
    }
}
