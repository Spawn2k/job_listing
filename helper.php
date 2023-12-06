<?php

/**
 *  Get the base path
 * 
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
  return __DIR__ . '/' . $path;
}


define('BASE_PATH', pathinfo(__DIR__));
