<?php


namespace App\Http\Controllers\API;


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
                if ($user->status == 1) {
                    $success['token'] = $user->createToken('MyApp')->accessToken;;

                    $user['deleted_at']=0;
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
