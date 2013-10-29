<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class pdf {
 
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
        if ($params == NULL)
        {
            $param = '"en-GB-x","Letter","","",12.7,12.7,14,12.7,8,8';
        }
 
        return new mPDF($param);
    }
}