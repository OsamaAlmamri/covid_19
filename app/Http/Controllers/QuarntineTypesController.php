<?php

namespace App\Http\Controllers;

use App\DataTables\QuarantineTypeDataTable;
use App\Http\Requests\QuaranitTypeRequest;
use App\QuarantineArea;
use App\QuarantineAreaType;
use Illuminate\Support\Facades\Auth;

class QuarntineTypesController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('show quarantineTypes') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $User = new QuarantineTypeDataTable();
        return $User->render('quarantineTypes.index');
    }


    public function create()
    {
        if (Auth::user()->can('manage quarantineTypes') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
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
        if (Auth::user()->can('manage quarantineTypes') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        return view('quarantineTypes.create', compact('quarantineType'));
    }


    public function delete($id)
    {
        if (Auth::user()->can('manage quarantineTypes') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $qt = QuarantineAreaType::find(decrypt($id));
        $q = QuarantineArea::all()->where('quarantine_area_type_id', '=', $qt->id)->count();
        if ($q > 0)
            return redirect()->route('quarantineTypes.index')->with('warning', 'Not allow to delete because this type has Quarantine Area  ');
        else
            $qt->delete();
        return redirect()->route('quarantineTypes.index')->with('success', 'type deleted successfully');


    }


}
