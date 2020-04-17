<?php

namespace App\Http\Controllers;

use App\DataTables\QuarantineAreasDataTable;
use App\Http\Requests\QuarantineRequest;
use App\QuarantineArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuarantinesController extends Controller
{
    public function index($type = '')
    {
        $User = new QuarantineAreasDataTable($type);
        return $User->render('quarantines.index', ['deleted' => ($type == '') ? false : true]);
    }


    public function create()
    {
        return view('quarantines.create');
    }

    public function store(QuarantineRequest $request)
    {
        $quarantine = QuarantineArea::create(array_merge($request->all(),['created_by'=>auth()->user()->id]));
        return redirect()->route('quarantines.index')->with('success', 'quarantine  add successfully');

    }

    public function update(QuarantineRequest $request, QuarantineArea $quarantine)
    {
        $quarantine->update($request->all());
        return redirect()->route('quarantines.index')->with('success', '  quarantine updated successfully');

    }


    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $user = QuarantineArea::withTrashed()->find($r->id);
        $user->status = $new_status;
        $user->save();
        return $new_status;
    }

//    public function show($id)
//    {
//        //
//        $quarantine = QuarantineArea::findOrFail($id);
//        return dd($id);
//    }

    public function show(QuarantineArea $quarantine)
    {
        return view('quarantines.show', compact('quarantine'));
    }

    public function edit(QuarantineArea $quarantine)
    {
        return view('quarantines.create', compact('quarantine'));
    }


    public function delete($id)
    {

        $quarantine = QuarantineArea::find(decrypt($id));
//        return dd($User->profile);
//        if ($User->open_courses->count() > 0)
//            return redirect(route('Users.index'))->with('warning', 'Not allow to delete because this member has OpenCourses  ');
        $quarantine->deleted_by = Auth::user()->id;
        $quarantine->save();
        $quarantine->delete();
        return redirect()->route('quarantines.index')->with('success', 'quarantine deleted successfully');


    }

    public function forceDelete($id)
    {
        $quarantine = QuarantineArea::onlyTrashed()->find(decrypt($id));
        $quarantine->forceDelete();
        return redirect(route('quarantines.index', 'deleted'))->with('success', 'quarantine deleted successfully');
    }

    public function restore($id)
    {

        $quarantine = QuarantineArea::onlyTrashed()->find(decrypt($id));
        $quarantine->restore();
        return redirect(route('quarantines.index', 'deleted'))->with('success', 'quarantine restored successfully');
    }

    public function destroy($id)
    {
        //
    }


}
