<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reset extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string the address to send the email */
    protected $toAddress;

    /** @var string reset code */
    protected $resetCode;

    /**
     * Create a new message instance.
     *
     * @param string $toAddress the address to send the email
     * @param string $resetCode
     *
     * @return void
     */
    public function __construct(string $toAddress,string $resetCode)
    {
        $this->toAddress = $toAddress;
        $this->resetCode = $resetCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->toAddress)
            ->subject('Password reset request')
            ->view('emails.reset')
            ->with(
                [
                    'resetCode' => $this->resetCode,
                ]
            );
    }
}
