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
        $bungas = Bunga::orderBy('lokasib_id')->orderBy('jenisb_id')->get();
        $bungaCounters = [];

        foreach ($bungas as $bunga) {
            $uniqueCode = Bunga::generateUniqueCode($bunga, $bungaCounters);

            if ($uniqueCode) {
                $bunga->kode_unik = $uniqueCode;
                $bunga->save();

            }
        }
    }

    /**
     * Handle the Bunga "updated" event.
     */
    public function updated(Bunga $bunga)
    {
        $bungas = Bunga::orderBy('lokasib_id')->orderBy('jenisb_id')->get();
        $bungaCounters = [];

        foreach ($bungas as $bunga) {
            $uniqueCode = Bunga::generateUniqueCode($bunga, $bungaCounters);

            if ($uniqueCode) {
                $bunga->kode_unik = $uniqueCode;
                $bunga->save();

            }
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
