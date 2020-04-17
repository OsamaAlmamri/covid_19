<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectsDataTable;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
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

    public function store(ProjectRequest $request)
    {
        $request['start_date'] = setEntryDateAttribute($request['start_date']);
        $request['end_date'] = setEntryDateAttribute($request['end_date']);
        $project = Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'project  add successfully');

    }

    public function update(ProjectRequest $request, Project $project)
    {
        $request['start_date'] = setEntryDateAttribute($request['start_date']);
        $request['end_date'] = setEntryDateAttribute($request['end_date']);
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', '  project updated successfully');

    }


    public function team(Request $request)
    {

        $u = explode(',', $request->team);

        $project = Project::find($request->project_id);
        $users = User::find($u);
        $project->users()->sync($users);
        $data = '';
        foreach ($users as $user) {
            $data .= '   <div class="media">
                                        <div class="media-left media-middle photo-table">
                                            <a href="#">
                                                <img class="media-object img-radius"
                                                     src="'.HostUrl($user->avatar).'"
                                                     alt="'.$user->avatar.'">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h6>'.$user->name.'</h6>
                                            <p>'.$user->username.'</p>
                                        </div>
                                    </div>';
        }

//        $request['start_date'] = setEntryDateAttribute($request['start_date']);
//        $request['end_date'] = setEntryDateAttribute($request['end_date']);
//        $project->update($request->all());
        return response(['team' => $data,'status' => 'success'], 200);

        return redirect()->route('projects.index')->with('success', '  project updated successfully');

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
//        $project = Project::findOrFail($id);
//        return dd($id);
//    }

    public function show(Project $project)
    {


        return view('projects.showPhases', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }


    public function delete($id)
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

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find(decrypt($id));
        $project->forceDelete();
        return redirect(route('projects.index', 'deleted'))->with('success', 'project deleted successfully');
    }

    public function restore($id)
    {

        $project = Project::onlyTrashed()->find(decrypt($id));
        $project->restore();
        return redirect(route('projects.index', 'deleted'))->with('success', 'project restored successfully');
    }

    public function destroy($id)
    {
        //
    }


}
