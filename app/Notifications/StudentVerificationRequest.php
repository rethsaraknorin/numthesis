<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User; // Add this import

class StudentVerificationRequest extends Notification
{
    use Queueable;

    protected $requester;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $requester)
    {
        $this->requester = $requester;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // We want this notification to be stored in the database.
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // This is the data that will be stored in the 'data' column of the notifications table.
        return [
            'requester_id' => $this->requester->id,
            'requester_name' => $this->requester->name,
            'student_id' => $this->requester->student_id,
            'message' => $this->requester->name . ' has requested student verification.',
        ];
    }
}