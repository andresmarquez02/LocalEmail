<?php

namespace App\Listeners;

use App\Email as AppEmail;
use App\Events\Email;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Email  $event
     * @return void
     */
    public function handle(Email $event)
    {
        $email = AppEmail::find($event->data["id"]);
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = auth()->user()->email;                     //SMTP username
            $mail->Password   = $event->data["password"];                               //SMTP password
            $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(auth()->user()->email);
            $mail->addAddress($email->email_send);
            //Attachment
            foreach ($email->files() as $value) {
                $mail->attachment = $value->file;
            }
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $email->subject;
            $mail->Body = $email->description;
            $mail->send();
            break;
        } catch (Exception $e) {
            dd($e);
        }
    }
}
