<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newsletter extends Mailable
{
    use Queueable, SerializesModels;
    
    public $ads;

    public function __construct($ads)
    {
        $this->ads=$ads;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('affiche');
    }
}
