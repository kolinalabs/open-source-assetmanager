<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = $request->model ?? null;
        $equipments = Equipment::when($model, function ($query, $model) {
            return $query->where('model', 'like', "%{$model}%");
        })
        ->paginate(4);

        return view('equipments.index', [
            'equipments' => $equipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipments.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipment = new Equipment;
        $equipment->place_id         = $request->place_id;
        $equipment->manufacturer_id  = $request->manufacturer_id;
        $equipment->category_id      = $request->category_id;
        $equipment->model            = $request->model;
        $equipment->description      = $request->description;
        $equipment->state            = $request->state;
        $equipment->patrimony        = $request->patrimony;
        $equipment->aquisition_value = $request->aquisition_value;
        $equipment->save();
        return redirect()->route('equipment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('equipments.show', ['equipment' => $equipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        return view('equipments.form', ['equipment' => $equipment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $equipment->update($request->all());
        return redirect()->route('equipment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return response()->json([]);
    }
}
