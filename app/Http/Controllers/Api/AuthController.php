<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends BaseController {
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['id'] = $user->id;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Wrong password or email!.', ['email'=>['These credentials do not match our records.']]);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            $input = $request->all();
            // TODO: Check existed user
            if ($oldUser = User::where('email', $input['email'])->first()) {
                return $this->sendError("Register unsuccessfully!", ['email' => ['The email was existed!']]);
            }

            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['id'] = $user->id;

            return $this->sendResponse($success, 'User register successfully.');
        } catch (QueryException $err) {
            return $this->sendError("Register unsuccessfully!", [$err->getMessage()]);
        }
    }

    public function me(Request $request) {
        $authUser = Auth::user();
        $user = User::where('id', $authUser->id)->first();
        return new UserResource($user->load('events'));
    }

    public function test401() {
        return \response()->json(['data' => null], 401);
    }
}
