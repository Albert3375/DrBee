<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderGuest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order;
    private $products;
    public function __construct($order,$products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->order);
        // $address = Adress::find($this->data->address_id);
        // dd($this->user);

        $order = $this->order;

        $fname = $this->order->fname;
        $lname = $this->order->lname;
        $billing_address = $this->order->billing_address;
        $city = $this->order->municipality;
        $zipcode = $this->order->zipcode;
        $phone = $this->order->phone;
        $email = $this->order->email;
        $payment_method = $this->order->payment_method;
        $total = $this->order->total;

        $products = json_decode($this->order->products);

        // dd($products);

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        return (new MailMessage)
            ->from('ventas@Zoofish.com.mx', 'Zoofish')
            ->subject('[Zoofish] Nuevo pedido #('.$this->order->id.')')
            ->markdown('notifications.purchase_order_guest',
                [
                    'fname' => $fname,
                    'lname'=>$lname,
                    'billing_address' => $billing_address,
                    'city' => $city,
                    'zipcode' => $zipcode,
                    'phone' => $phone,
                    'email' => $email,
                    'payment_method' => $payment_method,
                    'products' => $products,
                    'total' => $total,
                ]
        )
        ->attach($path.'Orden de Compra - '.$order->id.'.pdf');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
