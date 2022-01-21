<?php

use App\Constants\ConstMailType;

class MailTemplatesTableSeeder extends BaseSeeder
{
    /**
     * @return array
     */
    public function getData() :array
    {
        return [
            [
                'id' => 1,
                'label' => 'Send user created email',
                'type' => ConstMailType::USER_CREATED,
                'subject' => 'User Created',
                'body' => '
<p>Dear [name] you are capturing for Our Test User Crud platform</p>
<table>
    <tbody>
        <tr>
            <td>Surname</td>
            <td>[surname]</td>
        </tr>
        <tr>
            <td>South African Id Number</td>
            <td>[south_african_id_number]</td>
        </tr>
        <tr>
            <td>Mobile Number</td>
            <td>[mobile_number]</td>
        </tr>
        <tr>
            <td>Email Address</td>
            <td>[email]</td>
        </tr>
        <tr>
            <td>Birth Date</td>
            <td>[birth_date]</td>
        </tr>
        <tr>
            <td>Language</td>
            <td>[language]</td>
        </tr>
    </tbody>
</table>
<p>Best regards,</p>
<p>Developer</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }
}
