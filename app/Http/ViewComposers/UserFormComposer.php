<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class UserFormComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $languages = $this->getList('languages');
        $interests = $this->getList('interests');
        if ($view->offsetExists('item')) {
            /* @var User $user*/
            $user = $view->offsetGet('item');
            $userInterests = $user->userInterests()->pluck('interest')->toArray();
            $interests = $this->mergeInterests($interests, $userInterests);

            // for show old selected interests
            $user->setAttribute('with', [
                'interests' => $userInterests
            ]);
        }

        // for not lost user manually added new interests when happen same validation error
        $oldInputs = old('with.interests');
        if ($oldInputs && is_array($oldInputs)) { // is array checked for form attack case avoid php exception
            $interests = $this->mergeInterests($interests, $oldInputs);
        }

        $view->with(compact('languages', 'interests'));
    }

    /**
     * @param $interests
     * @param $dynamic
     * @return array
     */
    protected function mergeInterests($interests, $dynamic)
    {
        $missing = array_diff($dynamic, array_keys($interests));
        $missing = array_combine($missing, $missing);
        return array_merge($interests, $missing);
    }

    /**
     * @param $path
     * @return array
     */
    public function getList($path)
    {
        $list = [];
        foreach (config('web.' . $path, []) as $item) {
            $langPath = sprintf('web.%s.%s', $path, $item);
            $list[$item] = Lang::has($langPath) ? __($langPath) : humanize($item);
        }
        return $list;
    }
}
