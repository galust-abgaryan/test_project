<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::id()) {
            flash(__('users.you_can_not_delete_yourself'), 'danger');
            return  redirect()->back();
        }
        return parent::destroy($id);
    }
}
