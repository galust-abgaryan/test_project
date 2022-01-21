<?php

namespace App\Listeners;

use App\Constants\ConstMailType;
use App\Events\UserCreated;
use App\Traits\SendMailTrait;
use Illuminate\Contracts\Queue\ShouldQueue;

class SenUserCreatedEmail implements ShouldQueue
{
    use SendMailTrait;

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->getUser();
        $data = $user->toArray();
        $data['language'] = $user->language_label;
        $this->sendMail($user->email, ConstMailType::USER_CREATED, $data);
    }
}
