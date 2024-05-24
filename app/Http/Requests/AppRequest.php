<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppRequest extends FormRequest
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
        return [
            'customer_pid' => 'required',
            'customer_name' => 'required|string',
            'customer_mobile' => 'required|integer',
            'source' => 'required|integer',
            'status' => 'required|integer',
            'product' => 'required',
            'car' => 'nullable|integer|exists:cars,id',
            'model' => 'nullable|integer|exists:car_models,id',
            'link' => 'nullable|string',
            'engine'=> 'nullable|float',
            'year' => 'nullable|integer',
            'comments' => 'nullable|string',

        ];
    }
}
