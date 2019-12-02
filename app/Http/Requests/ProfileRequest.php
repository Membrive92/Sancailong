<?php

namespace App\Http\Requests;
use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

        public function authorize()
    {
        return auth()->user()->role_id === Role::TEACHER ||  auth()->user()->role_id === Role::STUDENT;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST': {
                return [


                    'picture' => 'required|image|mimes:jpg,jpeg,png',
                ];
            }
            case 'PUT': {
                return [

                    'last_name' => '',
                    'picture' => 'required|image|mimes:jpg,jpeg,png',
                ];
            }
        }
    }
}
