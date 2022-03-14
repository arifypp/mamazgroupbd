<?php

namespace App\Notifications\Agent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MoneyApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $moneaccept;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($moneaccept)
    {
        //
        $this->moneaccept   = $moneaccept;
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
        return (new MailMessage)
        ->greeting('হ্যালো! ' .$notifiable->name)
        ->subject('পেমেন্ট রিকুয়েস্ট এ্যাপ্রুভ!')
        ->line('আপনার ৳'.$this->moneaccept['amount']. ' টাকার পেমেন্ট রিকুয়েস্ট এ্যাপ্রুভ করা হয়েছে। অনুগ্রহ করে আপনার মামাজ ব্যালেন্স চেক করুন।')
        ->action('বর্তমান অবস্থা জানতে ভিজিট করুন', route('agent.addmoney'))
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
        ];
    }
}
