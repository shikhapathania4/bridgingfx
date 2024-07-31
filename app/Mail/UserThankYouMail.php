<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactUs;

class UserThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(ContactUs $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->view('emails.user-thank-you')
                    ->from('tanujapathania333@gmail.com', 'BridgingFx')
                    ->subject('Thank you for contacting us')
                    ->with([
                        'logoUrl' => "https://menow.b-cdn.net/logo.png",

                        'submission' => $this->submission
                    ]);
    }
}
