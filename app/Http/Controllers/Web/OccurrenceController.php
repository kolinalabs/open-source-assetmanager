<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Web\Equipment;
use App\Models\Web\Occurrence;
use Illuminate\Http\Request;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list(Equipment $equipment)
    {
        return view('equipment.occurrences._list', [
            'occurrences' => $equipment->occurrences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $equipmentId = $request->equipment;
        return view('equipment.occurrences._form', ['equipment' => $equipmentId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $occurrence = new Occurrence();
        $occurrence->equipment_id = $request->equipment_id;
        $occurrence->description = $request->description;
        $occurrence->occurred_at = $request->occurred_at;
        $occurrence->save();

        return response()->json([]);
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
    public function edit(Occurrence $occurrence)
    {
        return view('equipment.occurrences._form', compact('occurrence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occurrence $occurrence)
    {
        $occurrence->update($request->post());
        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occurrence $occurrence)
    {
        $occurrence->delete();

        return response()->json([]);
    }
}
