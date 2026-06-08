<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationService
{
    public function checkConflict($tableId, $date, $time): bool
    {
        return Reservation::where('table_id', $tableId)
            ->where('date', $date)
            ->where('time', $time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
    }

    public function store(array $data): Reservation
    {
        return Reservation::create($data);
    }

    public function confirm(Reservation $reservation): void
    {
        $reservation->update(['status' => 'confirmed']);
        $reservation->tableData->update(['status' => 'reserved']);
    }

    public function cancel(Reservation $reservation): void
    {
        $reservation->update(['status' => 'cancelled']);
        $reservation->tableData->update(['status' => 'available']);
    }
}