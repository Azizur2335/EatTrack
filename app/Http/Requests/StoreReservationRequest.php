<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id'      => 'required|exists:tables,id',
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required',
            'guest_count'   => 'required|integer|min:1',
            'notes'         => 'nullable|string',
            'promo_id'      => 'nullable|exists:promos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'Restoran harus dipilih.',
            'table_id.required'      => 'Meja harus dipilih.',
            'date.after_or_equal'    => 'Tanggal reservasi tidak boleh sebelum hari ini.',
            'guest_count.min'        => 'Jumlah tamu minimal 1 orang.',
        ];
    }
}