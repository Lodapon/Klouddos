<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Utils\MailUtils;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller {

    public function html_email() {


        MailUtils::sendDirectContact("gift2533@hotmail.com", "hello", "me@email.com", "hello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybodyhello everybody");

//        $receiver = "Hotel A";
//
//        $data = [
//            'agentName' => "Agent A",
//            'hotelName' => $receiver,
//            'forumTopic' => "หาห้องพัก 100 ห้อง",
//            'link'=>"http://locaahost:8000/"
//        ];
//
//
//        Mail::send('mail.agent-interesting', $data, function($message) {
//            $message->to('gift2533@hotmail.com')
//                ->subject
//                ('Hello, '. "Your reply is in interesting.");
//
////            $message->from('noreply@klouddos.com','KloudDos');
//        });
        echo "HTML Email Sent. Check your inbox.";

//        return view("template.mail")->with($data);
    }

    public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
    public function sendFeedback(Request $request) {
        $subject = $request["Name"];
        $msg = $request["Message"];
        $email = $request["Email"];

        MailUtils::sendDirectContact("contact@klouddos.com", $subject, $email, $msg);
        return redirect()->back()->with('success', ' Email Sent.');

    }
}