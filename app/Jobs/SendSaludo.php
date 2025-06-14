<?php

namespace App\Jobs;

use App\Mail\EmailSaludo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSaludo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */



    public function __construct(public $contenido, public $email)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->bcc("administrador@cscdeveloper.com")->send(new EmailSaludo($this->contenido));
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
