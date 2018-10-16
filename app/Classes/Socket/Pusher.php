<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 15.10.18
 * Time: 13:07
 */

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BasePusher;
use ZMQContext;

class Pusher extends BasePusher
{
    static function sendDataToServer(array $data)
    {
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
        $socket->connect('tcp://127.0.0.1:5555');
        $socket->send(json_encode($data));
    }

    public function broadcast($jsonDataToSend)
    {
        $aDataToSend = json_decode($jsonDataToSend, true);
        $subscribedTopics = $this->getSubscribeTopics();

        if (isset($subscribedTopics[$aDataToSend['topic_id']])) {
            $topic = $subscribedTopics[$aDataToSend['topic_id']];
            $topic->broadcast($aDataToSend);
        }
    }
}