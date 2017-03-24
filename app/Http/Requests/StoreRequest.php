<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
          'name' => 'required',
          'kana_name' => 'required',
      ];
    }

    public function messages()
    {
      return [
      'name.required' => '店舗名を入力してください。',
      'kana_name.required' => '店舗名を入力してください。'
      ];
    }
}
