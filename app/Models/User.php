<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use SoftDeletes,
        \Laravel\Scout\Searchable,
        \App\Models\Traits\HasAttach,
        \App\Models\Traits\HasGenericMutator,
        HasFactory;

    protected $attributes = [
        'confirmed' => 0,
        'is_active' => 1,
    ];
    protected $table = "users";
    protected $guarded = [
        'deleted_at',
        'image',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'confirm_token',
        'password_token',
        'confirmed',
        'is_active',
        'created_by',
        'updated_at',
        'deleted_at',
    ];
    static $attachFields = [
        'image' => [
            'sizes' => ['large' => 'resize,300x300', 'small' => 'crop,150x150'],
        ],
        'video' => [
            'path' => 'uploads',
        ],
    ];
    public $rules = [
        'type' => 'required|in:guest,admin',
        'name' => 'required|min:4',
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'mobile' => 'required|mobile|unique:users,mobile,NULL,id,deleted_at,NULL',
        'password' => 'required|confirmed|min:8',
    ];
    public $edit = [
        'name' => 'required|min:4',
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'mobile' => 'required|mobile|unique:users,mobile,NULL,id,deleted_at,NULL',
        'image' => 'nullable|image|max:4000'
    ];

    public $loginRules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
        'push_token' => 'nullable|min:4',
    ];
    public $forgotRules = [
        'email' => 'required|email',
    ];
    public $resetRules = [
        'password' => 'required|confirmed|min:8',
    ];
    public $changePassword = [
        'old_password' => 'required|min:8',
        'password' => 'required|confirmed|min:8',
    ];

    public function toSearchableArray() {
        $array = [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];
        return $array;
    }

    public static function boot() {
        parent::boot();
        static::created(function ($row) {
            if (!app()->environment('testing')) {
                \App\Jobs\UserCreated::dispatch($row);
            }
        });
    }

    public function register() {
        $token = generateToken(request('email'));
        request()->request->add([
            'confirm_token' => md5(request('email')) . RandomString(10) . md5(time()),
            'token' => $token,
            'image' => resizeImage(resource_path() . '/images/users/avatar.png', \App\Models\User::$attachFields['image']['sizes']),
            'confirmed' => env('USER_CONFIRMED')
        ]);
        if ($row = \App\Models\User::create(request()->except(['password_confirmation', 'accept']))) {
            return $row;
        }
    }

    /*************** Relationships ******************/

    public function push_tokens() {
        return $this->hasMany(PushToken::class, 'created_by');
    }

    public function includes() {
        return $this;
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /*************** Scopes ******************/
    public function scopeFilterAndSort() {
        return $this->includes()
            ->when(request('type'), function ($q) {
                return $q->where('type', request('type'));
            })
            ->when(request('name'), function ($q) {
                return $q->where('name', 'LIKE', '%' . trim(request('name')) . '%');
            })
            ->when(request('email'), function ($q) {
                return $q->where('email', 'LIKE', '%' . trim(request('email')) . '%');
            })
            ->when(request('mobile'), function ($q) {
                return $q->where('mobile', 'LIKE', '%' . trim(request('mobile')) . '%');
            })
            ->notSuperAdmin()
            ->when(request('order_field'), function ($q) {
                return $q->orderBy((request('order_field')), (request('order_type')) ?: 'desc');
            })
            ->orderBy('id', 'desc');
    }

    public function scopeActive($query) {
        return $query->where('is_active', '=', 1)
            ->where('confirmed', 1);
    }

    public function scopeAdmin($query) {
        return $query->where('type', '=', 'admin');
    }

    public function scopeGuest($query) {
        return $query->where('type', '=', 'guest');
    }

    /*************** Accessors ******************/

    public function setPasswordAttribute($value) {
        if (trim($value)) {
            $this->attributes['password'] = bcrypt(trim($value));
        }
    }

    public function export($rows, $fileName) {
        return (new \Rap2hpoutre\FastExcel\FastExcel($rows))
            ->download($fileName . "_" . date("Y-m-d H:i:s") . '.xlsx', function ($row) {
                return [
                    'ID' => $row->id,
                    'Type' => $row->type,
                    'Name' => $row->name,
                    'Email' => $row->email,
                    'Mobile' => $row->mobile,
                    'Created at' => @$row->created_at,
                ];
            });
    }

    public function updateToken($row) {
        $row->token = generateToken($row->email);
        $row->save();
        request()->headers->set('Authorization', 'Bearer ' . $row->token);
    }

}
