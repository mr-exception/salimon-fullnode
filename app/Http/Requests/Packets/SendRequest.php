<?php

namespace App\Http\Requests\Packets;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      "data" => "required|string|max:2048",
      "dst" => "required|string|max:128",
      "position" => "required|numeric",
      "msg_id" => "required|uuid",
      "msg_count" => "required|numeric",
    ];
  }
}
