<?php


namespace App\Http\Controllers\API;

use App\BlockedPerson;
use App\CheckPoint;
use App\QuarantineArea;
use App\QuarantineAreaType;
use App\TempSave;
use App\User;
use App\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProjectApiController extends BaseAPIController
{

    public function getAllBlockPersonsPerZone(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = BlockedPerson::where('quarantine_area_id', '>', 0)->get();
                $messsage = 'بيانات جميع المحجورين  بالمراكز في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات جميع المحجورين  بالمراكز في محافظة  ' . $isGovernment->name_ar;

                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع المحجورين  بالمراكز في مديرية   ' . $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;

                    $qrs = QuarantineArea::all()->whereIn('zone_id', $ids);
                    $qr_id = [];
                    foreach ($qrs as $qr) {
                        $qr_id[] = $qr->id;
                    }
                    $data = BlockedPerson::whereIn('zone_id', $ids)->get();

                }

            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function saveIncommingBlockPersion(Request $request)
    {
        try {
            $project = TempSave::create([
                'data' => $request->data,
                'user_id' => auth()->user()->id,
                'team_work_id' => auth()->user()->work_team->id,
            ]);
//
            $array = json_decode(($request->data), true);
            $c = 0;
            foreach ($array as $temp) {
                $c++;
                BlockedPerson::create(array_merge($temp), ['created_by' => 1]);
            }

            return $this->sendResponse([], 'تم حفظ بيانات ' . $c . ' شخص  بنجاح  ');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAllQuarantineTypes(Request $request)
    {
        try {
            $data = QuarantineAreaType::where('id', '>', 0)->get();
            $messsage = 'بيانات انواع مراكز الحجر ';

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getMyAddBlockPerson(Request $request)
    {
        try {
            $user = auth()->user()->id;

            $data = BlockedPerson::where('created_by', '=', $user)->get();
            $messsage = 'بيانات المحجورين المضافين من هذا الحساب  ';

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getBlockPerson(Request $request)
    {
        try {
            $data = BlockedPerson::find($request->id);
            $messsage = 'بيانات المحجور    ' . $data->name;

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }


    }

    public function getAllZones(Request $request)
    {
        try {
            if ($request->id == 'all') {
                $data = Zone::where('parent', '>', 0)->get();
                $messsage = 'بيانات جميع مديريات  الــيمن ';
            } else if ($request->id == 0) {
                $data = Zone::all()->where('parent', '=', 0);
                $messsage = 'بيانات جميع محافظات  الــيمن ';

            } else {
                $government = Zone::find($request->id);//
                $messsage = 'بيانات جميع   مديريات محافظة  ' . $government->name_ar;
                $data = Zone::all()->where('parent', '=', $request->id);
            }

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAllUsers(Request $request)
    {
        try {
            $data = User::where('id', '>', 0)->get();
            $messsage = 'بيانات جميع   المستخدمين  ';


            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public
    function getAllQuarantines(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = QuarantineArea::where('id', '>', 0)->get();
                $messsage = 'بيانات مراكز الحجر  في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات مراكز الحجر  في محافظة  ' . $isGovernment->name_ar;
                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع راكز الحجر  في  مديرية   ' .
                        $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;
                    $data = QuarantineArea::whereIn('zone_id', $ids)->get();
                }
            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public
    function getAllCheckPoint(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = CheckPoint::where('id', '>', 0)->get();
                $messsage = 'بيانات مراكز الحجر  في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات مراكز التفتيش  في محافظة  ' . $isGovernment->name_ar;
                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع راكز التفتيش  في  مديرية   ' .
                        $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;
                    $data = CheckPoint::whereIn('zone_id', $ids)->get();
                }
            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public
    function getAllBlockPersonsPerCenter(Request $request)
    {
        try {
            $data = BlockedPerson::where('quarantine_area_id', '=', $request->id)->get();
            $messsage = 'بيانات جميع المحجورين  للمركز  رقم  ' . $request->id;

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public
    function userInfo()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse($user, 'success');
        } catch (Exception $ex) {
            return $ex->getMessage();

        }
    }


}
