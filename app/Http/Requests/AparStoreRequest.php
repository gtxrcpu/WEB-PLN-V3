<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AparStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'               => ['required','string','max:120'],
            'serial_no'          => ['nullable'], // diabaikan (otomatis)
            'type'               => ['nullable','string','max:32'],
            'capacity'           => ['nullable','string','max:32'],
            'agent'              => ['nullable','string','max:32'],
            'location_code'      => ['nullable','string','max:80'],
            'status'             => ['required','in:baik,rusak,perbaikan,dipensiunkan'],
            'photo'              => ['nullable','image','max:2048'],
            'notes'              => ['nullable','string'],
            'last_inspection_at' => ['nullable','date'],
            'next_inspection_at' => ['nullable','date','after_or_equal:last_inspection_at'],
        ];
    }
}
