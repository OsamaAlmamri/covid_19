<?php

namespace App\Http\Controllers;

use App\DataTables\WorkTeamDataTable;
use App\Http\Requests\WorkTeamRequest;
use App\User;
use App\WorkTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkTeamsController extends Controller
{
    public function index($type = '')
    {
//        return dd('f');

        $User = new WorkTeamDataTable($type);
        return $User->render('workTeams.index', ['deleted' => ($type == '') ? false : true]);
    }


    public function create()
    {
        return view('workTeams.create');
    }

    public function store(WorkTeamRequest $request)
    {

        $request['birth_date'] = setEntryDateAttribute($request['birth_date']);
        $request['join_date'] = setEntryDateAttribute($request['join_date']);
        $workTeam = WorkTeam::create($request->all());
        return redirect()->route('workTeams.index')->with('success', 'workTeam  add successfully');

    }

    public function update(WorkTeamRequest $request, WorkTeam $workTeam)
    {
        $request['birth_date'] = setEntryDateAttribute($request['birth_date']);
        $request['join_date'] = setEntryDateAttribute($request['join_date']);
        $workTeam->update($request->all());
        return redirect()->route('workTeams.index')->with('success', '  workTeam updated successfully');

    }


    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $user = User::withTrashed()->find($r->id);
        $user->status = $new_status;
        $user->save();
        return $new_status;
    }

//    public function show($id)
//    {
//        //
//        $workTeam = WorkTeam::findOrFail($id);
//        return dd($id);
//    }


    public function edit(WorkTeam $workTeam)
    {
//        return dd();
        return view('workTeams.create', compact('workTeam'));
    }


    public function delete($id)
    {

        $workTeam = WorkTeam::find(decrypt($id));
        if ($workTeam->user != null)
            return redirect(route('workTeams.index'))->with('warning', 'Not allow to delete because this member has related account  ');
        $workTeam->deleted_by = Auth::user()->id;
        $workTeam->save();
        $workTeam->delete();
        return redirect()->route('workTeams.index')->with('success', 'workTeam deleted successfully');


    }

    public function forceDelete($id)
    {
        $workTeam = WorkTeam::onlyTrashed()->find(decrypt($id));
        $workTeam->forceDelete();
        return redirect(route('workTeams.index', 'deleted'))->with('success', 'workTeam deleted successfully');
    }

    public function restore($id)
    {

        $workTeam = WorkTeam::onlyTrashed()->find(decrypt($id));
        $workTeam->restore();
        return redirect(route('workTeams.index', 'deleted'))->with('success', 'workTeam restored successfully');
    }

    public function destroy($id)
    {
        //
    }


}
