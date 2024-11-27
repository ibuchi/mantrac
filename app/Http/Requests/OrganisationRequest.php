<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganisationRequest extends FormRequest
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
        $required = Rule::requiredIf(!$this->organisation);

        return [
            'name'              => [$required, 'string', 'max:225'],
            'color'             => 'nullable|string',
            'address'           => [$required, 'string'],
            'vision_statement'  => [$required, 'string'],
            'mission_statement' => [$required, 'string'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'type'    => UserType::SUPER_ADMIN->value,
            'user_id' => $this->user()->id,
        ]);
    }
}
