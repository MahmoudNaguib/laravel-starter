<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;

class AuthController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\User $model) {
        $this->middleware('guest');
        $this->module = 'auth';
        $this->model = $model;
        $this->rules = $model->rules;
        $this->resetRules = $model->resetRules;
        $this->loginRules = $model->loginRules;
        $this->forgotRules = $model->forgotRules;
    }

    public function getRegister() {
        $data['page_title'] = trans('app.Register');
        $data['row'] = $this->model;
        return view($this->module . '.register', $data);
    }

    public function postRegister() {
        request()->request->add(['type'=>'guest']);
        $this->validate(request(), $this->rules);
        if ($row=$this->model->register()) {
            if($row->confirmed){
                flash()->success(trans('app.Thanks for your registration, You can login now'));
            }
            else{
                flash()->success(trans('app.Welcome to our community, We have sent you an email, Please check your inbox'));
            }
            return redirect('auth/login');
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }

    public function getLogin() {
        $data['page_title'] = trans('app.Login');
        $data['row'] = $this->model;
        return view($this->module . '.login', $data);
    }

    public function postLogin() {
        $this->validate(request(), $this->loginRules);
        $row = $this->model
            ->where('email', trim(request('email')))
            ->first();
        if (!$row) {
            flash()->error(trans('app.There is no account with the provided information'));
            return back()->withInput();
        }
        if (!$row->is_active) {
            flash()->error(trans('app.This account is banned'));
            return back()->withInput();
        }
        if (!$row->confirmed) {
            flash()->error(trans('app.This account is not confirmed'));
            return back()->withInput();
        }

        if (!Hash::check(trim(request('password')), $row->password)) {
            flash()->error(trans('app.Trying to login with invalid password'));
            return back()->withInput();
        }

        $data = [
            'last_logged_in_at' => date('Y-m-d H:i:s'),
            'last_ip' => @$_SERVER['REMOTE_ADDR']
        ];
        if ($row->update($data)) {
            auth()->login($row, request('remember_me'));
            flash()->success(trans('app.Welcome') . ' ' . auth()->user()->name);
            return redirect('/');
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }

    public function getConfirm() {
        if (!request('token')) {
            $data['message'] = trans('app.Invalid token');
            $data['type'] = 'danger';
        } else {
            $row = $this->model->where('confirm_token', request('token'))->first();
            if ($row) {
                $row->confirmed = 1;
                // $row->confirm_token=null;
                if ($row->save()) {
                    $data['message'] = trans('app.Your account has been confirmed');
                    $data['type'] = 'success';
                }
            } else {
                $data['message'] = trans('app.Invalid token');
                $data['type'] = 'danger';
            }
        }
        $data['page_title'] = trans('app.Confirm account');
        return view($this->module . '.confirm', $data);
    }

    public function getForgotPassword() {
        $data['page_title'] = trans('app.Forgot password');
        $data['row'] = $this->model;
        return view($this->module . '.forgot-password', $data);
    }

    public function postForgotPassword() {
        $this->validate(request(), $this->forgotRules);
        $row = $this->model
            ->where('email', trim(request('email')))
            ->first();
        if (!$row) {
            flash()->error(trans('app.There is no account with the provided information'));
            return back()->withInput();
        }
        if (!$row->confirmed) {
            flash()->error(trans('app.Account with this email is not confirmed'));
            return back()->withInput();
        }
        if (!$row->is_active) {
            flash()->error(trans('app.Account with this email is banned'));
            return back()->withInput();
        }
        $row->password_token = generateToken($row->email);
        if ($row->save()) {
            \App\Jobs\ForgotPassword::dispatch($row);
            flash()->success(trans('app.Password reset link has been sent to your email'));
            return back();
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }

    public function getResetPassword() {
        $data['page_title'] = trans('app.Reset password');
        $data['row'] = $this->model;
        if (!request('token')) {
            flash()->error(trans('app.Invalid password reset token'));
            return redirect('/auth/login');
        }
        $data['row'] = $this->model->where('password_token', request('token'))->first();
        if (!$data['row']) {
            flash()->error(trans('app.Invalid password reset token'));
            return back()->withInput();
        }
        return view($this->module . '.reset-password', $data);
    }

    public function postResetPassword() {
        $this->validate(request(), $this->resetRules);
        $row = $this->model->where('password_token', request('token'))->first();
        if (!$row) {
            flash()->error(trans('app.Invalid password reset token'));
            return back()->withInput();
        }
        if ($row->update(request()->only(['password']))) {
            $row->password_token = '';
            $row->save();
            flash()->success(trans('app.Your password has been changed'));
            return redirect('auth/login');
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }
}
