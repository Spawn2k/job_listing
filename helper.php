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

function loadView($name, $data = [])
{
  $viewPath = basePath("App/views/{$name}.view.php");
  if (file_exists($viewPath)) {
    extract($data);
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
  $partialPath = basePath("App/views/partials/{$name}.php");
  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial '{$name} not Found";
  }
}

// /**
//  * Inspect a value(s)
//  * 
//  * @param mixed $value
//  * @return void
//  */

// function dump($value)
// {
//   echo '<pre>';
//   var_dump($value);
//   echo '</pre>';
// };

// function dd($value)
// {
//   echo '<pre>';
//   var_dump($value);
//   echo '</pre>';
//   exit();
// }

/**
 * Format salary
 * 
 * @param string $salray
 * @return string $formated Salary
 */

function formatSalary($salary)
{
  return '$' . number_format(floatval($salary));
}
