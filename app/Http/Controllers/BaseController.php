<?php

namespace App\Http\Controllers;

use \LaraAreaAdmin\Controllers\AdminController;

class BaseController extends AdminController
{
    /**
     * @var string
     */
    protected $viewRoot = 'web';

    /**
     * @var string
     */
    protected $layout = 'app';
}
