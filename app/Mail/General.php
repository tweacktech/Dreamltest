<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Mail\General;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\Mail;

class General extends Mailable
{
    use Queueable, SerializesModels;

  public $user;
  public $title;
  public $message_body;

    /**
     * Create a new message_body instance.
     *
     * @return void
     */
    public function __construct($user,$title,$message_body)
    {
        $this->user = $user;
        $this->title = $title;
        $this->message_body =$message_body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mail')
                    ->subject('Welcome to Your Application');
    }
}
