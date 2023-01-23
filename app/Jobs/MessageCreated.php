<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $row;

    public function __construct($row) {
        $this->row = $row;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        if (app()->environment() != 'testing' && !app()->runningInConsole()) {
            if ($row = $this->row) {
                try {
                    \Mail::send('emails.messages.create', ['row' => $row], function ($mail) use ($row) {
                        $subject =appName().' - '.trans('email.Contact us message');
                        $mail->to(conf('contact_email'), conf('app_name'))
                            ->subject($subject);
                    });
                } catch (\Exception $e) {
                    \Log::error('Error: ' . $e->getMessage() . ', File: ' . $e->getFile() . ', Line:' . $e->getLine() . PHP_EOL);
                }
            }
        }
    }

}
