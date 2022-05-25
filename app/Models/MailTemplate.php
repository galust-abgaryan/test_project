<?php

namespace App\Models;

use App\Constants\ConstMailType;

class MailTemplate extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'label',
        'subject',
        'body',
    ];

    /**
     * @var string[]
     */
    protected $paginateable = [
        'type' => [
            'attribute' => 'type_label',
            'label' => 'Type'
        ],
        'label',
        'subject',
    ];

    /**
     * @var string[]
     */
    protected $actions = [
        'edit',
        'show',
    ];

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getTypeLabelAttribute()
    {
       // return humanize(ConstMailType::constants()[$this->type]);
    }
}
