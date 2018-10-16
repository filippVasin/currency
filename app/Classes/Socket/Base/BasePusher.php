<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 15.10.18
 * Time: 10:52
 */

namespace App\Classes\Socket\Base;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class BasePusher implements WampServerInterface
{
    protected $subscribedTopics = [];

    /**
     * @return array
     */
    public function getSubscribeTopics()
    {
        return $this->subscribedTopics;
    }

    /**
     * @param array $SubscribeTopics
     */
    public function addSubscribeTopics($topic)
    {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }


    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribeTopics($topic);
    }
    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

    }
    public function onOpen(ConnectionInterface $conn)
    {
        echo "Connection\n";
    }
    public function onClose(ConnectionInterface $conn)
    {
        echo "Disconnected \n";
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }




}