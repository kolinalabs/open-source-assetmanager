<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Web\Equipment;
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

        return view('equipment.index', [
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
        return view('equipment.form');
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
        $equipment->place_id          = $request->place_id;
        $equipment->manufacturer_id   = $request->manufacturer_id;
        $equipment->category_id       = $request->category_id;
        $equipment->model             = $request->model;
        $equipment->description       = $request->description;
        $equipment->state             = $request->state;
        $equipment->patrimony         = $request->patrimony;
        $equipment->acquisition_value = $request->acquisition_value;
        $equipment->save();

        return redirect()->route('equipment.edit', [
            'equipment' => $equipment->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', ['equipment' => $equipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $equipment->load('occurrences');

        return view('equipment.form', ['equipment' => $equipment]);
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

        return redirect()->route('equipment.edit', [
            'equipment' => $equipment->id
        ]);
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
