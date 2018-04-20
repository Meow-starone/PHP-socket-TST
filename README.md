---
title: PHP.Socket通信测试-包括客户端硬件层
date: 2018-04-15 20:57:45
tags: 
- Socket
---
<br>

Github代码仓库
--
https://github.com/Meow-starone/PHP-socket-TST<br>

&emsp;&emsp;关于PHP的Socket通信实例，网上资料很少，特别是与硬件层的交互过程，近几天总结了一下学习到的用法。<br>

基本语法
--
    // 设置一些基本的变量
    $host = "192.168.1.99";
    $port = 1234;
    // 设置超时时间
    set_time_limit(0);
    // 创建一个Socket
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not createsocket\n");
    //绑定Socket到端口
    $result = socket_bind($socket, $host, $port) or die("Could not bind tosocket\n");
    // 开始监听链接
    $result = socket_listen($socket, 3) or die("Could not set up socketlistener\n");
    // accept incoming connections
    // 另一个Socket来处理通信
    $spawn = socket_accept($socket) or die("Could not accept incomingconnection\n");
    // 获得客户端的输入
    $input = socket_read($spawn, 1024) or die("Could not read input\n");
    // 清空输入字符串
    $input = trim($input);
    //处理客户端输入并返回结果
    $output = strrev($input) . "\n";
    socket_write($spawn, $output, strlen ($output)) or die("Could not write
    output\n");
    // 关闭sockets
    socket_close($spawn);
    socket_close($socket);
<br>

客户端
--
建立一个连接来发送数据
<div align="center">![client](http://i2.bvimg.com/641583/1680c5c5641d20b5.jpg)</div><br>

可以通过命令行来查看是否发送成功
<div align="center">![result](http://i2.bvimg.com/641583/db3080d2a60c2b9e.jpg)</div><br>

硬件层
--
协议：UDP

<div align="center">![server](http://i2.bvimg.com/641583/60e119e821c3a8b8.jpg)</div><br>

对于端口开放情况，我们可以通过netstat -ano查看，可见，设置的3386端口处于listening状态。
<div align="center">![listening](http://i2.bvimg.com/641583/ac69e9cf68e54331.jpg)</div><br>

对于数据pin通情况，我们可以通过wireshark抓包，可见对应端口监听到数据。
<div align="center">![wireshark](http://i2.bvimg.com/641583/1053bb5f7f7ccbb7.jpg)</div><br>



