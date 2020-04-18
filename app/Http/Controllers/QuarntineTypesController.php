<?php

namespace App\Http\Controllers;

use App\DataTables\QuarantineTypeDataTable;
use App\Http\Requests\QuaranitTypeRequest;
use App\QuarantineArea;
use App\QuarantineAreaType;

class QuarntineTypesController extends Controller
{
    public function index()
    {
        $User = new QuarantineTypeDataTable();
        return $User->render('quarantineTypes.index');
    }


    public function create()
    {
        return view('quarantineTypes.create');
    }

    public function store(QuaranitTypeRequest $request)
    {
        $project = QuarantineAreaType::create($request->all());
        return redirect()->route('quarantineTypes.index')->with('success', 'quarantineTypes  add successfully');

    }

    public function update(QuaranitTypeRequest $request, QuarantineAreaType $quarantineType)
    {

        $quarantineType->update($request->all());
        return redirect()->route('quarantineTypes.index')->with('success', '  quarantineTypes updated successfully');

    }

    public function edit(QuarantineAreaType $quarantineType)
    {
        return view('quarantineTypes.create', compact('quarantineType'));
    }


    public function delete($id)
    {

        $qt = QuarantineAreaType::find(decrypt($id));
        $q = QuarantineArea::all()->where('quarantine_area_type_id', '=', $qt->id)->count();
        if ($q > 0)
            return redirect()->route('quarantineTypes.index')->with('warning', 'Not allow to delete because this type has Quarantine Area  ');
        else
            $qt->delete();
        return redirect()->route('quarantineTypes.index')->with('success', 'project deleted successfully');


    }


}
