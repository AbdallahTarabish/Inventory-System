<?php

namespace App\Jobs;

use App\Models\Sector;
use App\Models\Shelf;
use App\Models\SubSector;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoSortStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $sector_count;
    public $sub_sector_count;
    public $shelf_count;
    public $main_store_id;
    public $sub_store_id;

    public function __construct($sector_count, $sub_sector_count, $shelf_count, $main_store_id, $sub_store_id)
    {
        $this->sector_count = $sector_count;
        $this->sub_sector_count = $sub_sector_count;
        $this->shelf_count = $shelf_count;
        $this->main_store_id = $main_store_id;
        $this->sub_store_id = $sub_store_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sector_name = 'A';
        $sector_count = 0;
        while ($sector_count != $this->sector_count) {
            $sector_count++;
            $sector = Sector::query()->create([
                'name' => $sector_name,
                'main_store_id' => $this->main_store_id,
                'store_id' => $this->sub_store_id,
                'isFilled' => -1
            ]);
            $sector_name++;

            $sub_sector_name = 1;
            $sub_sector_count = 0;
            while ($sub_sector_count != $this->sub_sector_count) {
                $sub_sector_count++;

                $sub_sector = SubSector::query()->create([
                    'name' => $sub_sector_name,
                    'sector_id' => $sector->id,
                    'isFilled' => -1

                ]);
                $sub_sector_name++;
                $shelf_name = 1;
                $shelf_count = 0;
                while ($shelf_count != $this->shelf_count) {
                    $shelf_count++;
                    Shelf::query()->create([
                        'name' => $shelf_name,
                        'sector_id' => $sector->id,
                        'sub_sector_id' => $sub_sector->id,
                        'isFilled' => -1
                    ]);
                    $shelf_name++;
                }
            }


        }
    }
}
