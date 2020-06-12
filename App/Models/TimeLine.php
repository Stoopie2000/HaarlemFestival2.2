<?php


namespace App\Models;


use Core\Model;


/**
 * Class TimeLine
 * @package App\Models
 * @property \DateTime StartTime
 * @property \DateTime EndTime
 * @property array Tickets
 * @property float|int MinutePerPercentage
 * @author Bram Bos <brambos27@gmail.com>
 */
class TimeLine extends Model
{

    /**
     * TimeLine constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        if (isset($this->Tickets)){
            if (! isset($this->StartTime)){
                $this->StartTime = $this->makeStartTime($this->Tickets);
            }
            if (! isset($this->EndTime)){
                $this->EndTime = $this->makeEndTime($this->Tickets);
            }

            $this->MinutePerPercentage = $this->calculateTimelineMinutePerPercentage();
        }
    }

    private function makeStartTime($tickets)
    {
        //Sort by start time
        usort($tickets, function($a, $b) {
            return $a->StartTime->format('U') - $b->StartTime->format('U');
        });

        $startTimeFirstConcert = $tickets[0]->StartTime;
        $concertsMetEindTijdVoorEersteStartTijd = Concert::get_with_end_time_before($tickets[0]->DateID, $startTimeFirstConcert->format('H:i'));
        var_dump($startTimeFirstConcert->format('H:i'));
        var_dump($concertsMetEindTijdVoorEersteStartTijd);
        die();
        return $timeLineStart = count($concertsMetEindTijdVoorEersteStartTijd) > 0 ? $concertsMetEindTijdVoorEersteStartTijd[0]->StartTime : $startTimeFirstConcert;
    }

    private function makeEndTime($tickets){
        //sort by end time
        usort($tickets, function($a, $b) {
            return $a->EndTime->format('U') - $b->EndTime->format('U');
        });

        /** @var \DateTime $endTimeLastConcert */
        $endTimeLastConcert = end($tickets)->EndTime;
        $concertsMetStartTijdNaLaatsteEindTijd = Concert::get_with_start_time_after(
            end($tickets)->DateID, $endTimeLastConcert->format('H:i'));
        return $timeLineEnd = count($concertsMetStartTijdNaLaatsteEindTijd) > 0 ? end($concertsMetStartTijdNaLaatsteEindTijd)->EndTime : $endTimeLastConcert;
    }

    private function calculateTimelineMinutePerPercentage(){
        $diff = $this->StartTime->diff($this->EndTime);
        if ($diff->invert){
            $diff = $this->StartTime->diff($this->EndTime->modify('+1 day'));
        }
        $timeLineLengthInMinutes =  ($diff->h * 60) + ($diff->i);
        return $timeLineLengthInMinutes / 100;
    }
}