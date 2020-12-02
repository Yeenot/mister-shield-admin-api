<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }

    /**
     * list of attributes to be changed on display
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'country_id' => 'country',
            'company_id' => 'company'
        ];
    }

    public function messages()
    {
        $messages = [];
        if (isAdminRoute()) {
            $messages = [
                'status.required' => __('staff/validations.required')
            ];
        }
        return $messages;
    }
}
