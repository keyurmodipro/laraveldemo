<?php

namespace App\Listeners;

use Codemash\Socket\Events\MessageReceived;
use Codemash\Socket\Events\ClientConnected;
use Codemash\Socket\Events\ClientDisconnected;

class MessageEventListener {

    public function onMessageReceived(MessageReceived $event) {
        $message = $event->message;

        // If the incomming command is 'sendMessageToOthers', forward the message to the others.
        if ($message->command === 'sendMessageToOthers') {
            // To get the client sending this message, use the $event->from property.
            // To get a list of all connected clients, use the $event->clients pointer.
            $others = $event->allOtherClients();
            foreach ($others as $client) {
                // The $message->data property holds the actual message
                $client->send('newMessage', $message->data);
            }
        }
    }

    public function onConnected(ClientConnected $event) {

        $others = $event->allOtherClients();
        foreach ($clients as $client) {
            if ($client->authed()) {
                $user = $client->getUser();
                $client->send('getAllData', $user);
                // $user now holds the App\User model,
                // or the model set in the 'config.auth.providers.users.model' config variable.
            }
        }
    }

    public function onDisconnected(ClientDisconnected $event) {
        // Not used in this example.
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events) {
        $events->listen(
                'Codemash\Socket\Events\ClientConnected', 'App\Listeners\MessageEventListener@onConnected'
        );

        $events->listen(
                'Codemash\Socket\Events\MessageReceived', 'App\Listeners\MessageEventListener@onMessageReceived'
        );

        $events->listen(
                'Codemash\Socket\Events\ClientDisconnected', 'App\Listeners\MessageEventListener@onDisconnected'
        );
    }

}
