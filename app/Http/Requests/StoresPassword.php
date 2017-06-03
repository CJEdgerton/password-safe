<?php

namespace App\Http\Requests;

use App\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoresPassword extends FormRequest
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
            'account'          => 'required|string',
            'username'         => 'required|string',
            'password'         => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ];
    }

    public function store()
    {
        $password = Password::create([
            'user_id'  => auth()->id(),
            'account'  => $this->account,
            'username' => $this->username,
            'password' => encrypt($this->password),
        ]);

        return $password;
    }

    public function messages() {
        return [
            'confirm_password.same' => 'Your passwords do not match!',
        ];
    }
}
