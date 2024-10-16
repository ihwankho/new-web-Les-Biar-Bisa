<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuizNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     */

    public $notificationTitle;
    public $type;

    public function __construct($type, $notificationTitle)
    {
        $this->type = $type;
        $this->notificationTitle = $notificationTitle;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Notifications New $this->type")
            ->view('emails.quiz-notification')
            ->with([
                'notificationTitle' => $this->notificationTitle,
                'type' => $this->type,
            ]);
    }
}
