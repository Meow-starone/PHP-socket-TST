<?php
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 1, "usec" => 0));
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 6, "usec" => 0));

if (socket_connect($socket, '127.0.0.1', 8888) == false) {
    echo 'connect fail massege:' . socket_strerror(socket_last_error());
} else {
    $message = 'l love you 我爱你 socket';
    $message = mb_convert_encoding($message, 'GBK', 'UTF-8');

    if (socket_write($socket, $message, strlen($message)) == false) {
        echo 'fail to write' . socket_strerror(socket_last_error());

    } else {
        echo 'client write success' . PHP_EOL;
        while ($callback = socket_read($socket, 1024)) {
            echo 'server return message is:' . PHP_EOL . $callback;
        }
    }
}
socket_close($socket);
