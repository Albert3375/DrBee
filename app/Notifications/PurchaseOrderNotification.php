<?php

namespace App\Notifications;

use App\Models\Adress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $products, $order)
    {
        $this->user = $user;
        $this->products = $products;
        $this->data = $order;
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
        // $address = Adress::find($this->data->address_id);
        // dd($this->user);
        $name = $this->user->name;
        $billing_address = $address->street.' ' .$address->numberExt.' '.$address->numInt.' '.$address->col;
        $city = $address->municipality;
        $zipcode = $address->postalCode;
        $phone = $this->user->phone;
        $email = $this->user->email;
        $payment_method = $this->data->payment_method;

        $products = $this->products;

        $order = $this->data;

        $storagePath = 'orders/';
        $path = public_path() . '/' . $storagePath;

        return (new MailMessage)
        ->from('ventas@Zoofish.com.mx', 'Zoofish')
        ->subject('[Zoofish] Nuevo pedido #('.$order->id.')')
        ->markdown('notifications.purchase_order',
            [
                'name' => $name,
                'billing_address' => $billing_address,
                'city' => $city,
                'zipcode' => $zipcode,
                'phone' => $phone,
                'email' => $email,
                'payment_method' => $payment_method,
                'user' => $this->user,
                'products' => $products,
                'total' => $this->data->total,
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
