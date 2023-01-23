<?php

namespace App\Http\Controllers;


class ProfileController extends \App\Http\Controllers\Controller {

    public function __construct(\App\Models\User $model) {
        $this->module = 'profile';
        $this->title = trans('app.Profile');
        $this->model = $model;
        $this->edit = $model->edit;
        $this->changePassword = $model->changePassword;
    }

    public function getEdit() {
        $data['page_title'] = trans('app.Edit account');
        $data['row'] = $this->model->findOrFail(auth()->user()->id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit() {
        $row = $this->model->findOrFail(auth()->user()->id);
        $rules = $this->edit;
        $rules['email'] = 'required|email|unique:users,email,' . $row->id . ',id,deleted_at,NULL';
        $rules['mobile'] = 'required|mobile|unique:users,mobile,' . $row->id . ',id,deleted_at,NULL';
        $this->validate(request(), $rules);
        if ($row->update(request()->all())) {
            flash()->success(trans('app.Update successfully'));
            return back();
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }

    public function getProfile() {
        $data['page_title'] = trans('app.Edit profile');
        $data['row'] = $this->model->findOrFail(auth()->user()->id);
        return view($this->module . '.profile', $data);
    }

    public function getChangePassword() {
        $data['page_title'] = $this->title . ' - ' . trans('app.Change password');
        $data['row'] = $this->model->findOrFail(auth()->user()->id);
        return view($this->module . '.change-password', $data);
    }

    public function postChangePassword() {
        $row = $this->model->findOrFail(auth()->user()->id);
        $this->validate(request(), $this->changePassword);
        if (!\Hash::check(request('old_password'), $row->password)) {
            flash()->error(trans('app.Entered password is not matching your old password'));
            return back();
        }
        if ($row->update(request()->except(['password_confirmation', 'old_password']))) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }
        flash()->error(trans('app.Failed to handle your request'));
        return back();
    }

    public function getLogout() {
        auth()->logout();
        session()->flush();
        flash(trans('app.Log out successfully'))->success();
        return redirect('auth/login');
    }
}
