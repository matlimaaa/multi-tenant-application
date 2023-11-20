<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompanyRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'domain' => [
                'required',
                'string',
            ],
            'bd_database' => [
                'required',
                'string',
            ],
            'bd_hostname' => [
                'required',
                'string',
            ],
            'bd_username' => [
                'required',
                'string',
            ],
            'bd_password' => [
                'required',
                'string',
            ],
        ];
    }
}
