<?php

/* 选项 -- */

// 令 LightPHP 不接管错误处理
//const lpDisableErrorHandler = false;

/* -- 选项 */

const lpInLightPHP = true;

const lpDebug = 2;
const lpDefault = 1;
const lpProduction = 0;

function lpLoader($name)
{
    if(class_exists($name, false))
        return;

    $lpROOT = dirname(__FILE__);

    $path = "{$lpROOT}/class/{$name}.php";
    if(file_exists($path))
        require_once($path);
}

spl_autoload_register("lpLoader");

if(!defined("lpDisableErrorHandler") || !lpDisableErrorHandler)
{
    set_error_handler(function($no, $str, $file, $line, $varList)
    {
        throw new lpPHPException($str, 0, $no, $file, $line, null, $varList);
    });
}
