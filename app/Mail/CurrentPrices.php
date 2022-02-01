<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrentPrices extends Mailable
{
    use Queueable, SerializesModels;

    // コイン名称
    protected $coin_name;

    // 価格
    protected $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coin_name, $price)
    {
        $this->coin_name = $coin_name;
        $this->price = $price;
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
            ->subject('CRYPTO MAIL 価格のお知らせ')
            ->with([
                'coin' => $this->coin_name,
                'price' => $this->price,
            ]);
    }
}
