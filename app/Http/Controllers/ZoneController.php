<?php

namespace App\Http\Controllers;

use App\DataTables\ZonesDataTable;
use App\Http\Requests\zonesRequest;
use App\Price;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
//$permission = Permission::create(['name' => 'show admins']);
//$permission = Permission::create(['name' => 'active admins']);
//$permission = Permission::create(['name' => 'manage admins']);//add ,update , delete
//$permission = Permission::create(['name' => 'manage deleted admins']);//restore forceDelete

    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('permission:manage admins', ['only' => ['j']]);
//        $this->middleware('permission:show admins', ['only' => ['index']]);
    }

    public function index($zone = 0, $zoneType = '')
    {
//        $f=User::with(['truck','attester_1','attester_2','creater_admin'])->get();
//        return dd($f) ;


//        return dd(Zone::all()->where('parent', 0)->last()->childZone);
//        $orders_incoming = Zone::with('childZone')
//            ->whereHas('childZone', function ($query) {
////                $query->where('provider_id',Auth::user()->id);
//            })->where('parent', 0)->get();
//
//        foreach ($orders_incoming as $o)
//        {
//            return dd($o->childZone);
//        }
        $zone = new ZonesDataTable($zone, $zoneType);
        return $zone->render('admin.zones.index', ['title' => 'admins', 'deleted' => ($zoneType == '') ? false : true]);
    }

    public function getZones(Request $request)
    {
//       return $request['id'];

        if ($request['id'] != 'all')
            $allZones = Zone::all()->where('parent', $request['id'])
                ->where('type', 'like', $request->zone_type);
        else
            $allZones = Zone::all()->where('parent', '>', 0)
                ->where('type', 'like', $request->zone_type);

        $zones = '';
        if (isset($request['type']) and $request['type'] == 'all')
            $zones .= '<option value="all">all</option>';

        if ($allZones != null)
            foreach ($allZones as $zone) {
                $zones .= '<option value="' . $zone->code . '"> ' . $zone->name_ar . '</option>';

            }
        return response(['data' => $zones], 200);

    }


    public function create($z)
    {
        $zone = Zone::find($z);
        return view('admin.zones.create')->with('parentZone', $zone)->with('formType', 'create');
    }

    public function store(Request $request)
    {
        $parent = (isset($request->parent)) ? $request->parent : 0;
        if ($parent == 0) {
            $Parentzone = Zone::create(array_merge($request->all(),
                [
                    'status' => 1,
                    'parent' => $parent,
                ]));
            $parent = $Parentzone->id;
        }
        if (isset($request->zones)) {
            foreach ($request->zones as $zone) {
                Zone::create(
                    [
                        'name_ar' => $zone['name_ar'],
                        'name_en' => ($zone['name_en'] !== null) ? $zone['name_en'] : $zone['name_ar'],
                        'parent' => $parent,
                    ]);
            }
        }

        return redirect()->route('admin.zones.index', $parent)->with('success', 'Zone add successfully');
    }


    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $zone = Zone::find($r->id);
        $zone->status = $new_status;
        $zone->save();
        return $new_status;
    }

    public function show($id)
    {
        //
    }

    public function edit(Zone $zone)
    {
        $parentZone = Zone::find($zone->parent);
        $oldZones = [];
        if ($parentZone == null) {
            $oldZones = Zone::all()->where('parent', '=', $zone->id);
        }

        return view('admin.zones.create')
            ->with('zone', $zone)
            ->with('formType', 'update')
            ->with('oldZones', $oldZones)
            ->with('parentZone', $parentZone);
    }

    public function update(Request $request, Zone $zone)
    {
        $zone->update($request->all());
        $parent = $zone->id;
        $zonenotDeleted = [];
        if (isset($request->zones)) {
            foreach ($request->zones as $zone) {
                $z = Zone::create(
                    [
                        'name_ar' => $zone['name_ar'],
                        'name_en' => ($zone['name_en'] !== null) ? $zone['name_en'] : $zone['name_ar'],
                        'parent' => $parent,
                    ]);
                $zonenotDeleted[] = $z->id;
            }
        }
        if (isset($request->old_zones)) {

            foreach ($request->old_zones as $zone) {
                $zonenotDeleted[] = $zone['id'];
                $zone = Zone::find($zone['id']);
                $zone->update(
                    [
                        'name_ar' => $zone['name_ar'],
                        'name_en' => $zone['name_en'],
                    ]);
            }
        }


        $errorDeleteMessage = ' but ';
        $deleteItems = true;
        $ZoneToDelete = Zone::all()->whereNotIn('id', $zonenotDeleted)->where('parent', '=', $parent);
        if ($ZoneToDelete != null) {
            foreach ($ZoneToDelete as $zone) {
                $delete = $this->forceDeleteZone($zone);
                if ($delete !== true) {
                    $deleteItems = false;
                    $errorDeleteMessage .= $delete . '   ';
                }

            }
        }
        if ($deleteItems == false)
            $errorDeleteMessage .= 'not deleted because it has related data ';
        else
            $errorDeleteMessage = '';


        return redirect()->route('admin.zones.index')->with('success', '  Zone updated successfully ' . $errorDeleteMessage);
    }

    private function deleteZone($zone)
    {
        if (count($zone->childZone) > 0)
            return $zone->name_en;
        else {
            $prices = Price::withTrashed()
                ->where('from', '=', $zone->id)
                ->orWhere('to', '=', $zone->id)->get();
            foreach ($prices as $p) {
                $p->delete();
            }
            $zone->delete();
            return true;
        }
    }

    private function forceDeleteZone($zone)
    {
        if (count($zone->childZoneDeleted) > 0)
            return $zone->name_en;
        else {
            $prices = Price::withTrashed()
                ->where('from', '=', $zone->id)
                ->orWhere('to', '=', $zone->id)->get();
            foreach ($prices as $p) {
                $p->forceDelete();
            }

            $zone->forceDelete();
            return true;
        }
    }

    public function delete($id)
    {
//        return dd($id);


        $zone = Zone::find(decrypt($id));

        $parent = $zone->parent;
        $delete = $this->deleteZone($zone);
//        if ($zone->open_courses->count() > 0)
//            return redirect(route('admins.index'))->with('warning', 'Not allow to delete because this member has OpenCourses  ');
        if ($delete === true)
            return redirect()->route('admin.zones.index', $parent)->with('success', 'zone deleted successfully');
        else
            return redirect()->route('admin.zones.index', $parent)->with('success', $delete . '  not  deleted be because it has related data ');


    }

    public function forceDelete($id)
    {
        $zone = Zone::onlyTrashed()->find(decrypt($id));
        $parent = $zone->parent;
        $delete = $this->forceDeleteZone($zone);
//
        if ($delete === true)
            return redirect()->route('admin.zones.index', [$parent, 'deleted'])->with('success', 'zone deleted successfully');
        else
            return redirect()->route('admin.zones.index', [$parent, 'deleted'])->with('success', $delete . '  not  deleted be because it has related data ');

    }

    public function restore($id)
    {
//        return dd($id);

        $zone = Zone::onlyTrashed()->find(decrypt($id));
        $zone->restore();
        $parent = $zone->parent;

        return redirect(route('admin.zones.index', [$parent, 'deleted']))->with('success', 'Zone restored successfully');
    }

    public function destroy($id)
    {
        //
    }

}
