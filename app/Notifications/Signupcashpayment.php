<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Signupcashpayment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cash;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cash)
    {
        //
        $this->cash = $cash;
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
        ->subject('সাইনআপ পেমেন্ট নোটিফিকেশন')
        ->line($notifiable->name. ' আপনার ১৭১ টাকার পেমেন্টটি এপ্রুভ করা হয়েছে। যদি এখন পর্যন্ত আপনার ই-মেইল ভেরিফাই করে না থাকেন, অনুগ্রহ করা ভেরিফাই করে ফেলুন।')
        ->action('বিস্তারিত জানতে দেখুন', route('homepage'))
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
