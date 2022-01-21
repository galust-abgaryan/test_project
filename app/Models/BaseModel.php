<?php

namespace App\Models;

use LaraAreaModel\AreaModel;

class BaseModel extends AreaModel
{
    /**
     * @var string[]
     */
    protected $actions = [
        'edit',
        'show',
        'destroy',
    ];
}
