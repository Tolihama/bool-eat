<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOrderMailToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    private $restaurant_name;
    private $transaction_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($restaurant_name, $transaction_id)
    {
        $this->restaurant_name = $restaurant_name;
        $this->transaction_id = $transaction_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.confirm_order_to_customer')
                    ->with([
                        'restaurant_name' => $this->restaurant_name,
                        'transaction_id' => $this->transaction_id,
                    ]);
    }
}
