<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Exception;
class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {
        $comment = 'Hi, This test feedback.';
        $toEmail = "saumyaa316@gmail.com";
        Mail::to($toEmail)->send(new RegisterMail($comment));
        return 'Email has been sent to '. $toEmail;
        }
        catch(Exception $e)
        {
            error_log($e);
        }
    }
}
