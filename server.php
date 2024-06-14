<?php
$context = new ZMQContext();

// Socket to receive requests from the client
$responder = new ZMQSocket($context, ZMQ::SOCKET_REP);
$responder->bind("tcp://*:5555");

// Socket to send notifications to the client
$notifier = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$notifier->bind("tcp://*:5556");

while (true) {
    // Wait for next request from the client
    $message = $responder->recv();
    printf("Received request: [%s]\n", $message);

    // Send reply back to client
    $responder->send("World");

    // Simulate sending a notification to the client
    $notifier->send("Notification: Your request has been processed.");
}
?>
