<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationApproved extends Notification implements ShouldQueue
{
    use Queueable;
    protected $application;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        //
        $this->application  =   $application;
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
        ->subject('আবেদন এপ্রুভ নোটিফিকেশন')
        ->line($this->application['name']. ' আপনার আবেদনটি এপ্রুভ করা হয়েছে। আপনি আগামিকাল থেকে মামাজের সাঙ্গে আপনার নতুন যাত্রা শুরু করতে পারেন।')
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
