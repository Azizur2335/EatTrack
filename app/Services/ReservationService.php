<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationService
{
    public function checkConflict($tableId, $date, $time, $excludeReservationId = null): bool
    {
        $targetDateTime = \Carbon\Carbon::parse("$date $time");
        
        $activeReservations = Reservation::where('table_id', $tableId)
            ->where('date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->when($excludeReservationId, function($q) use ($excludeReservationId) {
                $q->where('id', '!=', $excludeReservationId);
            })
            ->get();

        foreach ($activeReservations as $res) {
            $resDateTime = \Carbon\Carbon::parse("{$res->date} {$res->time}");
            $diffInMinutes = abs($targetDateTime->diffInMinutes($resDateTime));
            if ($diffInMinutes < 120) { // Bentrok dalam rentang 2 jam
                return true;
            }
        }

        return false;
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