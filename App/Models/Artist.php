<?php


namespace App\Models;
use Core\Model;
use PDO;

/**
 * Class Artist
 * @package App\Models
 *
 * @property int ArtistID
 * @author Bram Bos <brambos27@gmail.com>
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
     * @param string $event
     * @return array
     */
    public static function getAll($event)
    {
        $sql = 'SELECT * FROM artists WHERE Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$event]);
        return $artists = $stmt->fetchAll();
    }

    public static function get_by_ID($artistID)
    {
        $sql = 'SELECT * FROM artists WHERE ArtistID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$artistID]);
        return $artist = $stmt->fetch();
    }

    public static function find_by_name_and_event($artistName, $event)
    {
        $sql = 'SELECT * FROM artists WHERE Name like ? AND Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$artistName, $event]);
        return $artist = $stmt->fetch();
    }

    public function get_concerts()
    {
        return Concert::get_for_artist($this->ArtistID);
    }

    public static function edit_artist($id, $name, $description, $event){
        $sql = 'UPDATE artists SET Name = ?, Description = ?, Event = ? WHERE ArtistID = ?';
        self::execute_edit_query($sql, [$name, $description, $event, $id]);
    }

    public static function add_artist($name, $description, $event){
        $sql = 'INSERT INTO artists (Name, Description, Event) VALUES (?, ?, ?)';
        self::execute_edit_query($sql, [$name, $description, $event]);
    }

    public static function delete_artist($id){
        $sql = 'DELETE FROM artists WHERE ArtistID = ?';
        self::execute_edit_query($sql, [$id]);
    }
}