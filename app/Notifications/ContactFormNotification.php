<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $data)
    {
      $this->user = $user;
      $this->data = $data;
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
        $name = $this->data->name;
        $phone = $this->data->phone;
        $email = $this->data->email;
        $subject = $this->data->subject;
        $message = $this->data->message;

        return (new MailMessage)
        ->from('ventas@Zoofish.com.mx', 'Zoofish')
        ->subject('Formulario de Contacto')
        ->markdown('notifications.contact_form',
            [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ]
        );
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
