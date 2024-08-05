<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExportReady extends Mailable
{
    use Queueable, SerializesModels;

    protected $filepath;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public function build()
    {
        return $this->view('emails.export_ready')
                    ->subject('Your Financial Data Export is Ready')
                    ->attach(storage_path('app/' . $this->filepath));
    }
}
