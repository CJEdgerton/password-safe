<?php

namespace App\Http\Requests;

use App\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatesPassword extends FormRequest
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
            'account'  => 'string|required',
            'username' => 'string|required',
            'password' => 'string|required',
        ];
    }

    public function update(Password $password)
    {
        $password = $password->update([
            'user_id'  => auth()->id(),
            'account'  => $this->account,
            'username' => $this->username,
            'password' => $this->password,
        ]);

        return $password;
    }
}