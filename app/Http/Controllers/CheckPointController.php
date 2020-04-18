<?php

namespace App\Http\Controllers;

use App\CheckPoint;
use App\DataTables\CheckPointsDataTable;
use App\Http\Requests\CheckPointRequest;
use App\Http\Requests\QuarantineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPointController extends Controller
{
    public function index($type = '')
    {
        $User = new CheckPointsDataTable($type);
        return $User->render('check_points.index', ['deleted' => ($type == '') ? false : true]);
    }


    public function create()
    {
        return view('check_points.create');
    }

    public function store(CheckPointRequest $request)
    {
        $check_point = CheckPoint::create(array_merge($request->all(),['created_by'=>auth()->user()->id]));
        return redirect()->route('check_points.index')->with('success', 'check_point  add successfully');

    }

    public function update(CheckPointRequest $request, CheckPoint $check_point)
    {
        $check_point->update($request->all());
        return redirect()->route('check_points.index')->with('success', '  check_point updated successfully');

    }


    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $user = CheckPoint::withTrashed()->find($r->id);
        $user->status = $new_status;
        $user->save();
        return $new_status;
    }

//    public function show($id)
//    {
//        //
//        $check_point = CheckPoint::findOrFail($id);
//        return dd($id);
//    }

    public function show(CheckPoint $check_point)
    {
        return view('check_points.show', compact('check_point'));
    }

    public function edit(CheckPoint $check_point)
    {
        return view('check_points.create', compact('check_point'));
    }


    public function delete($id)
    {

        $check_point = CheckPoint::find(decrypt($id));
//        return dd($User->profile);
//        if ($User->open_courses->count() > 0)
//            return redirect(route('Users.index'))->with('warning', 'Not allow to delete because this member has OpenCourses  ');
        $check_point->deleted_by = Auth::user()->id;
        $check_point->save();
        $check_point->delete();
        return redirect()->route('check_points.index')->with('success', 'check_point deleted successfully');


    }

    public function forceDelete($id)
    {
        $check_point = CheckPoint::onlyTrashed()->find(decrypt($id));
        $check_point->forceDelete();
        return redirect(route('check_points.index', 'deleted'))->with('success', 'check_point deleted successfully');
    }

    public function restore($id)
    {

        $check_point = CheckPoint::onlyTrashed()->find(decrypt($id));
        $check_point->restore();
        return redirect(route('check_points.index', 'deleted'))->with('success', 'check_point restored successfully');
    }

    public function destroy($id)
    {
        //
    }


}
