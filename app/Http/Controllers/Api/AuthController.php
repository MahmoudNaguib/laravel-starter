<?php

namespace App\Http\Controllers\Api;

use Hash;
use Auth;

class AuthController extends \App\Http\Controllers\Controller {

    /*
     * 200: success   // Can have message
     * 201 created    //Always have message
     * 401: unauthorized  //Always have message
     * 422: Validation error   //Always have message and errors object with the field key that has error
     * 403: Forbidden //Always have message
     * 404: page not found //Always have message
     * 400: Bad Request //Always have message
     */
    public function __construct(\App\Models\User $model) {
        $this->model = $model;
        $this->rules = $model->rules;
        $this->loginRules = $model->loginRules;
        $this->forgotRules = $model->forgotRules;
        $this->resetRules = $model->resetRules;
    }
    public function postRegister() {
        request()->request->add(['type'=>'guest']);
        ValidateRequestApi(request()->all(), $this->rules);
        if ($row=$this->model->register()) {
            if($row->confirmed){
                return response()->json(['message' => trans('app.Thanks for your registration, You can login now')], 201);
            }
            else{
                return response()->json(['message' => trans('app.Welcome to our community, We have sent you an email, Please check your inbox')], 201);
            }
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 400);
    }

    public function postLogin() {
        ValidateRequestApi(request()->all(), $this->loginRules);
        $row = $this->model->where('type','guest')
            ->where('email', trim(request('email')))
            ->first();
        if (!$row) {
            return response()->json([
                'message' => trans('app.There is no account with the provided information'),
            ], 403);
        }
        if (!$row->confirmed) {
            return response()->json([
                'message' => trans('app.Account with this email is not confirmed'),
            ], 403);
        }
        if (!$row->is_active) {
            return response()->json([
                'message' => trans('app.Account with this email is banned'),
            ], 403);
        }
        if (!Hash::check(trim(request('password')), $row->password)) {
            return response()->json([
                'message' => trans('app.Trying to login with invalid password')
            ], 403);
        }
        $data = [
            'last_logged_in_at' => date('Y-m-d H:i:s'),
            'last_ip' => @$_SERVER['REMOTE_ADDR']
        ];
        if ($row->update($data)) {
            \Auth::login($row);
            request()->headers->set('Authorization', 'Bearer ' . $row->token);
            /////////////// Update Push Token
            if (request('push_token')) {
                $pushToken = \App\Models\PushToken::where('user_id', $row->id)->where('push_token', request('push_token'))->first();
                if (!$pushToken) {
                    \App\Models\PushToken::create([
                        'push_token' => request('push_token'),
                        'user_id'=>$row->id
                    ]);
                }
            }
            /// //////////////////
            $row = $this->model->includes()->findOrFail($row->id);
            return response()->json([
                'message' => trans('app.Successfully logged in'),
                'data' => new \App\Http\Resources\UserResource($row),
            ], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 400);
    }

    public function postForgotPassword() {
        ValidateRequestApi(request()->all(), $this->forgotRules);
        $row = $this->model
            ->where('email', request('email'))
            // ->orWhere('mobile',trim(request('email')))
            ->first();
        if (!$row) {
            return response()->json([
                'message' => trans('app.There is no account with the provided information'),
            ], 403);

        }
        if (!$row->confirmed) {
            return response()->json([
                'message' => trans('app.Account with this email is not confirmed')
            ], 403);
        }
        if (!$row->is_active) {
            return response()->json([
                'message' => trans('app.Account with this email is banned')
            ], 403);
        }
        $row->password_token = generateToken($row->email);
        if ($row->save()) {
            \App\Jobs\ForgotPassword::dispatch($row);
            return response()->json(['message' => trans('app.Password reset link has been sent to your email')], 200);
        }
        return response()->json(['message' => trans('app.Failed to handle your request')], 400);
    }
}
