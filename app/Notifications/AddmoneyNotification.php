<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddmoneyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $addMoney;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($addMoney)
    {
        //
        $this->addMoney =   $addMoney;
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
            ->subject('নতুন মামাজ পয়সা পেমেন্ট রিকুয়েস্ট!')
            ->line($this->addMoney['amount']. ' টাকার একটি নতুন পেমেন্ট রিকুয়েস্ট েএসেছে। অনুগ্রহ করে মামাজ কর্তৃপক্ষকে বিষয়টি পর্যবেক্ষন করার অনুরোধ করা যাচ্ছে। ')
            ->action('বর্তমান অবস্থা জানতে ভিজিট করুন', route('contact.manage'))
            ->line('ভালবাসা অবিরাম মামাজের সঙ্গে থাকার জন্য!');
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
            'id'            => $this->addMoney->id,
            'amount'          => $this->addMoney->amount,
            'created_at'    => $notifiable
        ];
    }
}
