<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusScheduleUpdateRequest extends FormRequest
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
            'date' => ['required', 'date', 'date'],
            'bus_id' => ['nullable', 'max:255'],
            'bus_route_id' => ['nullable', 'max:255'],
        ];
    }
}
