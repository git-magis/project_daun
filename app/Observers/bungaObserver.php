<?php

namespace App\Observers;

use App\Models\Bunga;

class bungaObserver
{
    /**
     * Handle the Bunga "created" event.
     */
    public function created(Bunga $bunga)
    {
        $bunga->load(['jenisBunga', 'taman']);

        $count = Bunga::where('jenisb_id', $bunga->jenisb_id)
                        ->where('lokasib_id', $bunga->lokasib_id)
                        ->count();

        $counters = [
            $bunga->jenisb_id. '-' . $bunga->lokasib_id => $count
        ];

        $kodeUnik = Bunga::generateUniqueCode($bunga, $counters);

        $bunga->updateQuietly([
            'kode_unik' => $kodeUnik
        ]);
    }

    /**
     * Handle the Bunga "updated" event.
     */
    public function updated(Bunga $bunga)
    {
        if ($bunga->wasChanged(['jenisb_id', 'lokasib_id'])) {
            $bunga->load(['jenisBunga', 'taman']);

            $count = Bunga::where('jenisb_id', $bunga->jenisb_id)
                            ->where('lokasib_id', $bunga->lokasib_id)
                            ->count();

            $counters = [
                $bunga->jenisb_id. '-' . $bunga->lokasib_id => $count
            ];

            $kodeUnik = Bunga::generateUniqueCode($bunga, $counters);

            $bunga->updateQuietly([
                'kode_unik' => $kodeUnik
            ]);
        }
    }

    /**
     * Handle the Bunga "deleted" event.
     */
    public function deleted(Bunga $bunga): void
    {
        //
    }

    /**
     * Handle the Bunga "restored" event.
     */
    public function restored(Bunga $bunga): void
    {
        //
    }

    /**
     * Handle the Bunga "force deleted" event.
     */
    public function forceDeleted(Bunga $bunga): void
    {
        //
    }
}
