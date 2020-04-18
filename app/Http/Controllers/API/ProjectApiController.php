<?php


namespace App\Http\Controllers\API;


use App\Attendence;
use App\BlockedPerson;
use App\DaysQr;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class ProjectApiController extends BaseAPIController
{
    public function getInfo(Request $request)
    {
        try {
            $project = Project::findOrFail($request->project_id);
            if ($request->type == 'task')
                $data = $project->phases;
            else
                $data = $project->users;
            return $this->sendResponse($data, '');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getProjects(Request $request)
    {
        try {

            $project = Project::where('id', '>', 0)->get();
            return $this->sendResponse($project, '');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function userTasks(Request $request)
    {
        try {
            if ($request->status == null or $request->status == 'all') {
                $data = Task::where('user_id', '=', auth()->user()->id)->get();
            } else
                $data = Task::where('user_id', '=', auth()->user()->id)->where('status', 'like', $request->status)->get();
            return $this->sendResponse($data, '');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function getAllBlockPersonsPerZone(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = BlockedPerson::where('quarantine_area_id', '>', 0)->get();
                $messsage = 'بيانات جميع المحجورين  بالمراكز في الــيمن ';
            } else {
                $zone=
                $data = Task::where('user_id', '=', $request->user_id)
                    ->whereIn('phase_id', getProjectServeceIds($request->project_id))->get();
                $messsage = 'بيانات جميع المهام  للمشروع رقم  ' . $request->project_id;
            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function changeTaskStatusByManager(Request $request)
    {
        try {
            $task = Task::find($request->task_id);
//            return $this->sendResponse($task->phase->project->manager_id, '');

            if (auth()->user()->id == $task->phase->project->manager_id) {
                $task->update(['status' => $request->newStatus]);
                $messsage = 'تم تغيير الحالة بنجاح ';
                return $this->sendResponse(['status' => $request->newStatus], $messsage);

            } else {
                return $this->sendError([], "لست مخول لتغيير حالة المهمة ");

            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function changeTaskStatusByStaff(Request $request)
    {
        try {
            $task = Task::find($request->task_id);
//            return $this->sendResponse($task->phase->project->manager_id, '');

            if (auth()->user()->id == $task->user_id) {
                $task->update(['status' => $request->newStatus]);
                $messsage = 'تم تغيير الحالة بنجاح ';
                return $this->sendResponse(['status' => $request->newStatus], $messsage);

            } else {
                return $this->sendError([], "لست مخول لتغيير حالة المهمة ");

            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function userProjects(Request $request)
    {
        try {
            $data = auth()->user()->projects;
            return $this->sendResponse($data, '');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function register(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
//            'username' => ['required', 'string', Rule::unique('users', 'username')],
                'name' => 'required|string',
                'email' => ['string', 'email', Rule::unique('users', 'email')],
                'phone' => ['required', 'string', Rule::unique('users', 'phone')],
                'password' => 'required|confirmed',
            ],
                [
                    'username.required' => 'إسم المستخدم مطلوب',
                    'username.unique' => 'إسم المستخدم هذا مستخدم من قبل',
                    'name.required' => 'الإسم مطلوب',
                    'email.required' => 'الإيميل مطلوب',
                    'email.email' => 'صيغة الإيميل غير صالحة',
                    'email.unique' => 'هذا الإيميل مستخدم بالفعل',
                    'phone.unique' => 'رقم الهاتف مستخدم من قبل',
                    'phone_number.required' => 'رقم الهاتف مطلوب',
                    'password.required' => 'كلمة المرور مطلوبة',
                    'password.confirmed' => 'كلمة المرور غير متطابقة',
                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['username'] = ($input['phone']);
            $user = User::create($input);
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User  created succesfully');
        } catch (Exception $ex) {
            return $ex->getMessage();

        }

    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function userInfo()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse($user, 'success');
        } catch (Exception $ex) {
            return $ex->getMessage();

        }
    }

    public function attendences(Request $request)
    {
        try {
            $qr = DaysQr::all()->last();
            if ($qr->name == $request->qr) {
                $user_qr = Attendence::all()->where('user_id', '=', auth()->user()->id)->last();
                if (($user_qr == null) or Carbon::today()->day != $user_qr->created_at->day) {
                    Attendence::create([
                        'user_id' => auth()->user()->id,
                        'period_id' => 1,
                        'day_id' => $qr->id,
                    ]);
                    return $this->sendResponse(['success' => true], 'تم التحضير بنجاح');
                } else {
                    return $this->sendResponse(['success' => false], ' لقد تم التحضير مسبقا ');
                }
            } else
                return $this->sendError(['success' => false], 'الكود خطاء');


        } catch (Exception $ex) {
            return $ex->getMessage();

        }
    }


}
