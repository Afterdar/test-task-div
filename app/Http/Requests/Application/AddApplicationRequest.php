<?php

declare(strict_types=1);

namespace App\Http\Requests\Application;

use App\Http\Requests\BaseRequest;
use Exception;

class AddApplicationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'min:3'],
            'message' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'name.required' => $this->getMessage('required'),
            'name.string' => $this->getMessage('string'),
            'name.max' => $this->getMessage('max'),
            'name.min' => $this->getMessage('min'),

            'email.required' => $this->getMessage('required'),
            'email.email' => $this->getMessage('email'),
            'email.min' => $this->getMessage('min'),

            'message.required' => $this->getMessage('required'),
            'message.string' => $this->getMessage('string'),
            'message.min' => $this->getMessage('min'),
        ];
    }
}
