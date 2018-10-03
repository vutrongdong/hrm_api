<?php

namespace App;

use App\Repositories\Entity;
use App\Repositories\Users\FilterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\Users\PresentationTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class User extends Entity implements AuthenticatableContract, AuthorizableContract {
	use Authenticatable, Authorizable, HasApiTokens, FilterTrait, PresentationTrait;

	const FEMALE 	= 0;
	const MALE 		= 1;
	const OTHER 	= 2;

	const ALL_GENDER = [
		self::FEMALE,
		self::MALE,
		self::OTHER,
	];
	const DISPLAY_GENDER = [
		self::FEMALE 	=> 'Nữ',
		self::MALE 		=> 'Nam',
		self::OTHER 	=> 'Khác',
	];

	const DISABLE 	= 0;
	const ENABLE	= 1;

	const ALL_STATUS = [
		self::DISABLE,
		self::ENABLE,
	];
	const DISPLAY_STATUS = [
		self::DISABLE 	=> 'Không kích hoạt',
		self::ENABLE 	=> 'Kích hoạt',
	];

	public $avatarPath = 'storage/images/users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'qualification',
		'address',
		'phone',
		'gender',
		'date_of_birth',
		'email',
		'avatar',
		'status',
		'password',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

	protected $date = ['deleted_at'];

	public static function boot() {
		parent::boot();

		self::created(function ($model) {
			$model->code = hashid_encode($model->id);
			$model->save();
		});
	}

	public function setPasswordAttribute($value) {
		$this->attributes['password'] = app('hash')->make($value);
	}

	/**
	 * Relationship with Role
	 */
	public function roles() {
		return $this->belongsToMany(\App\Repositories\Roles\Role::class, 'role_users');
	}

	public function departments() {
		return $this->belongsToMany(\App\Repositories\Departments\Department::class, 'department_user')->withPivot(['position_id', 'status']);
	}

	public function positions() {
		return $this->belongsToMany(\App\Repositories\Positions\Position::class, 'department_user')->withPivot(['department_id', 'status']);
	}

	public function contracts() {
		return $this->hasMany(\App\Repositories\Contracts\Contract::class);
	}

	public function candidates() {
		return $this->belongsToMany(\App\Repositories\Candidates\Candidate::class, 'interview', 'interview_by', 'candidate_id');
	}

	public function validateForPassportPasswordGrant($password) {
		if ($password == $this->password || app('hash')->check($password, $this->password)) {
			return true;
		}

		return false;
	}

	public function findForPassport($username) {
		if (stripos($username, '@')) {
			return $this->where('email', $username)->first();
		} else {
			return $this->where('phone', $username)->first();
		}
	}
}
