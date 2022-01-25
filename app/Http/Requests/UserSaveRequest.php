<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'             => 'required',
            'surname'          => 'required',
            'south_african_id' => 'required',
            'mobile_number'    => 'required',
            'email'            => 'required|email|unique:users,email,' . $this->input('user_id'),
            'dob'              => 'required',
            'language'         => 'required',
            'interests'        => 'required',
        ];
    }
}
