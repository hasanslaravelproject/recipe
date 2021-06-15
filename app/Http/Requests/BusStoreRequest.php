<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'file'],
            'bus_number' => ['required', 'max:255', 'string'],
            'company_id' => ['nullable', 'max:255'],
            'seat_class_id' => ['nullable', 'max:255'],
            'bus_category_id' => ['nullable', 'max:255'],
        ];
    }
}
