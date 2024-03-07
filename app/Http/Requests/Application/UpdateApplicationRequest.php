<?php

declare(strict_types=1);

namespace App\Http\Requests\Application;

use App\Http\Requests\BaseRequest;
use Exception;

class UpdateApplicationRequest extends BaseRequest
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
            'comment' => ['required', 'string', 'min:6'],
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

            'comment.required' => $this->getMessage('required'),
            'comment.string' => $this->getMessage('string'),
            'comment.min' => $this->getMessage('min'),
        ];
    }
}
