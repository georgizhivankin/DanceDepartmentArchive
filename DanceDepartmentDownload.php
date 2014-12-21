<?php
namespace Zhivankin\DanceDepartmentArchive;

class DanceDepartmentDownload
{
    
    /** function downloadM3u
     * 
     * @param unknown $results
     * @param string $name
     * @return string
     */
    public function downloadM3u($results, $name = NULL)
    {
        if (! $name) {
            $name = md5(uniqid() . microtime(TRUE) . mt_rand()) . '.m3u';
        }
        if (!$results) {
            exit('File could not be created');
        }
        // create the file
        header('Content-Description: File Transfer');
            header('Content-Type: application/m3u');
        header('Content-Disposition: attachment; filename=' . $name);
        header('Content-Length: ' . strlen($results));
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $results;

        // Stop script's execution
        exit();
    }
}
ob_start();
// Instantiate this class
$danceDepartmentDownload = new DanceDepartmentDownload();
// Get $name and $results from the $_REQUEST
$name = urldecode($_REQUEST['name']);
$results = urldecode($_REQUEST['results']);
// Execute the download function and output its result
$danceDepartmentDownload->downloadM3u($results, $name);
ob_end_flush();
