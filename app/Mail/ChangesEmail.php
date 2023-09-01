<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

use Exception;


class ChangesEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Portfolio Change Notice';
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
        try {
           
            $dataE = $this->data;
            return $this->view('mail.mailbody',compact('dataE'));
        } catch (Exception $e) {
            
            info('Este error es de la TimerEmail'.$e->getMessage());
        }
       
    }
}
