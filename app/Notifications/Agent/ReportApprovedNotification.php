<?php

namespace App\Notifications\Agent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reports;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reports)
    {
        //
        $this->reports = $reports;
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
        ->subject('রিপোর্ট এ্যাপ্রুভ')
        ->line($this->reports['name']. ' আপনার রিপোর্টটি এ্যাপ্রুভ করা হয়েছে।')
        ->action('রিপোর্ট সম্পর্কে জানতে ক্লিক করুন', route('homepage'))
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
            'id'                => $this->reports->id,
            'name'              => $this->reports->name,
            'created_at'        => $notifiable
        ];
    }
}
