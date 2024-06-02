<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppRequest extends FormRequest
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
            'customer_pid'    => 'required|max:11|min:11',
            'customer_name'   => 'required|string|max:90',
            'customer_mobile' => 'required|max:130|min:9',
            'source'          => 'required|integer|exists:sources,id',
            'status'          => 'required|integer|exists:statuses,id',
            'product'         => 'required|integer|exists:products,id',
            'company'         => 'required|array',
            'company.*'       => 'integer|exists:companies,id',
            'car'             => 'nullable|integer|exists:cars,id',
            'model'           => 'nullable|integer|exists:car_models,id',
            'link'            => 'nullable|string',
            'engine'          => 'nullable|string|max:5',
            'year'            => 'nullable|integer',
            'comment'         => 'nullable|string|max:1000',
            'commentids'      => 'nullable|array',
            'commentids.*'    => 'integer|exists:comments,id',
            'oldcomment'      => 'nullable|array',
            'oldcomment.*'    => 'string',
            'newcomment'      => 'nullable|array',
            'newcomment.*'    => 'string|max:1000',
        ];
    }


    public function messages()
    {
        return [
            'customer_pid.required'    => 'პირადი ნომრის მითითება სავალდებულია',
            'customer_pid.max'    => 'პირადი ნომერი არ შეიძლება იყოს 11 სიმბოლოზე მეტი',
            'customer_pid.min'    => 'პირადი ნომერი არ შეიძლება იყოს 11 სიმბოლოზე ნაკლები',
            'customer_name.required'   => 'კლიენტის სახელის მითითება სავალდებულოა',
            'customer_name.string'     => 'კლიენტის სახელი უნდა იყოს ტექსტი',
            'customer_name.max'     => 'სახელი არ უნდა იყოს 30 სიმბოლოზე მეტი',
            'customer_mobile.required' => 'მოილურის ნომრის მითითება სავალდებულოა',
            'customer_mobile.max' => 'მოილური არ უნდა იყოს 40 სიმბოლოზე მეტი',
            'customer_mobile.min' => 'მოილური არ უნდა იყოს 9 სიმბოლოზე ნაკლები',
            'source.required'          => 'წყაროს მითითება სავალდებულოა',
            'source.integer'           => 'Source must be an integer.',
            'source.exists'            => 'Selected source is invalid.',
            'status.required'          => 'სტატუსის მითითება სავალდებულოა',
            'status.integer'           => 'Status must be an integer.',
            'status.exists'            => 'Selected status is invalid.',
            'product.required'         => 'პროდუქტის მითითება სავალდებულოა',
            'product.integer'          => 'Product must be an integer.',
            'product.exists'           => 'Selected product is invalid.',
            'company.required'         => 'კომპანიის მითითება სავალდებულოა',
            'company.array'            => 'Company must be an array.',
            'company.*.integer'        => 'კომპანიის მითითება სავალდებულოა.',
            'company.*.exists'         => 'Selected company is invalid.',
            'car.integer'              => 'Car must be an integer.',
            'car.exists'               => 'Selected car is invalid.',
            'model.integer'            => 'Model must be an integer.',
            'model.exists'             => 'Selected model is invalid.',
            'link.string'              => 'Link must be a string.',
            'engine.string'            => 'Engine must be a string.',
            'engine.max'               => 'ასეთი ძრავი არ არსებობს',
            'year.integer'             => 'წელი უნდა იყოს რიცხვითი მნიშვნელობა',
            'comment.string'           => 'კომენტარი არ შეიძლება იყოს ცარიელი',
            'comment.max'           => 'კომენტარი არ შეიძლება იყოს 300 სიმბოლოზე მეტი',
            'commentids.array'         => 'Comment IDs must be an array.',
            'commentids.*.integer'     => 'Each comment ID must be an integer.',
            'commentids.*.exists'      => 'Selected comment is invalid.',
            'oldcomment.array'         => 'Old comments must be an array.',
            'oldcomment.*.string'      => 'Each old comment must be a string.',
            'newcomment.array'         => 'New comments must be an array.',
            'newcomment.*.string'      => 'კომენტარი არ შეიძლება იყოს ცარიელი',
            'newcomment.*.max'           => 'კომენტარი არ შეიძლება იყოს 300 სიმბოლოზე მეტი',
        ];
    }


}
