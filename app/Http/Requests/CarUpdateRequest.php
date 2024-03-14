<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'merek' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'nomor_plat' => ['required', 'max:10'],
            'tarif_sewa' => ['required', 'integer'],
            'stock' => ['required', 'integer']
        ];
    }
}
