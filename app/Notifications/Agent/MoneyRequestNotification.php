<?php

namespace App\Notifications\Agent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MoneyRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $moneyadd;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($moneyadd)
    {
        //
        $this->moneyadd    =    $moneyadd;
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
        ->subject('পেমেন্ট রিকুয়েস্ট!')
        ->line('আপনাকে ৳'.$this->moneyadd['amount']. ' টাকার রিকুয়েস্ট পাঠিয়েছেন।')
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
            'id'                => $this->moneyadd->id,
            'amount'          => $this->moneyadd->amount,
            'created_at'    => $notifiable
        ];
    }
}
