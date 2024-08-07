<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderGuest extends Notification
{
    use Queueable;

    private $order;
    private $products;

    public function __construct($order, $products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath . 'Orden de Compra - ' . $this->order->id . '.pdf';

        return (new MailMessage)
            ->from('ventas@Zoofish.com.mx', 'Zoofish')
            ->subject('[Zoofish] Nuevo pedido #(' . $this->order->id . ')')
            ->markdown('notifications.purchase_order_guest', [
                'order' => $this->order,
                'products' => $this->products
            ])
            ->attach($path);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

