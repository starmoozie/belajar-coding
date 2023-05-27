<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:5',
            'email' => 'required|max:50|email|unique:users,email',
            'password' => 'required|confirmed',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            $this->failsMessage($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    protected function failsMessage($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null
        ], $code);
    }

    public function passedValidation()
    {
        $this->merge(['password' => \Hash::make($this->password)]);
    }
}
