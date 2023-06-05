<?php

namespace App\Console\Commands;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use App\Models\reservation;
use Nette\Utils\DateTime;
use App\Models\Apartement;

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
                case 'AppartementCreatedEvent':
                    $apartement=new Apartement;
                    $apartement->id=$newEvent["body"]["_id"];
                    $apartement->title=$newEvent["body"]["title"];
                    $apartement->wilaya=$newEvent["body"]["wilaya"];
                    $apartement->commune=$newEvent["body"]["comun"];
                    $jsonDataperks = json_encode($newEvent["body"]["perks"]);
                    $apartement->perks=$jsonDataperks;
                    $apartement->descreption=$newEvent["body"]["description"];
                    $apartement->extrainfo=$newEvent["body"]["extraInfo"];
                    $apartement->price=$newEvent["body"]["price"];
                    $jsonDatatype = json_encode($newEvent["body"]["apartementType"]);
                    $apartement->type=$jsonDatatype;
                    $apartement->maxguests=$newEvent["body"]["maxGuests"];
                    $apartement->save();

                    break;
                case 'AppartementUpdateEvent':
                    $id=$newEvent["body"]["_id"];
                    $apartement=Apartement::find($id);
                    $apartement->title=$newEvent["body"]["title"];
                    $apartement->wilaya=$newEvent["body"]["wilaya"];
                    $apartement->commune=$newEvent["body"]["comun"];
                    $jsonDataperks = json_encode($newEvent["body"]["perks"]);
                    $apartement->perks=$jsonDataperks;
                    $apartement->descreption=$newEvent["body"]["description"];
                    $apartement->extrainfo=$newEvent["body"]["extraInfo"];
                    $apartement->price=$newEvent["body"]["price"];
                    $jsonDatatype = json_encode($newEvent["body"]["apartementType"]);
                    $apartement->type=$jsonDatatype;
                    $apartement->maxguests=$newEvent["body"]["maxGuests"];
                    $apartement->save();
                    break;

                    case 'RemoveAppartementEvent':
                        $id=$newEvent["body"]["_id"];
                        $apartement=Apartement::find($id);
                        $apartement->delete();
                        break;
                    case 'ReservationupdateEvent':
                        $id=$newEvent["body"]["EventId"];
                        $reservation=reservation::find($id);
                        $reservation->id_apartement=$newEvent["body"]["appartement"];
                        $checkin = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $newEvent["body"]["checkIn"]);
                        $reservation->checkin=$checkin;
                        $checkout = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $newEvent["body"]["checkOut"]);
                        $reservation->checkout=$checkout;
                        $reservation->save();
                        break;
                    case 'RemoveReservationEvent':
                        $id=$newEvent["body"]["EventId"];
                        $reservation=reservation::find($id);
                        $reservation->delete();
                        break;
                default:
                    echo 'It is an unknown event.'.$newEvent["type"];
                    break;
            }
        }
        dd($newEvents);
    }
}
