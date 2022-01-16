<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserReportNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $report;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        //
        $this->report   =   $report;
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
        ->subject('রিপোর্ট নোটিফিকেশন')
        ->line($this->report['name']. ' একটি নতুন রিপোর্ট পাঠিয়েছেন।')
        ->action('রিপোর্টটি জানতে ভিজিট করুন', route('report.manage'))
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
            'id'             => $this->report->id,
            'name'           => $this->report->name,
            'created_at'     => $notifiable
        ];
    }
}
