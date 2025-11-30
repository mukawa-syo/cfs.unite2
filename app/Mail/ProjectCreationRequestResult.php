<?php

namespace App\Mail;

use App\Models\ProjectCreationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCreationRequestResult extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $isApproved;

    /**
     * Create a new message instance.
     */
    public function __construct(ProjectCreationRequest $request, bool $isApproved)
    {
        $this->request = $request;
        $this->isApproved = $isApproved;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->isApproved 
            ? 'プロジェクト作成申請が承認されました' 
            : 'プロジェクト作成申請の審査結果について';

        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->to($this->request->user->email)
                    ->subject($subject)
                    ->view('emails.project-creation-request-result');
    }
}
