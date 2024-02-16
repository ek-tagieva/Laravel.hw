<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderPlant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $order = OrderPlant::all();
        return view('orders.list', ['order' => $order]);
    }

    public function sendOrderMail(array $mailAttr)
    {
        $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
            ->setUsername('xenia1898@mail.ru')
            ->setPassword('Mail1968')
            ->setEncryption('ssl')
        ;

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($mailAttr['theme']))
            ->setFrom(['xenia1898@mail.ru' => 'Xenia Tkacheva'])
            ->setTo(['laliiy@rambler.ru' => 'admin1', 'xenia189z@gmail.com' => 'Admin_2'])
            ->setBody($mailAttr['body'])
        ;

        $result = $mailer->send($message);
        return $result;
    }
}
