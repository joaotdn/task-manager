<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $limit_date;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task->task;
        $this->limit_date = date('d/m/Y', strtotime($task->limit_date));
        $this->url = 'http://127.0.0.1:8000/task/' . $task->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-task')
            ->subject('New Task created');
    }
}
