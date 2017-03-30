<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class WorkScheduleRequest extends FormRequest
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
      'schedule' => 'mimes:jpeg,png,jpg,pdf',
    ];
  }

  public function messages()
  {
    return[
      'schedule.mimes' => 'ファイルの形式が正しくありません。pdf/jpeg/pngのいずれかの形式のみアップロードできます。',
    ];
  }
}
