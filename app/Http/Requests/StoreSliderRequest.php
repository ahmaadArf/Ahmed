<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'titel'=>'required | max:3',
            'image'=>'required',
        ];
    }

    //لتغيير رسالة الغلط  Customizing The Error Messages
    public function messages(): array
    {
        return [
            'name.required' => 'يجب عليك ادخال الاسم',
            'titel.required' => 'يجب عليك ادخال العنوان',
            'titel.max' => 'يجب ان تكون الحروف اقل او تساوي 3',
            'image.required' => 'يجب عليك ادخال الصورة',
        ];
    }
}
