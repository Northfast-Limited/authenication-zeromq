<?php
$context = new ZMQContext();

// Socket to send requests to the server
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$requester->connect("tcp://localhost:5555");

// Socket to receive notifications from the server
$responder = new ZMQSocket($context, ZMQ::SOCKET_REP);
$responder->connect("tcp://localhost:5556");

for ($request_nbr = 0; $request_nbr != 10; $request_nbr++) {
    printf("Sending request %d...\n", $request_nbr);
    $requester->send("Hello");

    $reply = $requester->recv();
    printf("Received reply %d: [%s]\n", $request_nbr, $reply);

    // Simulate receiving a notification
    $notification = $responder->recv();
    printf("Received notification: [%s]\n", $notification);
}
?>
