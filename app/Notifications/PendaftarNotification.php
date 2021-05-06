<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\pesans\Mailpesan;
use Illuminate\Notifications\Notification;

class PendaftarNotification extends Notification
{
    use Queueable;

    protected $judul, $pesan, $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($judul, $pesan, $url = '#')
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
        $this->url   = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\pesans\Mailpesan
     */
    public function toMail($notifiable)
    {
        return (new Mailpesan)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'judul' => $this->judul,
            'pesan' => $this->pesan,
            'url'   => $this->url,
        ];
    }
}
