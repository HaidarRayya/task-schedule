<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskStatus extends Mailable
{
    use Queueable, SerializesModels;
    protected $tasks;
    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($tasks, $user)
    {
        $this->tasks = $tasks;
        $this->user = $user;
    }
    public function build()
    {
        return $this->subject('المهام المعلقة')
            ->view('Emails.taskStatus')
            ->with(['tasks' => $this->tasks, 'user' => $this->user]);
    }
}