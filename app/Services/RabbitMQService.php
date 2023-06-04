<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Connection\AMQPStreamConnection;
// use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Models\Event;

class RabbitMQService
{
    public function publish($message)
    {
        $connection = new AMQPStreamConnection("goose-01.rmq2.cloudamqp.com", "5672", "hwtyemoo", "cglmvY7Sbql86_WX2wZwk_DhamrqY-5_", "hwtyemoo");
        $channel = $connection->channel();
        // $channel->exchange_declare('test_exchange', 'direct', false, false, false);
        $channel->queue_declare('helloqueue', false, false, false, false);
        // $channel->queue_bind('test_queue', 'test_exchange', 'test_key');
        $msg = new AMQPMessage($message); //$message);
        $channel->basic_publish($msg, '', 'helloqueue');
        $channel->close();
        $connection->close();
    }

    function getProtectedValue($obj, $name)
    {
        $array = (array) $obj;
        $prefix = chr(0) . '*' . chr(0);
        return $array[$prefix . $name];
    }

    public function consume()
    {
        $queueName = "DefaultQueue";
        $connection = new AMQPStreamConnection("goose-01.rmq2.cloudamqp.com", "5672", "hwtyemoo", "cglmvY7Sbql86_WX2wZwk_DhamrqY-5_", "hwtyemoo");
        $channel = $connection->channel();
        $deliveryTag = "";
        $output = array();


        $channel->queue_declare($queueName, true, false, false, false);
        $message = $channel->basic_get($queueName);

        while (true) {
            $message = $channel->basic_get($queueName);
            if ($message == null)
                break;

            $body = json_decode($message->body);
            $array = get_object_vars($body);
            $eventId =  (string) $array["EventId"];

            $count = DB::table('Events')->where('id', '=', $eventId)->count();
            if ($count == 0) {
                array_push(
                    $output,
                    [
                        'body' => $array,
                        "type" => self::getProtectedValue($message, "properties")["type"]
                    ]
                );
                $Event = new Event;
                $Event->id = $array["EventId"];
                $Event->PublishedTime = $array["PublishedTime"];
                $Event->save();
            }
            
            $deliveryTag = $message->delivery_info['delivery_tag'];

        }

        $channel->basic_nack($deliveryTag, true, true);


        $channel->close();
        $connection->close();

        return $output;
    }
}
