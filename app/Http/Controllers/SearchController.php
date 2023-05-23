<?php

namespace App\Http\Controllers;

use App\jobs\ApartementCreated;
use App\Jobs\ApartementCreated as JobsApartementCreated;
use App\Models\Apartement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function create (Request $request){
        return view('create');
    }

    public function store (Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $photo = $request->input('photo');
        $desc = $request->input('desc');
        $extra = $request->input('extra');
        $price = $request->input('price');
        $selectedPerks = $request->input('perks',[]);
        $ming = $request->input('ming');
        $type = $request->input('type');
        $wilaya = $request->input('wilaya');
        $commune = $request->input('commune');

        $apartement = new Apartement;

        $apartement->id=$id;
        $apartement->title=$title;
        $apartement->photo=$photo;
        $apartement->descreption=$desc;
        $apartement->extrainfo=$extra;
        $apartement->price=$price;
        $apartement->maxguests=$ming;
        $apartement->type=$type;
        $apartement->type=$type;
        $apartement->wilaya=$wilaya;
        $apartement->commune=$commune;


        ApartementCreated::dispatch($apartement->toArray());

        return view('create');
    }


    public function search(Request $request)
{
    $minPrice = $request->input('min');
    $maxPrice = $request->input('max');
    $minguests = $request->input('ming');
    $type = $request->input('type');
    $checkin = $request->input('checkin');
    $checkout = $request->input('checkout');
    $selectedPerks = $request->input('perks',[]);
    $wilaya = $request->input('wilaya');
    $commune = $request->input('commune');


    $apartments = DB::table('appartements');
    if ($request->filled('min')) {
        $apartments = $apartments->where('price','>=',$minPrice);
    }

    if ($request->filled('max')) {
        $apartments = $apartments->where('price','<=',$maxPrice);
    }

    if ($request->filled(['ming'])) {
        $apartments=$apartments->where('maxguests','>=',$minguests);
    }

    if ($request->filled(['type'])) {
        $apartments=$apartments->where('type','=',$type);
    }

    if ($request->filled(['wilaya'])) {
        $apartments=$apartments->where('wilaya','=',$wilaya);
    }

    if ($request->filled(['commune'])) {
        $apartments=$apartments->where('commune','=',$commune);
    }

    if ($request->filled(['perks'])){

        $apartments=$apartments->where(function ($query) use ($selectedPerks) {
        foreach ($selectedPerks as $perk) {
            $query->whereJsonContains('perks', [$perk]);
        }
    });
    }
   
    if ($request->filled(['checkin','checkout'])) {
        $checkInDate = $request->input('checkin');
        $checkOutDate = $request->input('checkout');
        $apartments =$apartments
        ->leftJoin('reservations', function ($join) use ($checkInDate, $checkOutDate) {
        $join->on('appartements.id', '=', 'reservations.id_departement')
             ->where(function ($query) use ($checkInDate, $checkOutDate) {
                 $query->whereBetween('checkin', [$checkInDate, $checkOutDate])
                       ->orWhereBetween('checkout', [$checkInDate, $checkOutDate])
                       ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                           $query->where('checkin', '<=', $checkInDate)
                                 ->where('checkout', '>=', $checkOutDate);
                       });
             });
    })
    ->whereNull('reservations.id_departement');
    }

    $apartements=$apartments->get();

    dd( $apartements );
    return view('search', compact('apartements', 'minPrice', 'maxPrice'));
}
}
