<?php

namespace App\Jobs;

use App\Models\Apartement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApartementCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apartment=Apartement::create([
            'id'=>$this->data['id'],
            'title'=>$this->data['title'],
            'photo'=>$this->data['photo'],
            'descreption'=>$this->data['descreption'],
            'extrainfo'=>$this->data['extrainfo'],
            'price'=>$this->data['price'],
            'maxguests'=>$this->data['maxguests'],
            'type'=>$this->data['type'],
            'wilaya'=>$this->data['wilaya'],
            'commune'=>$this->data['commune'],


        ]);
    }
}
