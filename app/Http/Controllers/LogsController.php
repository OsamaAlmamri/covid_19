<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index($type = 'report')
    {
//        if (Auth::user()->can('show pointTeams') == false)
//            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        return view('reports.logs')->with('type', $type);

    }

    public function how(Request $request)
    {
//       return $request['id'];

        $log = Log::create(
            [
                'member_id' => auth()->user()->id,
                'name' => $request->what,
                'description' => $request->description,
                'type' => $request->type,
                'user_id' => auth()->user()->id,
            ]);


        return response(['data' => 'll'], 200);

    }

    public function getRepottsLogsData($type, $from_date = '1920-01-01', $to_date = '9999-09-09')
    {

        if ($type == 'all') {
            $type_v = 0;
            $type_col = 'logs.id';
            $type_op = '>';

        } else {
            $type_v = '%' . $type . '%';
            $type_col = 'logs.type';
            $type_op = 'like';

        }


        $data = DB::table('logs')
            ->leftJoin('users', 'users.id', '=', 'logs.user_id')
            ->leftJoin('work_teams', 'work_teams.id', '=', 'logs.member_id')
            ->select('logs.*',
                'work_teams.name as work_team_name', 'work_teams.phone',
                'users.username', 'users.email')
//            ->WhereNotNull('work_teams.deleted_at')
            ->whereBetween('logs.created_at', [$from_date, $to_date])
            ->where($type_col, $type_op, $type_v)
            ->orderByDesc('id')->get();


        return $data;
    }


    public function filter(Request $request)
    {
        //government, zone, from_date, to_date, gender, workTeamType

        $type = $request->type;
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getRepottsLogsData($type, $from, $to);

        return datatables()->of($data)
            ->addIndexColumn()
            ->rawColumns([
            ])->make(true);

    }


}
