<?php

declare(strict_types=1);

namespace App\Http\Requests\Application;

use App\Http\Requests\BaseRequest;
use Exception;

class StatusApplicationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:active,resolved'],
        ];
    }

    /**
     * @throws Exception
     */
    public function messages(): array
    {
        return [
            'status.required' => $this->getMessage('required'),
            'status.string' => $this->getMessage('string'),
            'status.in' => $this->getMessage('in'),
        ];
    }
}
