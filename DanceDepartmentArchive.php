<?php
namespace Zhivankin\DanceDepartmentArchive;

/**
 * Dance Department Class
 * This class aims to provide an easy way of obtaining playlist files for the past 2 episodes of the Dance Department radio show for playing the episodes in Winamp or any other external player that supports the .
 * M3U playlist file format, instead of playing them through the Radio 538 flash player provided at the Dance Department website
 *
 * @author Georgi Zhivankin
 *         @website http://www.zhivankin.com/
 * @license GPL V 3
 *          @Version 1.0
 *          @Date 03 November 2014
 */
class DanceDepartmentArchive
{

    /**
     * function generateDates
     *
     * @return array
     */
    public function generateDates()
    {
        // First, set the time zone to GMT+01:00 (local time in Amsterdam, The Netherlands)
        date_default_timezone_set('UTC+1');
        // Get current date and time
        $currentDateTime = time();
        // Get last Saturday and the Saturday before
        $lastSaturday = strtotime('Last Saturday', $currentDateTime);
        $previousSaturday = strtotime('last Saturday -1 week', $currentDateTime);
        // echo "Last Saturday: ".date('l d/m/Y', $lastSaturday)."<br/>";
        // echo "Previous Saturday: ".date('l d/m/Y', $previousSaturday)."<br/>";
        
        // Add the two dates to an array that will be used to generate the URLs for the playlists to the archive
        $dates = array(
            $lastSaturday,
            $previousSaturday
        );
        // Return the dates
        return $dates;
    }

    /**
     * function generateHourURLSegments
     *
     * @param int $date            
     * @return string
     */
    public function generateHourURLSegments($date)
    {
        // Generate proper URL segments for the 4 hours of the show
        $i = 20;
        $j = 23;
        while ($i <= $j) {
            $segmentDates[] = date('Ymd', $date) . "%20" . $i . "00";
            $i ++;
        }
        // Return the generated segments
        return $segmentDates;
    }

    /**
     * function generatePlaylistURLs
     *
     * @return string
     */
    public function generatePlaylistURLs()
    {
        // URL chunk
        $urlChunk = 'http://media2.538.nl/uitzendingen/%5BListenBack_RADIO538%20%28DAGELIJKS%29%5D%20538-ZATERDAG%20';
        // Get dates
        $dates = self::generateDates();
        // Generate hour segments for each date
        foreach ($dates as $date) {
            $hourSegments[$date] = self::generateHourURLSegments($date);
        }
        // Generate URLs for each date and segment
        foreach ($hourSegments as $date => $hourSegments) {
            foreach ($hourSegments as $hourSegment) {
                // Generate URLs
                $playlistURLs[$date][] = $urlChunk . $hourSegment . ".MP3";
            }
        }
        // Return the generated playlist URLs
        return $playlistURLs;
    }

    /**
     * function generatePlaylist
     *
     * @param array $urls            
     * @return string
     */
    public function generatePlaylist(array $urls)
    {
        // Get all playlist URLs and generate an .m3u file
        $m3uFile = "#EXTM3U";
        foreach ($urls as $url) {
            $m3uFile .= sprintf("
                #EXTINF:-1, %1\$s
                %1\$s", $url);
        }
        // Return the M3U file
        return $m3uFile;
    }
}
