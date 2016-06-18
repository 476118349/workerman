<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/18
 * Time: 10:40
 */
use Workerman\Worker;

require_once realpath(dirname(__FILE__).'/../').'/Workerman/Autoloader.php';



// 创建一个Worker监听2346端口，使用websocket协议通讯
$ws_worker = new Worker("websocket://0.0.0.0:2346");

// 启动4个进程对外提供服务
$ws_worker->count = 1;

// 当收到客户端发来的数据后返回hello $data给客户端
$ws_worker->onMessage = function($connection, $data)
{
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};

// 运行worker
Worker::runAll();

/*
// 创建一个文本协议的Worker监听4567接口
$text_worker = new Worker("websocket://0.0.0.0:4567");

// 只启动1个进程，这样方便客户端之间传输数据
$text_worker->count = 1;

$global_uid = 0;

// 当客户端连上来时分配uid，并保存连接
$text_worker->onConnect = function ($connection)
{
    global $text_worker, $global_uid;
    // 为这个链接分配一个uid
    $connection->uid = ++$global_uid;
    echo $connection->uid;
};

// 当客户端发送消息过来时，转发给所有人
$text_worker->onMessage = function ( $data)
{
    global $text_worker;
    echo $data;
    foreach($text_worker->connections as $connection)
    {
        $connection->send(time());
    }
};

// 当客户端断开时，广播给所有客户端

$text_worker->onClose = function ($connection)
{
    global $text_worker;
    foreach($text_worker->connections as $conn)
    {
        $conn->send("user[{$connection->uid}] logout");
    }
};*/


Worker::runAll();







