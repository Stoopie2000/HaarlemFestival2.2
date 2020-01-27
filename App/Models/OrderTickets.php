<?php


namespace App\Models;
use Core\Model;
use PDO;

/**
 * Class OrderTickets
 * @package App\Models
 *
 * @property User UserID
 * @property int ConcertID
 * @property int OrderID
 * @property string Status
 * @property DateTime OrderDate
 * @property int Quantity
 */
class OrderTickets extends Model
{

    public function __construct($data = [])
    {

        foreach ($data as $key => $value) {
            $this->$key = $value;
        };

        if (isset($this->UserID)) {
            $this->User = User::get_by_id($this->UserID);
        }
        if (isset($this->OrderDate)) {
            $this->OrderDate = date_create($this->OrderDate);
        }
    }

    public static function get_all()
    {
        $sql = 'SELECT * FROM orders_tickets';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $artists = $stmt->fetchAll();
    }

    public static function get_quantity()
    {
        $sql = "SELECT COUNT(OrderID) AS 'Number' FROM orders_tickets";
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $stmt->fetch();
    }
}