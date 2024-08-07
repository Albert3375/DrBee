<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseOrderGuest extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;

    public function __construct($order, $products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    public function build()
    {
        return $this->view('emails.purchase_order_guest')
                    ->with([
                        'order' => $this->order,
                        'products' => $this->products,
                    ])
                    ->attach(public_path('orders/Orden_de_Compra_' . $this->order->id . '.pdf'));
    }
}
