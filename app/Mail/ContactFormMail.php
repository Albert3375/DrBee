<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactFormMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.contact-form')
            ->subject($this->data->input('subject'))
            ->from('Zoofish@gmail.com', ' Zoofish') // C
            ->with([
                'subject' => $this->data->input('subject'),
                'title' => 'Título personalizado',
                'content' => $this->data->input('message'),
            ]);
    }
}
