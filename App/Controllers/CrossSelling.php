<?php
//
//
//namespace App\Controllers;
//
//
//use App\Models\Concert;
//use App\Models\Event;
//use App\Models\TimeLine;
//use Core\Controller;
//use Core\View;
//
//class CrossSelling extends Controller
//{
//    function indexAction(){
//        $basketItems = $_SESSION['basket']->items;
//        $itemsMetStartEnEindTijd = [];
//
//        foreach ($basketItems as $basketItem){
//            if (isset($basketItem->Item->StartTime) && isset($basketItem->Item->EndTime)){
//                $basketItem->Item->color = $this->rand_color();
//                $itemsMetStartEnEindTijd[] =  $basketItem->Item;
//                $basketItem->Item->getDurationInMinutes();
//            }
//        }
//
//        $timeline = new TimeLine([
//            'Tickets' => $itemsMetStartEnEindTijd
//        ]);
//
//        View::render('Crossselling/index.php', [
//            'timeline' => $timeline
//        ]);
//    }
//
//    private function rand_color() {
//        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
//    }
//
//    //Zet alle tickets die een user heeft op een tijdlijn
//
//    //Kijk of er tickets zijn die tussen lege vakken op de tijdlijn passen
//
//    //Geef de user een kans om deze tickets toe te voegen aan hun order
//}