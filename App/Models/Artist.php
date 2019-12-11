<?php


namespace App\Models;
use Core\Model;
use PDO;

/**
 * Class Artist
 * @package App\Models
 *
 * @property int ArtistID
 * @property array Concerts
 */
class Artist extends Model
{
    /**
     * Artist constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Get all the artists as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM artists WHERE Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, ['dance']);
        return $artists = $stmt->fetchAll();
    }

    public static function get_from_ID($artistID)
    {
        $sql = 'SELECT * FROM artists WHERE ArtistID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$artistID]);
        return $artist = $stmt->fetch();
    }

    public static function find_by_name($artistName)
    {
        $sql = 'SELECT * FROM artists WHERE Name like ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$artistName]);
        return $artist = $stmt->fetch();
    }

    public function get_concerts()
    {
        $concerts = Concert::get_for_artist($this->ArtistID);
        return $concerts;
    }
}