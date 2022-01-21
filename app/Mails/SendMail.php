<?php

namespace App\Mails;

use App\Models\MailTemplate;
use App\Constants\ConstMailTypeTags;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    public $data;

    /**
     * @var MailTemplate
     */
    public $mailTemplate;

    /**
     * @param MailTemplate $mailTemplate
     * @param array $data
     */
    public function __construct(MailTemplate $mailTemplate, array $data)
    {
        $this->data = $data;
        $this->mailTemplate = $mailTemplate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->prepareContent();
        return $this->from(config('mail.from.address'), config('mail.from.name'))->view('mails.layout', compact('content'))->subject($this->mailTemplate->subject);
    }

    /**
     * @return array|mixed|string|string[]
     */
    public function prepareContent()
    {
        $body = $this->mailTemplate->body;
        $tags = ConstMailTypeTags::getTags($this->mailTemplate->type);
        foreach ($tags as $tag => $path) {
            $value = $this->data[$path] ?? '';
            if (!is_string($value)) {
                if(is_array($value))  {
                    if (!empty($value['Name'])) {
                        $value = $value['Name'];
                    }
                }
            }
            if (!is_string($value) && !is_numeric($value)) {
                $value = '';
            }

            $body = str_replace($tag, $value, $body);
        }

        return $body;
    }
}
