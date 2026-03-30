<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use Carbon\Carbon;

class AutoCheckout extends Command
{
    /**
     * Nama perintah artisan
     */
    protected $signature = 'attendance:auto-checkout';

    /**
     * Deskripsi command
     */
    protected $description = 'Otomatis checkout bagi user yang belum checkout di hari sebelumnya (Asia/Makassar)';

    /**
     * Eksekusi perintah
     */
    public function handle()
    {
        $now = Carbon::now('Asia/Makassar')->toDateString();

        // Ambil semua absensi yang belum checkout dan tanggalnya sebelum hari ini
        $records = Attendance::whereNull('jam_keluar')->where('attendance_date', '<', $now)->get();

        if ($records->isEmpty()) {
            $this->info('✅ Tidak ada absensi yang perlu di-checkout otomatis.');
            return 0;
        }

        foreach ($records as $record) {
            $record->update([
                'jam_keluar' => '23:59:59',
                'status' => 'auto-checkout',
                'keterangan' => "Checkout otomatis dilakukan oleh sistem pada tanggal {$record->attendance_date} pukul 23:59 WITA.",
            ]);

            $this->info(
                "✔️ User: {$record->nama} ({$record->nip}) tanggal {$record->attendance_date} di-checkout otomatis.",
            );
        }

        $this->newLine();
        $this->info('🎯 Total: ' . count($records) . ' absensi otomatis di-checkout oleh sistem.');
        return 0;
    }
}
