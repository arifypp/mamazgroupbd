<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawAccept extends Notification implements ShouldQueue
{
    use Queueable;

    protected $withdrawaccpet;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($withdrawaccpet)
    {
        //
        $this->withdrawaccpet   =   $withdrawaccpet;
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
            ->subject('উইথড্রে এপ্রেুাভ হয়েছে!!!')
            ->line($this->withdrawaccpet['amount']. ' টাকার উইথড্র এপ্রেুাভ হয়েছে। অনুগ্রহ করে মামাজের ড্যাশবোর্ডের চেক করুন।')
            ->action('বিস্তারিত জানতে ক্লিক করুন', route('withdraw.manage'))
            ->line('ভালবাসা অবিরাম মামাজের সঙ্গে থাকার জন্য!');
    }

}
