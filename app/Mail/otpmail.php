<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class otpmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $detail = '';
    public function __construct($detail)
    {
        $this->detail=$detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $detail = $this->detail;
        return $this->view('mail.otp-mail',compact('detail'));
    }
}
