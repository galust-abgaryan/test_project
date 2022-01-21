<?php

namespace App\Validators;

use LaraAreaValidator\Rules\UniqueRule;

class UserValidator extends BaseValidator
{
    /**
     * @return array
     */
    public function create()
    {
        return [
            'language' => 'required|max:2',
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'mobile_number' => 'required|max:20',// TODO if need validate by regex or use any package like https://github.com/Propaganistas/Laravel-Phone
            'south_african_id_number' => 'required|max:20',
            'email' => [
                'required',
                'email',
                'max:250',
                $this->customRule(UniqueRule::class, 'users'),
            ],
            'birth_date' => 'date',
            'password' => 'sometimes|required|max:20',
            'with' => [
                'required',
                'array',
                function ($attribute, $value, $fails) {
                    if (empty($value['interests'])) {
                        $fails(__('validation.required', [
                            'attribute' => 'interest'
                        ]));
                        return;
                    }

                    if (!is_array($value['interests'])) {
                        $fails(__('validation.array', [
                            'attribute' => 'Interests'
                        ]));
                        return;
                    }

                    foreach ($value['interests'] as $interest) {
                        if (in_array($interest, config('web.interests'))) {
                            continue;
                        }

                        if (strlen($interest) > 200) {
                            $fails($interest . ' ' . __('validation.max.string', [
                                'attribute' => 'Interests',
                                'max' => 200
                            ]) );
                            return;
                        }
                    }
                }
            ]
        ];
    }
}
