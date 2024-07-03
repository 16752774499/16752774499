<?php

//db0为验证码服务，db1持久化手机号
//默认db0
function redisSession($dbindex)
{
    // 创建一个Redis实例
    $redis = new Redis();
    // 连接到Redis服务器
    $redis->connect('127.0.0.1', 6378); // 指定Redis服务器的IP地址和端口号
    $redis->auth('jhkdjhkjdhsIUTYURTU_Txdnte');
    $redis->select($dbindex);

    return $redis;
}


//查询
function getItem($keyName, $dbindex = 0): string
{
    $redis = redisSession($dbindex);
    if (!checkItem($keyName)) {
        return "";
    }else{
        $value = "";
        $value=$redis->get($keyName);
        $redis->close();
        return $value;
    }
}




//增加
function setItem($keyName, $KeyValue, $dbindex = 0)
{
    $redis = redisSession($dbindex);
    $redis->set($keyName, $KeyValue);
    $redis->close();
}

function delItem($keyName,$dbindex = 0){
    $redis = redisSession($dbindex);
    $redis->delete($keyName);
    $redis->close();
}




//检查
function checkItem($keyName, $dbindex = 0): bool
{
    $redis = redisSession($dbindex);
    if ($redis->exists($keyName)) {
        $redis->close();
        return true;
    } else {
        $redis->close();
        return false;
    }

}

//设置过期时间,键过期设置为None
function setExpire($keyName, $timeout, $dbindex = 0)
{
    $redis = redisSession($dbindex);
    $redis->expire($keyName, $timeout);
    $redis->close();
}




