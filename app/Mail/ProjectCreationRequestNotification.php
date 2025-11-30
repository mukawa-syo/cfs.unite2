<?php

namespace App\Mail;

use App\Models\ProjectCreationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCreationRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     */
    public function __construct(ProjectCreationRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->to('uknight.sc@hachiouji-uknight.com')
                    ->subject('新しいプロジェクト作成申請が届きました')
                    ->view('emails.project-creation-request-notification');
    }
}
