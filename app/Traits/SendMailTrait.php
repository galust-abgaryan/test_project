<?php

namespace App\Traits;

use App\Mails\SendMail;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Mail;

trait SendMailTrait
{
    public function sendMail($email, $type, $data)
    {
        $mailTemplate = MailTemplate::where('type', $type)->first();
        if (empty($mailTemplate)) {
            return;
        }
        Mail::to($email)->send(new SendMail($mailTemplate, $data));
    }
}
