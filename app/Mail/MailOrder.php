<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $orderdetail;
    public $date;
    public function __construct($order, $orderdetail, $date)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd('trong', $this->order, $this->orderdetail);
        return $this->view('template.mailorder')->with(['order' => $this->order, 'orderdetial' => $this->orderdetail, 'date' => $this->date]);
    }
}
