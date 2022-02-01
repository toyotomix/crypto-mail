<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrentPrices extends Mailable
{
    use Queueable, SerializesModels;

    // コイン
    protected $coins;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coins)
    {
        $this->coins = $coins;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail')
            ->text('mails.mail')
            ->subject('暗号通貨 価格配信サービス')
            ->with([
                'coins' => $this->coins,
            ]);
    }
}
