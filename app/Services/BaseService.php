<?php

namespace App\Services;

use \LaraAreaAdmin\Services\AdminService;

class BaseService extends AdminService
{
    /**
     * @param $data
     * @return mixed
     */
    protected function fixDataForCreate($data)
    {
        return $data;
    }

    /**
     * @param $item
     * @param $data
     * @return mixed
     */
    protected function fixDataForUpdate($item, $data)
    {
        return $data;
    }
}
