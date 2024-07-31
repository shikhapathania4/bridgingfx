<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactUs;

class AdminResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(ContactUs $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->view('admin.response')
                    ->from('tanujapathania333@gmail.com', 'BridgingFx')
                    ->subject('Response On Contact Us Submission')
                    ->with(['submission' => $this->submission]);
    }
}
