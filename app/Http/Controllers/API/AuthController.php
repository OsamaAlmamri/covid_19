<?php


namespace App\Http\Controllers\API;

use App\BlockedPerson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseAPIController
{

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */


    public function login(Request $request)
    {
        try {
            $credential_email = ['email' => $request->username, 'password' => $request->password];
            $credential_username = ['username' => $request->username, 'password' => $request->password];
            if (Auth::attempt($credential_email)
                or Auth::attempt($credential_username)
            ) {
                $user = Auth::user();
                $max_req_id = BlockedPerson::where('created_by',$user->id)->max('req_id');
                if ($user->status == 1) {
                    $success['token'] = $user->createToken('MyApp')->accessToken;
                    $user->deleted_by = ($user->deleted_by == null ? 0 : $user->deleted_by);
                    $user->deleted_at = ($user->deleted_at == null ? '1970-01-01 00:00:00' : $user->deleted_at);
                    $user->max_request = ($max_req_id == null ? 0 : $max_req_id);

                    /* $user2=array(
"id" => auth()->user()->id,
"username" => auth()->user()->username,
"email" => auth()->user()->email,
"email_verified_at" => auth()->user()->email_verified_at,
"password" => auth()->user()->password,
"status" => auth()->user()->status,
"avatar" => auth()->user()->avatar,
"created_by" => auth()->user()->created_by,
"work_team_id" => auth()->user()->work_team_id,
"deleted_by" => 0,
"deleted_at" => 0,
"remember_token" => auth()->user()->remember_token,
"created_at" => 0,
"updated_at" =>0
); */

                    return $this->sendResponse([
                        "status" => 1,
                        "access_token" => $success['token'],
                        "userInfo" => $user,
                        "token_type" => "Bearer",

                    ], 'User  login succesfully');
                } else {
                    return $this->sendResponse([
                        "status" => 0,
                    ], 'User account not active');
                }
            } else {
//            return response()->json(['error' => 'Unauthorised'], 401);
                return $this->sendError('user name or password Wrong', '', 401);
            }

        } catch (Exception $ex) {
            return $ex->getMessage();

        }


    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

//    public function register(Request $request)
//    {
//
//        try {
//            $validator = Validator::make($request->all(), [
////            'username' => ['required', 'string', Rule::unique('users', 'username')],
//                'name' => 'required|string',
//                'email' => ['string', 'email', Rule::unique('users', 'email')],
//                'phone' => ['required', 'string', Rule::unique('users', 'phone')],
//                'password' => 'required|confirmed',
//            ],
//                [
//                    'username.required' => 'إسم المستخدم مطلوب',
//                    'username.unique' => 'إسم المستخدم هذا مستخدم من قبل',
//                    'name.required' => 'الإسم مطلوب',
//                    'email.required' => 'الإيميل مطلوب',
//                    'email.email' => 'صيغة الإيميل غير صالحة',
//                    'email.unique' => 'هذا الإيميل مستخدم بالفعل',
//                    'phone.unique' => 'رقم الهاتف مستخدم من قبل',
//                    'phone_number.required' => 'رقم الهاتف مطلوب',
//                    'password.required' => 'كلمة المرور مطلوبة',
//                    'password.confirmed' => 'كلمة المرور غير متطابقة',
//                ]);
//            if ($validator->fails()) {
//                return $this->sendError('error validation', $validator->errors(), 422);
//            }
//            $input = $request->all();
//            $input['password'] = bcrypt($input['password']);
//            $input['username'] = ($input['phone']);
//            $user = User::create($input);
//            $success['name'] = $user->name;
//            return $this->sendResponse($success, 'User  created succesfully');
//        } catch (Exception $ex) {
//            return $ex->getMessage();
//
//        }
//
//    }

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


}
