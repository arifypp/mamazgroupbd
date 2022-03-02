<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        //
        return $this->contact   =   $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('হ্যালো! ' .$notifiable->name)
            ->subject('নতুন ব্যবহারকারী যোগাযোগ করেছেন!')
            ->line($this->contact['name']. ' মামাজের সাথে যোগাযোগ করেছে। অনুগ্রহ করে যথাসময়ে তাহার  সাথে মামাজের কর্তৃপক্ষের যোগাযোগ করতে অনুরোধ করা যাচ্ছে।')
            ->action('বর্তমান অবস্থা জানতে ভিজিট করুন', route('contact.manage'))
            ->line('ভালবাসা অবিরাম মামাজের সঙ্গে থাকার জন্য!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            //
            'id'            => $this->contact->id,
            'name'          => $this->contact->name,
            'email'         => $this->contact->email,
            'created_at'    => $notifiable
        ];
    }
}
