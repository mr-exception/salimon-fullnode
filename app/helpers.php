<?php

use Illuminate\Support\Facades\Log;

if (!function_exists("setEnv")) {
  function setEnv($key, $value)
  {
    $path = base_path(".env");
    if (file_exists($path)) {
      Log::info("$key = $value");
      file_put_contents($path, str_replace("$key=" . env($key), "$key=$value", file_get_contents($path)));
    }
  }
}
