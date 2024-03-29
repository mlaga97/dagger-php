<?php

/**
 * Library for module handling.
 * 
 * Modules are installed in the 'modules/' directory and contain keys in
 * the form of directories. These keys contain source files which are
 * loaded in php's alphabetical sorting order. The structure is roughly:
 * 'modules/[module_name]/[key_name]/[file_name].php'
 * 
 * Prefixes such as '1_', '9_', 'zz_', and 'zzzz_' can be used to ensure
 * that module contents load towards the top or bottom of the page.
 * 
 * Here is an example of 3 installed modules:
 * - modules/
 *     - module1/
 *         - key1/
 *             - 1_file.php
 *         - key2/
 *             - 9_file.php
 *             - zzzz_file.php
 *         - key3/
 *             - file.php
 *     - module2/
 *         - key1/
 *             - file.php
 *         - key2/
 *             - file.php
 *         - key4/
 *             - 1_file.php
 *     - module3/
 *         - key2/
 *             - 1_file.php
 *         - key4/
 *             - file.php
 * 
 * Running 'moduleLoad("key2")' would load the files for "key2" in the
 * following order within the page:
 * - modules/module3/key2/1_file.php
 * - modules/module1/key2/9_file.php
 * - modules/module2/key2/file.php
 * - modules/module1/key2/zzzz_file.php
 */


/**
 * Finds what modules are currently installed.
 * 
 * @return array List of all currently installed modules.
 */
function moduleList() {
  return array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/"), ['..', '.']);
}

/**
 * Finds all of the keys that a particular module provides.
 * 
 * @param string $module Name of the module in question.
 * 
 * @return array List of all keys provided by the module in question.
 */
function moduleProvides($module) {
  $raw = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), ['..', '.']);

  $processed = [];
  foreach($raw as $file) {
    if(is_dir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module . '/' . $file)) {
      array_push($processed, $file);
    }
  }

  return $processed;
}

/**
 * Finds all of the keys available from the installed modules.
 * 
 * @return array List of all available keys.
 */
function moduleListKeys() {
  $keyList = [];

  foreach(moduleList() as $module) {
    foreach(moduleProvides($module) as $key) {
      array_push($keyList, $key);
    }
  }

  return array_unique($keyList);
}

/**
 * Finds all of the modules which provide a particular key.
 * 
 * @param string $key Name of the key in question.
 * 
 * @return array List of all modules which provide the key in question.
 */
function moduleListProviders($key) {
  $providerList = [];

  foreach(moduleList() as $module) {
    if(in_array($key, moduleProvides($module))) {
      array_push($providerList, $module);
    }
  }

  return $providerList;
}

/**
 * Finds all of the filenames associated with a particular key.
 * 
 * @param string $key Name of the key in question.
 * 
 * @return array List of filenames associated with the key in question.
 */
function moduleListFiles($key) {
  $files = [];

  foreach(moduleListProviders($key) as $module) {
    $providerPath = $_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module . '/' . $key;
    $files = array_merge($files, array_diff(scandir($providerPath), ['..', '.']));
  }

  // Remove all but '.php'
  foreach($files as $key => $file) {
    if(!preg_match('/.php$/', $file)) {
      unset($files[$key]);
    }
  }

  sort($files);

  return array_unique($files);
}

/**
 * Finds all of the files associated with a particular key.
 * 
 * @param string $key Name of the key in question.
 * 
 * @return array List of paths to files associated with the key in question.
 */
function moduleListPaths($key) {
  $paths = [];

  foreach(moduleListFiles($key) as $file) {
    $paths = array_merge($paths, array_diff(glob($_SERVER['DOCUMENT_ROOT'] . "/modules/*/" . $key . '/' . $file), ['..', '.']));
  }

  return $paths;
}

/**
 * Includes all of the files associated with a particular key.
 * 
 * @param string $key Name of key in question.
 */
function moduleLoad($key) {
  foreach(moduleListPaths($key) as $file) {
    include $file;
  }
}

function moduleFiles($provider) {
  $output = [];
  foreach(moduleProvides($provider) as $key) {
    $output[$key] = [];

    $files = array_diff(scandir("/var/www/html/modules/" . $provider . '/' . $key), ['..', '.']);

    foreach($files as $file) {
      $path = '/var/www/html/modules/' . $provider . '/' . $key . '/' . $file;

      $output[$key][$file] = substr(md5_file($path), 0, 5);
    }
  }
  return $output;
}

function moduleListTruncatedPaths($key) {
  $output = [];

  foreach(moduleListPaths($key) as $path) {
    $explodedPath = explode('/', $path);
    $truncatedPath = $explodedPath[5] . '/' . $explodedPath[7]; // . ' (' . substr(md5_file($path), 0, 5) . ')<br/>';
    array_push($output, $truncatedPath);
  }

  return $output;
}

?>
