<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Listcoins extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

     /**
     * The contact instance.
     *
     * @var Contact
     */
    protected $listcoin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($listcoin)
    {
        $this->listcoin = $listcoin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.listcoin')
                    ->with([
                        'coinname' => $this->listcoin->coinname,
                        'ticker' => $this->listcoin->ticker,
                        'website' => $this->listcoin->website,
                        'medialink' => $this->listcoin->medialink,
                        'etherumaddress' => $this->listcoin->etherumaddress,
                        'extrainfo' => rawurldecode($this->listcoin->extrainfo),
                        'signature' => '<p>Regards</p>Peetradex Team'
                    ]);
    }
}
