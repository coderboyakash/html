<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'message' => $this->data['message'],
        );
        return $this->from('sales@vapeunderground.co.uk')->subject('Contact')->view('user.contact', compact('data'));
    }
}
