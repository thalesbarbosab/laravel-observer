<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProductRequest extends FormRequest
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
            'name'  =>  ['required','min:10',"max:150','unique:products,name,{$this->id}"],
            'price' =>  'required|numeric|min:0',
            'file'  =>  'nullable|image',
            'slug'  =>  'required_with:name'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => isset($this->name) ? Str::slug($this->name) : false,
        ]);
    }
}
