<?php


namespace App\Models;

use Core\Model;
use DateTime;
use PDO;

/**
 * @property string Day
 */
class DayTicket extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        if (isset($this->Day)) {
            $this->Day = DateTime::createFromFormat('Y-m-d', $this->Day)->format('l d F');
        }

    }
    public static function get_all()
    {
        $sql = 'SELECT * FROM day_tickets';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $dayTickets = $stmt->fetchAll();
    }
}
