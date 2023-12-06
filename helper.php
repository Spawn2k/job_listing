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


/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 */

function loadView($name)
{
  $viewPath = basePath("views/{$name}.view.php");
  if (file_exists($viewPath)) {
    require $viewPath;
  } else {
    echo "View '{$name} not Found";
  }
}


/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */

function loadPartial($name)
{
  $partialPath = basePath("views/partials/{$name}.php");
  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial '{$name} not Found";
  }
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

function dump($value)
{
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
};

function dd($value)
{
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
  exit();
}
