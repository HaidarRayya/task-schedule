<?php

namespace App\Jobs;

use App\Mail\TaskStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tasks;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $tasks)
    {
        $this->user = $user;
        $this->tasks = $tasks;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TaskStatus($this->tasks,   $this->user));
    }
}