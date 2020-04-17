<?php

namespace App\Http\Controllers;

use App\DataTables\StaffTasksDataTable;
use App\DataTables\TasksDataTable;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\TaskRequest;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index($phase_id, $type = '')
    {
        $User = new TasksDataTable($phase_id, $type);
        return $User->render('tasks.index', ['deleted' => ($type == '') ? false : true]);
    }

    public function staffTasks($project_id, $user_id)
    {
        $User = new StaffTasksDataTable($project_id, $user_id);
        if ($project_id != 'all')
            $project = Project::find($project_id);
        else
            $project = 'all';

        $staff = User::find($user_id);

        return $User->render('tasks.index', ['staff' => $staff, 'project' => $project]);
    }


    public function create()
    {
        return view('projects.create');
    }

    public function store(TaskRequest $request)
    {

        $request['start_date'] = setEntryDateAttribute($request['start_date']);
        $request['end_date'] = setEntryDateAttribute($request['end_date']);
        if (isset($request->task_id)) {
            $task = Task::find($request->task_id);
            $task->update($request->all());
        } else
            $task = Task::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        return response(['task' => $task, 'status' => 'success'], 200);

    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->update(['status' => $request->newStatus]);
        return response(['task' => $task, 'status' => 'success'], 200);

    }

    public function member(Request $request)
    {


        $task = Task::find($request->task);
        $user = User::find($request->user);
        $task->update(['user_id' => $user->id]);

        $data = '  <a href="#!" data-toggle="tooltip" title="' . $user->id . '">
                                                    <img class="img-fluid img-radius"
                                                         src="' . HostUrl($user->avatar) . '" alt="1"></a>';


        return response(['user' => $data, 'status' => 'success'], 200);

    }

    public function remove(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->delete();
        return response(['task_id' => $request->task_id, 'status' => 'success'], 200);

    }

    public
    function getTaskDeatial(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->start_date = dateFormFormat($task->start_date);
//        Carbon::
        $task->end_date = dateFormFormat($task->end_date);
        return response($task, 200);

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
    function show(Project $project)
    {
        return view('projects.show', compact('project'));
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
