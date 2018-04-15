<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if (socket_bind($socket, '127.0.0.1', 8888) == false) {
    echo 'server bind fail:' . socket_strerror(socket_last_error());
}

if (socket_listen($socket, 4) == false) {
    echo 'server listen fail:' . socket_strerror(socket_last_error());
}

do {
    $accept_resource = socket_accept($socket);

    if ($accept_resource !== false) {
        $string = socket_read($accept_resource, 1024);

        echo 'server receive is :' . $string . PHP_EOL; //PHP_EOL为php的换行预定义常量
        if ($string != false) {
            $return_client = 'server receive is : ' . $string . PHP_EOL;
            socket_write($accept_resource, $return_client, strlen($return_client));
        } else {
            echo 'socket_read is fail';
        }
        socket_close($accept_resource);
    }
} while (true);
socket_close($socket);
