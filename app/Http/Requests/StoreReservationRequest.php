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
            'table_id'      => [
                'required',
                \Illuminate\Validation\Rule::exists('tables', 'id')->where(function ($query) {
                    $query->where('restaurant_id', $this->restaurant_id);
                }),
            ],
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required|date_format:H:i',
            'guest_count'   => 'required|integer|min:1|max:20',
            'notes'         => 'nullable|string',
            'promo_id'      => 'nullable|exists:promos,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $restaurantId = $this->input('restaurant_id');
            $tableId = $this->input('table_id');
            $date = $this->input('date');
            $time = $this->input('time');
            $guestCount = $this->input('guest_count');

            if (!$restaurantId || !$tableId || !$time || !$date) {
                return;
            }

            // 1. Validasi Kapasitas Meja
            $table = \App\Models\Table::find($tableId);
            if ($table && $guestCount > $table->capacity) {
                $validator->errors()->add('guest_count', "Kapasitas meja ini hanya untuk maksimal {$table->capacity} orang.");
            }

            // 2. Validasi Jam Operasional Restoran
            $restaurant = \App\Models\Restaurant::find($restaurantId);
            if ($restaurant) {
                $open = $restaurant->open_time;
                $close = $restaurant->close_time;
                if ($open && $close) {
                    $timeParsed = \Carbon\Carbon::parse($time)->format('H:i:s');
                    $openParsed = \Carbon\Carbon::parse($open)->format('H:i:s');
                    $closeParsed = \Carbon\Carbon::parse($close)->format('H:i:s');

                    $isOpen = false;
                    if ($closeParsed >= $openParsed) {
                        $isOpen = ($timeParsed >= $openParsed && $timeParsed <= $closeParsed);
                    } else {
                        // Kasus operasional melewati tengah malam
                        $isOpen = ($timeParsed >= $openParsed || $timeParsed <= $closeParsed);
                    }

                    if (!$isOpen) {
                        $formattedOpen = \Carbon\Carbon::parse($open)->format('H.i');
                        $formattedClose = \Carbon\Carbon::parse($close)->format('H.i');
                        $validator->errors()->add('time', "Waktu reservasi harus di antara jam operasional ({$formattedOpen} - {$formattedClose} WITA).");
                    }
                }
            }

            // 3. Validasi Waktu Lampau (Khusus Hari Ini)
            $todayDate = now('Asia/Makassar')->format('Y-m-d');
            if ($date === $todayDate) {
                $currentTime = now('Asia/Makassar')->format('H:i:s');
                $timeParsed = \Carbon\Carbon::parse($time)->format('H:i:s');
                if ($timeParsed < $currentTime) {
                    $validator->errors()->add('time', 'Waktu reservasi sudah terlewat untuk hari ini.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'Restoran harus dipilih.',
            'table_id.required'      => 'Meja harus dipilih.',
            'table_id.exists'        => 'Meja yang dipilih tidak terdaftar di restoran ini.',
            'date.after_or_equal'    => 'Tanggal reservasi tidak boleh sebelum hari ini.',
            'time.date_format'       => 'Format waktu tidak valid (gunakan HH:MM).',
            'guest_count.min'        => 'Jumlah tamu minimal 1 orang.',
            'guest_count.max'        => 'Jumlah tamu maksimal 20 orang.',
        ];
    }
}