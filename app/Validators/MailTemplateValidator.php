<?php

namespace App\Validators;

use App\Constants\ConstMailTypeTags;
use Illuminate\Support\Str;
use LaraAreaSupport\Arr;

class MailTemplateValidator extends BaseValidator
{
    /**
     * @return array
     */
    public function update()
    {
        return [
            'label' => 'required',
            'subject' => 'required',
            'body' => [
                'required',
                function ($attribute, $value, $fails) {
                    $requiredTags = ConstMailTypeTags::getRequiredTags($this->data['type']);
                    $requiredWithoutTags = ConstMailTypeTags::getRequiredWithoutTags($this->data['type']);
                    $missingTags = [];
                    foreach ($requiredTags as $tag) {
                        if (! Str::contains($value, [$tag])) {
                            $missingTags[] = $tag;
                        }
                    }
                    foreach ($requiredWithoutTags as $tag => $with) {
                        $with = Arr::wrap($with);
                        $with[] = $tag;
                        if (! Str::contains($value, $with)) {
                            $fails(__('validation.mail_template.required_with_tags', ['tags' => implode(', ', $with)]));
                        }
                    }

                    if ($missingTags) {
                        $fails(__('validation.mail_template.required_tags', ['tags' => implode(', ', $missingTags)]));
                    }

                }
            ],
        ];
    }
}
