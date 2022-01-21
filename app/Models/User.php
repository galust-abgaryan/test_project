<?php

namespace App\Models;

use LaraAreaModel\AreaAuth;

class User extends AreaAuth
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language',
        'name',
        'surname',
        'mobile_number',
        'south_african_id_number',
        'email',
        'birth_date',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $actions = [
        'edit',
        'show',
        'destroy',
    ];

    /**
     * @var array
     */
    protected $paginateable = [
        'name' => [
            'search' => true,
        ],
        'surname' => [
            'search' => true
        ],
        'mobile_number' => [
            'search' => true
        ],
        'language' => [
            'attribute' => 'language_label',
            'label' => 'Language'
        ],
        'south_african_id_number' => [
            'search' => true
        ],
        'email' => [
            'search' => true
        ],
        'birth_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userInterests()
    {
        return $this->hasMany(UserInterest::class);
    }

    /**
     * @param $attribute
     */
    public function setPasswordAttribute($attribute)
    {
        $this->attributes['password'] = bcrypt($attribute);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getLanguageLabelAttribute()
    {
        return __('web.languages.' . $this->language);
    }
}
