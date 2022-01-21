<?php

namespace App\Constants;

use LaraAreaSupport\Constant;

class ConstMailTypeTags extends Constant
{
    /**
     *
     */
    const TAGS = [
        ConstMailType::USER_CREATED => [
            'name' => [
                'required' => true,
            ],
            'surname',
            'south_african_id_number',
            'mobile_number',
            'email',
            'birth_date',
            'language',
        ],
    ];

    /**
     * @param $type
     * @return array
     */
    public static function getTags($type)
    {
        $tags = self::TAGS[$type] ?? [];
        $response = [];

        foreach ($tags as $tag => $config) {
            if (is_numeric($tag)) {
                $tag = $config;
                $config = [];
            }
            $response[self::wrapTag($tag)] = $config['attribute'] ?? $tag;
        }

        return $response;
    }

    /**
     * @param $type
     * @return array
     */
    public static function getRequiredTags($type)
    {
        $tags = self::TAGS[$type] ?? [];
        $response = [];

        foreach ($tags as $tag => $config) {
            if (! empty($config['required'])) {
                $response[] = self::wrapTag($config['attribute'] ?? $tag);
            }
        }

        return $response;
    }

    /**
     * @param $type
     * @return array
     */
    public static function getRequiredWithoutTags($type)
    {
        $tags = self::TAGS[$type] ?? [];
        $response = [];

        foreach ($tags as $tag => $config) {
            if (! empty($config['required_without'])) {
                $response[self::wrapTag($tag)] = self::wrapTag($config['required_without']);
            }
        }

        return $response;
    }

    /**
     * @param $tag
     * @return string
     */
    public static function wrapTag($tag)
    {
        return '[' . $tag . ']';
    }
}
