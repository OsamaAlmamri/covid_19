<?php

namespace App\Http\Controllers;

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

        $allZones = Zone::all()->where('parent', $request['id']);
        $zones = '';
        if ($request->type == 'all')
            $zones .= '<option value="all"> ' . trans('menu.all') . '</option>';
        if ($allZones != null)
            foreach ($allZones as $zone) {
                $zones .= '<option value="' . $zone->id . '"> ' . $zone->name_ar . '</option>';

            }
        return response(['data' => $zones], 200);

    }


}
