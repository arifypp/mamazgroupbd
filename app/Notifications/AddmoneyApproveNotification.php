<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddmoneyApproveNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $moneyUpdate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($moneyUpdate)
    {
        //
        $this->moneyUpdate = $moneyUpdate;
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
            ->subject('পেমেন্ট রিকুয়েস্ট এ্যাপ্রুভ করা হয়েছে!')
            ->line('স্বাগতম আপনাকে আপনার ৳'.$this->moneyUpdate['amount']. ' টাকার রিকুয়েস্ট মামাজ টিম এ্যাপ্রুভ করেছে।')
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
            'id'            => $this->moneyUpdate->id,
            'amount'          => $this->moneyUpdate->amount,
            'created_at'    => $notifiable
        ];
    }
}
