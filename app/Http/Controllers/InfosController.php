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
        if ($allZones != null)
            foreach ($allZones as $zone) {
                $zones .= '<option value="' . $zone->id . '"> ' . $zone->name_ar . '</option>';

            }
        return response(['data' => $zones], 200);

    }


    public function changeModal(Request $request)
    {
        if ($request->modal != 'الكل')
            $tracks = Truck::all()->where('modal', 'like', $request->modal);
        else
            $tracks = Truck::all();

        $info_data = getModalTracks($request->modal);

        $selectTrack = '';
        foreach ($info_data['selectTrack'] as $k => $info) {
            $selectTrack .= '<option value="' . $k . '"> ' . $info . '</option>';
        }
        $types = '';
        foreach ($info_data['types'] as $k => $info) {
            $types .= '<option value="' . $k . '"> ' . $info . '</option>';
        }
        return response(['selectTrack' => $selectTrack, 'selectTypes' => $types], 200);


    }


    public function changeType(Request $request)
    {
        $info_data = getModalTypeTracks($request->modal, $request->type);

        $selectTrack = '';
        foreach ($info_data as $k => $info) {
            $selectTrack .= '<option value="' . $k . '"> ' . $info . '</option>';
        }
        return response(['selectTrack' => $selectTrack], 200);

    }

}
