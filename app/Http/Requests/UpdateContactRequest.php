<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'full_name' => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'company' => ['string', 'max:255'],
            'phone' => ['sometimes', 'required', 'numeric', 'digits_between:8,12'],
            'email' => ['sometimes', 'required', 'email', 'max:255'],
            'date_of_birth' => ['date'],
            'picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }
}
