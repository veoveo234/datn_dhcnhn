<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCheckout extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $user, $order_detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $user, $order_detail)
    {
        $this->order = $order;
        $this->user = $user;
        $this->order_detail = $order_detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('User/pages/email.sendmail-checkout');
    }
}
