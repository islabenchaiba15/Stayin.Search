<?php

namespace App\Console\Commands;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use App\Models\reservation;
use Nette\Utils\DateTime;

class MQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqService = new RabbitMQService();
        $newEvents = $mqService->consume();

        foreach ($newEvents as $newEvent) {
            switch ($newEvent["type"]) {
                case 'ReservationCreatedEvent':
                   $reservation =new reservation;
                   $reservation->id=$newEvent["body"]["EventId"];
                   $reservation->id_apartement=$newEvent["body"]["appartement"];
                   $checkin = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $newEvent["body"]["checkIn"]);
                   $reservation->checkin=$checkin;
                   $checkout = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $newEvent["body"]["checkOut"]);
                   $reservation->checkout=$checkout;
                   $reservation->save();
                    break;
                default:
                    echo 'It is an unknown event.'.$newEvent["type"];
                    break;
            }
        }
        dd($newEvents);
    }
}
