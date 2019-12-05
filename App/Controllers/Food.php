<?php

namespace App\Controllers;

use \Core\View;

// Verander de 'Template' met de naam van je eigen controller
class Food extends \Core\Controller
{

    /**
     * Voor iedere Action maak je hier een niewe methode aan.
     */

    // Dit is de Action 'index', de naam van deze methode is dus de naam van je Action met 'Action' erachter.
    public function indexAction()
    {
        // Wat je mee geeft met deze methode is de Path naar de view 'index', de Path is vanuit de Views map.
        View::render('Food/Food.php');
    }

}
