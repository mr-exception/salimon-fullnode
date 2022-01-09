<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
  public function show(Request $request)
  {
    return view("panel.configs");
  }
  public function update(Request $request)
  {
    foreach ($request->all() as $key => $value) {
      setEnv($key, $value);
    }
    return redirect()->route("configs.show");
  }
}
