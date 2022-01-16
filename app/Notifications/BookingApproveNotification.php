<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingApproveNotification extends Notification
{
    use Queueable;
    protected $bookings;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bookings)
    {
        //
        $this->bookings  = $bookings;

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
            ->line($this->bookings['name']. ' এর বুকিং এপ্রুভ করা হয়েছে । আপনার বুকিং নাম্বার: '. $this->bookings['bookingid'])
            ->action('বর্তমান অবস্থা জানতে ভিজিট করুন', route('booking.list'))
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
            'id'             => $this->bookings->id,
            'bookingauthid'  => $this->bookings->name,
            'flatvalue'      => $this->bookings->flatvalue,
            'created_at'     => $notifiable
        ];
    }
}
