<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;



use Illuminate\Mail\Mailables\Address;
//use Illuminate\Mail\Mailables\Envelope;




class MailPreregistro extends Mailable
{
    use Queueable, SerializesModels;

    public $title, $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string  $body)
    {
         $this->title = $title;

         $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        

        return $this->view('mail.testmail');
        //->with('title', $this->title);    //was this unnecsary?
    }
    





    public function content():Content
    {
        
        return new Content(
           // view: 'emails.preregistro',
           // with: ['title' => $this->title, 'body' => $this->body],
           // with: ['body' => $this->body],
        );
    }

    
    public function envelope(): Envelope
    {  
        return new Envelope(
           // subject: 'My Test Email',
        );
    }


/*
    public function envelope()
{
   return new Envelope(
       //from: new Address('example@example.com', 'Test Sender'),
       //subject: 'Test Email',
   );
}*/
}
