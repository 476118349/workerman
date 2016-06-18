# workerman
workerman简单示例
workerman只是一个代码包，如果php环境满足要求，下载后即可使用，实际上没有安装过程。 
workerman对php环境的要求是： 
1、php>=5.3.3，可以运行命令 php -v 查看版本 
2、Linux系统要求php安装了posix和pcntl扩展 
可以在命令中运行 curl -Ss http://www.workerman.net/check.php | php 检测本地环境是否满足workerman。


以一个简单的Websocket聊天室服务端为例）

1、任意位置建立项目目录
如 SimpleChat/

2、引入Workerman/Autoloader.php

3、 选择websocket协议
如

require_once '/your/path/Workerman/Autoloader.php';


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

然后运行 php start.php start 命令看看进程是否开启成功


百度收索在线测试websocket，测试



