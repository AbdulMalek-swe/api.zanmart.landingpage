<?php

namespace App\Http\Requests;

use App\Helpers\HttpResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category_id = $this->route('category');
        return [
            'name' => 'required|min:3|string|unique:categories,name,' . $category_id . ',category_id',
             
        ];
    }

    /** response */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return HttpResponseHelper::errorResponse($validator->errors()->all(), 422);
    }
}
