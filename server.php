<?php
// Server code (responder)

$context = new ZMQContext();
$responder = new ZMQSocket($context, ZMQ::SOCKET_REP);
$responder->bind("tcp://*:5555");

while (true) {
    // Wait for next request from client
    $message = $responder->recv();
    printf("Received request: [%s]\n", $message);

    // Do some 'work'
    sleep(1);

    // Send reply back to client
    $responder->send("World");
}
?>
