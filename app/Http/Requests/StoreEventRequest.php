<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'room_id' => 'nullable|exists:rooms,id',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'all_day' => 'boolean',
            'color' => 'nullable|string|max:7',
            'recurrence_rule' => 'nullable|string',
        ];
    }
}
