<?php

namespace App\Mail;

use App\Price;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PriceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $prices = Price::all();
        
        return $this->view('mails.mail')
            ->text('mails.mail')
            ->subject('タイトル')
            ->with([
                'text' => '本文',
            ]);
    }
}