<?php


namespace App\Models;

use Core\Model;

/**
 * Class BasketItem
 * @package App\Models
 * @property mixed $Item The thing that's being put in the basket. e.g. A concert object.
 * @property string Description Description of the item
 * @property string Name Name of the Item
 * @property string Extra Extra information to be displayed in the basket
 * @property int Quantity
 * @property float Price
 *
 * @author Bram Bos <brambos27@gmail.com>
 */
class BasketItem extends Model
{
    public $Item;
    public $Description;
    public $Name;
    public $Extra;
    public $Quantity;
    public $Price;
    public $ItemID;

    public function update_quantity($itemId, $newQuantity)
    {

    }
}