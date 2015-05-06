<?php

/* 
 * 打印数组
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function p ($arr){
    echo '<pre>';
    print_r ($arr);
    echo '</pre>';
}

/*
 * 异位或加密字符串
 * $value 需要加密的字符串
 * $type 加密解密 0解密，1加密
 * return 加密或解密返回的字符串
 */
function enctyption($value,$type=0){
    $key = md5(C('ENCTYPTION_KEY'));
    if(!$type){
        return str_replace('=','',base64_encode($value^$key));
    }
    $value = base64_decode($value);
    return $value ^ $key;
}
