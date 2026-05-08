<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Session;
use \Cart as Cart;

class OrderConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $oId;
    public $firstName;
    public $lastName;
    public $oItems;
    public $totalAmount;
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function __construct($oId, $firstName, $lastName, $oItems, $totalAmount)
    {
        $this->oId = $oId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->oItems = $oItems;
        $this->totalAmount = $totalAmount;
    }
    
    public function build()
    {
        return $this->subject('Buzytown Order Confirmation')->view('Emails.order_confirmation_email');
    }
}
