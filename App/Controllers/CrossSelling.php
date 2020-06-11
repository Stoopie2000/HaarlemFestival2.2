<?php


namespace App\Controllers;


use App\Models\Concert;
use App\Models\Event;
use Core\Controller;
use Core\View;

class CrossSelling extends Controller
{
    function indexAction(){

        $basketItems = $_SESSION['basket']->items;
        $itemsMetStartEnEindTijd = [];
//        foreach ($basketItems as $basketItem){
//            if (isset($basketItem->Item->StartTime) && isset($basketItem->Item->EndTime)){
//                $basketItem->Item->color = $this->rand_color();
//                $itemsMetStartEnEindTijd[] =  $basketItem->Item;
//            }
//        }

        foreach ($basketItems as $basketItem){
            if (isset($basketItem->Item->StartTime) && isset($basketItem->Item->EndTime)){
                $basketItem->Item->color = $this->rand_color();
                $itemsMetStartEnEindTijd[] =  $basketItem->Item;
            }
        }

        $itemsMetStartEnEindTijd[] = "StartTime\":{\"date\":\"2020-06-11 20:00:00.000000\",\"timezone_type\":3,\"timezone\":\"Europe\/Berlin\"}";

        dump(json_encode( $itemsMetStartEnEindTijd));

        usort($itemsMetStartEnEindTijd, function($a, $b) {
            return $a->StartTime->format('U') - $b->StartTime->format('U');
        });

        dump(json_encode($itemsMetStartEnEindTijd));

//        $concertsMetEindTijdVoorEersteStartTijd = Concert::get_with_end_time_before();
//        $concertsMetStartTijdNaLaatsteEindTijd = [];

//        View::render('Crossselling/index.php', [
//            'items' => $itemsMetStartEnEindTijd,
//        ]);
    }

    private function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }


    //Zet alle tickets die een user heeft op een tijdlijn

    //Kijk of er tickets zijn die tussen lege vakken op de tijdlijn passen

    //Geef de user een kans om deze tickets toe te voegen aan hun order
}