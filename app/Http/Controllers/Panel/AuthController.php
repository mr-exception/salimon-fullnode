<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function loginGet(Request $request)
  {
    return view("auth.login");
  }
  public function loginSubmit(Request $request)
  {
    $user = User::whereUsername($request->username)
      ->wherePassword(md5($request->password))
      ->first();
    if ($user) {
      Auth::login($user);
      return redirect()->route("welcome");
    }
    return redirect()
      ->back()
      ->withInput($request->all())
      ->withErrors(["message" => "username and password invalid"]);
  }

  public function changePasswordGet(Request $request)
  {
    return view("auth.change_password", $request->all());
  }

  public function changePasswordSubmit(ChangePassword $request)
  {
    $user = Auth::user();
    $user->password = md5($request->password);
    $user->save();
    return view("auth.change_password", ["success" => true]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route("welcome");
  }
}
