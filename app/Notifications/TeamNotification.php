<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamNotification extends Notification
{
    use Queueable;

    protected array $notificationData;

    public function __construct(array $data)
    {
        $this->notificationData = $data;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return $this->notificationData;
    }

    public function toBroadcast(object $notifiable): array
    {
        return $this->notificationData;
    }
}
