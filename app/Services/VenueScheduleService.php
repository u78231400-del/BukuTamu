<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\VenueSchedule;

class VenueScheduleService
{
    public static function hasActiveScheduleConflict(
        int $venueId,
        string $tanggalMulai,
        string $tanggalSelesai,
        string $waktuMulai,
        string $waktuSelesai,
        ?int $excludeScheduleId = null
    ): bool {
        $newStart = $tanggalMulai . ' ' . $waktuMulai . ':00';
        $newEnd = $tanggalSelesai . ' ' . $waktuSelesai . ':00';

        $query = VenueSchedule::where('venue_id', $venueId)
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_mulai, ' ', waktu_mulai), '%Y-%m-%d %H:%i:%s') < ?", [$newEnd])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_selesai, ' ', waktu_selesai), '%Y-%m-%d %H:%i:%s') > ?", [$newStart]);

        if ($excludeScheduleId) {
            $query->where('id', '!=', $excludeScheduleId);
        }

        return $query->exists();
    }

    public static function hasReservationConflict(
        int $venueId,
        string $tanggalMulai,
        string $tanggalSelesai,
        string $waktuMulai,
        string $waktuSelesai,
        ?int $excludeReservationId = null
    ): bool {
        $newStart = $tanggalMulai . ' ' . $waktuMulai . ':00';
        $newEnd = $tanggalSelesai . ' ' . $waktuSelesai . ':00';

        $query = Reservation::where('venue_id', $venueId)
            ->whereNotIn('status', ['rejected', 'canceled'])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_mulai, ' ', waktu_mulai), '%Y-%m-%d %H:%i:%s') < ?", [$newEnd])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_selesai, ' ', waktu_selesai), '%Y-%m-%d %H:%i:%s') > ?", [$newStart]);

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return $query->exists();
    }

    public static function checkCustomerReservationConflict(
        int $venueId,
        string $tanggalMulai,
        string $tanggalSelesai,
        string $waktuMulai,
        string $waktuSelesai,
        ?int $excludeReservationId = null
    ): ?string {
        if (self::hasActiveScheduleConflict($venueId, $tanggalMulai, $tanggalSelesai, $waktuMulai, $waktuSelesai)) {
            return 'schedule';
        }

        if (self::hasReservationConflict($venueId, $tanggalMulai, $tanggalSelesai, $waktuMulai, $waktuSelesai, $excludeReservationId)) {
            return 'reservation';
        }

        return null;
    }

    public static function checkApprovalConflict(
        int $venueId,
        string $tanggalMulai,
        string $tanggalSelesai,
        string $waktuMulai,
        string $waktuSelesai,
        ?int $excludeReservationId = null
    ): ?string {
        $newStart = $tanggalMulai . ' ' . $waktuMulai . ':00';
        $newEnd = $tanggalSelesai . ' ' . $waktuSelesai . ':00';

        $manualScheduleConflict = VenueSchedule::where('venue_id', $venueId)
            ->whereIn('jenis', ['offline', 'internal', 'blocked'])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_mulai, ' ', waktu_mulai), '%Y-%m-%d %H:%i:%s') < ?", [$newEnd])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_selesai, ' ', waktu_selesai), '%Y-%m-%d %H:%i:%s') > ?", [$newStart])
            ->exists();

        if ($manualScheduleConflict) {
            return 'schedule';
        }

        $approvedReservationConflict = Reservation::where('venue_id', $venueId)
            ->where('status', 'approved')
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_mulai, ' ', waktu_mulai), '%Y-%m-%d %H:%i:%s') < ?", [$newEnd])
            ->whereRaw("STR_TO_DATE(CONCAT(tanggal_selesai, ' ', waktu_selesai), '%Y-%m-%d %H:%i:%s') > ?", [$newStart]);

        if ($excludeReservationId) {
            $approvedReservationConflict->where('id', '!=', $excludeReservationId);
        }

        if ($approvedReservationConflict->exists()) {
            return 'reservation';
        }

        return null;
    }
}
