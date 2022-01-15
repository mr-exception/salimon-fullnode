<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest
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
      "address" => "required|string|max:64",
      "file" => "required|file|max:1000",
      "fee" => "required|numeric|min:1000",
      "count" => "required|numeric|min:1|max:9999",
    ];
  }
}
