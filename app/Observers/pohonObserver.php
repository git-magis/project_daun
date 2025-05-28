<?php

namespace App\Observers;

use App\Models\Pohon;

class pohonObserver
{
    /**
     * Handle the Pohon "created" event.
     */
    public function created(Pohon $pohon)
    {
        $pohon->load(['jenisPohon', 'taman']);

        $count = Pohon::where('jenis_id', $pohon->jenis_id)
                        ->where('lokasi_id', $pohon->lokasi_id)
                        ->count();

        $counters = [
            $pohon->jenis_id . '-' . $pohon->lokasi_id => $count
        ];

        $kodeUnik = Pohon::generateUniqueCode($pohon, $counters);

        $pohon->updateQuietly([
            'kode_unik' => $kodeUnik
        ]);
    }

    /**
     * Handle the Pohon "updated" event.
     */
    public function updated(Pohon $pohon)
    {
        if($pohon->wasChanged(['jenis_id', 'lokasi_id'])) {
            $pohon->load(['jenisPohon', 'taman']);

            $count = Pohon::where('jenis_id', $pohon->jenis_id)
                            ->where('lokasi_id', $pohon->lokasi_id)
                            ->count();

            $counters = [
                $pohon->jenis_id . '-' . $pohon->lokasi_id => $count
            ];

            $kodeUnik = Pohon::generateUniqueCode($pohon, $counters);

            $pohon->updateQuietly([
                'kode_unik' => $kodeUnik
            ]);
        }
    }

    /**
     * Handle the Pohon "deleted" event.
     */
    public function deleted(Pohon $pohon): void
    {
        //
    }

    /**
     * Handle the Pohon "restored" event.
     */
    public function restored(Pohon $pohon): void
    {
        //
    }

    /**
     * Handle the Pohon "force deleted" event.
     */
    public function forceDeleted(Pohon $pohon): void
    {
        //
    }
}
