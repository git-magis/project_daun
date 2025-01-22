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
        $pohons = Pohon::orderBy('lokasi_id')->orderBy('jenis_id')->get();
        $pohonCounters = [];

        foreach ($pohons as $pohon) {
            $uniqueCode = Pohon::generateUniqueCode($pohon, $pohonCounters);

            if ($uniqueCode) {
                $pohon->kode_unik = $uniqueCode;
                $pohon->save();

            }
        }
    }

    /**
     * Handle the Pohon "updated" event.
     */
    public function updated(Pohon $pohon)
    {
        $pohons = Pohon::orderBy('lokasi_id')->orderBy('jenis_id')->get();
        $pohonCounters = [];

        foreach ($pohons as $pohon) {
            $uniqueCode = Pohon::generateUniqueCode($pohon, $pohonCounters);

            if ($uniqueCode) {
                $pohon->kode_unik = $uniqueCode;
                $pohon->save();

            }
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
