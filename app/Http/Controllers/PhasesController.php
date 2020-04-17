<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectsDataTable;
use App\Http\Requests\PhaseRequest;
use App\Http\Requests\ProjectRequest;
use App\Phase;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhasesController extends Controller
{
    public function index($type = '')
    {
        $User = new ProjectsDataTable($type);
        return $User->render('projects.index', ['deleted' => ($type == '') ? false : true]);
    }


    public function create()
    {
        return view('projects.create');
    }

    public function store(PhaseRequest $request)
    {

        $request['start_date'] = setEntryDateAttribute($request['start_date']);
        $request['end_date'] = setEntryDateAttribute($request['end_date']);
        if (isset($request->phase_id)) {
            $phase = Phase::find($request->phase_id);
            $phase->update($request->all());
        } else
            $phase = Phase::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        return response(['phase' => $phase, 'status' => 'success'], 200);

    }

    public function remove(Request $request)
    {
        $phase = Phase::find($request->phase_id);
        $phase->delete();
        return response(['phase_id' => $request->phase_id, 'status' => 'success'], 200);

    }

    public
    function getPhaseDeatial(Request $request)
    {
        $phase = Phase::find($request->phase_id);
        $phase->start_date = dateFormFormat($phase->start_date);
//        Carbon::
        $phase->end_date = dateFormFormat($phase->end_date);
        return response($phase, 200);

    }

    public
    function update(ProjectRequest $request, Project $project)
    {
        $request['start_date'] = setEntryDateAttribute($request['start_date']);
        $request['end_date'] = setEntryDateAttribute($request['end_date']);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', '  project updated successfully');

    }


    public
    function active(Request $r)
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
//        $project = Project::findOrFail($id);
//        return dd($id);
//    }

    public
    function show(Phase $phase)
    {
        $progress = [
            'all' => count($phase->tasks),
            'approved' => 0,
            'very_low' => 0,
            'very_low_complete' => 0,
            'low' => 0,
            'low_complete' => 0,
            'medium' => 0,
            'medium_complete' => 0,
            'high' => 0,
            'high_complete' => 0,
            'very_high' => 0,
            'very_high_complete' => 0,
        ];
//        return dd($progress[]);
        foreach ($phase->tasks as $task) {
            if ($task->status == 'approved') {
                $progress['approved']++;
                $progress[$task->priority . '_complete']++;
            }
            $progress[$task->priority]++;
        }

        $tasksAppeoved = Task::where('phase_id', '=', $phase->id)
            ->where('status','approved')->orderByDesc('updated_at')->limit(6)->get();


        return view('projects.show', compact('phase'))
            ->with('taskAppeoveds', $tasksAppeoved)
            ->with('progress', $progress);

    }

    public
    function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }


    public
    function delete($id)
    {

        $project = Project::find(decrypt($id));
//        return dd($User->profile);
//        if ($User->open_courses->count() > 0)
//            return redirect(route('Users.index'))->with('warning', 'Not allow to delete because this member has OpenCourses  ');
        $project->deleted_by = Auth::user()->id;
        $project->save();
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'project deleted successfully');


    }

    public
    function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find(decrypt($id));
        $project->forceDelete();
        return redirect(route('projects.index', 'deleted'))->with('success', 'project deleted successfully');
    }

    public
    function restore($id)
    {

        $project = Project::onlyTrashed()->find(decrypt($id));
        $project->restore();
        return redirect(route('projects.index', 'deleted'))->with('success', 'project restored successfully');
    }

    public
    function destroy($id)
    {
        //
    }


}
