<?php


namespace App\Http\Utils;


use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailUtils
{

    public static function sendAgentInterestingEmailToHotel($emailTo, $hotelName, $agentName, $topic, $link) : void {
        try {
            $data = [
                'agentName' => $agentName,
                'hotelName' => $hotelName,
                'forumTopic' => $topic,
                'link'=> $link
            ];

            Mail::send('mail.agent-interesting', $data, function($message) use ($emailTo) {
                $message->to($emailTo)
                        ->subject('Hello, '. "Your reply is in interesting.");
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }

    public static function sendHotelQuotationEmailToAgent($emailTo, $hotelName, $agentName, $topic, $link) : void {
        try {
            $data = [
                'agentName' => $agentName,
                'hotelName' => $hotelName,
                'forumTopic' => $topic,
                'link'=> $link
            ];

            Mail::send('mail.hotel-quotation', $data, function($message) use ($emailTo) {
                $message->to($emailTo)
                    ->subject('Hello, '. "You got new quotation.");
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }

    public static function sendAgentEndDealToHotel($emailTo, $hotelName, $agentName, $topic, $agentTel, $agentEmail) : void {
        try {
            $data = [
                'agentName' => $agentName,
                'hotelName' => $hotelName,
                'forumTopic' => $topic,
                'agentTel'=> $agentTel,
                'agentEmail'=> $agentEmail
            ];

            Mail::send('mail.agent-enddeal', $data, function($message) use ($emailTo) {
                $message->to($emailTo)
                    ->subject('Congrats, '. "Your forum & quotation was dealt.");
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }

    public static function sendMailResetPassword($emailTo, $accountName, $link) : void {
        try {
            $data = [
                'accountName' => $accountName,
                'link'=> $link
            ];

            Mail::send('mail.resetpass', $data, function($message) use ($emailTo) {
                $message->to($emailTo)
                        ->subject("Reset password.");
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }

    public static function sendMailPasswordChanged($emailTo, $accountName) : void {
        try {
            $data = [
                'accountName' => $accountName
            ];

            Mail::send('mail.passchanged', $data, function($message) use ($emailTo) {
                $message->to($emailTo)
                    ->subject("Password changed.");
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }

    public static function sendDirectContact($emailTo, $textSubject, $textEmail, $textMessage) : void {
        try {
            $data = [
                'textSubject' => $textSubject,
                'textEmail' => $textEmail,
                'textMessage' => $textMessage
            ];

            Mail::send('mail.contact-profile', $data, function($message) use ($emailTo, $textSubject) {
                $message->to($emailTo)
                    ->subject($textSubject);
                $message->from('noreply@klouddos.com','KloudDos');
            });

        } catch (Exception $e) {
            Log::error('Caught exception: '.$e->getMessage());
        }
    }
}