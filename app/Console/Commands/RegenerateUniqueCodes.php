<?php

namespace App\Console\Commands;

use App\Models\Bunga;
use Illuminate\Console\Command;
use App\Models\Pohon;

class RegenerateUniqueCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:regenerate-unique-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate unique codes for Pohon and Bunga models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Regenerate for Pohons
        // Pohon::all()->each(function ($pohon) {
        //     $pohon->update(['kode_unik' => Pohon::generateUniqueCode($pohon)]);
        // });

        // Regenerate for Pohons
        $pohons = Pohon::orderBy('lokasi_id')->orderBy('jenis_id')->get();
        $pohonCounters = [];

        foreach ($pohons as $pohon) {
            $uniqueCode = Pohon::generateUniqueCode($pohon, $pohonCounters);

            if ($uniqueCode) {
                $pohon->kode_unik = $uniqueCode;
                $pohon->save();

                // dd('Saved:', $pohon);
            }
        }

        // Regenerate for Bungas
        $bungas = Bunga::orderBy('lokasib_id')->orderBy('jenisb_id')->get();
        $bungaCounters = [];

        foreach ($bungas as $bunga) {
            $uniqueCode = Bunga::generateUniqueCode($bunga, $bungaCounters);

            if ($uniqueCode) {
                $bunga->kode_unik = $uniqueCode;
                $bunga->save();

                // dd('Saved:', $bunga);
            }
        }

        $this->info('Unique codes regenerated successfully for Pohons and Bungas.');

    }
}
