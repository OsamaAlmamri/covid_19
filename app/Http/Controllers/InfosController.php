<?php

namespace App\Http\Controllers;

use App\HaraVil;
use App\SubDi;
use App\SubHaraVil;
use App\Truck;
use App\Zone;
use Illuminate\Http\Request;

class InfosController extends Controller
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
    public function getZones(Request $request)
    {
//       return $request['id'];

        if (isset($request->type) and $request->type != null)
            $type = $request->type;
        else
            $type = 'district';
        switch ($type) {
            case 'gov':
                $allZones = Zone::all()->where('type', 'like', $type)->where('parent', $request['id']);
                break;
            case 'district':
                $allZones = Zone::all()->where('type', 'like', $type)->where('parent', $request['id']);
                break;
            case 'hara_vil':
                $allZones = HaraVil::all()->where('type', 'like', $type)->where('parent', $request['id']);
                break;
            case 'sub_hara_vil':
                $allZones = SubHaraVil::all()->where('type', 'like', $type)->where('parent', $request['id']);
                break;
            case 'sub_dis':
                $allZones = SubDi::all()->where('type', 'like', $type)->where('parent', $request['id']);
                break;
        }
        $zones = '';
        if ($request->type == 'all')
            $zones .= '<option value="all"> ' . trans('menu.all') . '</option>';
        if ($allZones != null)
            foreach ($allZones as $zone) {
                $zones .= '<option value="' . $zone->code . '"> ' . $zone->name_ar . '</option>';

            }
        return response(['data' => $zones], 200);

    }


}
