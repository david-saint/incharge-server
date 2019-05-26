<?php

namespace App\Helpers;


class CSVImporter 
{
    /**
     * The csv file we are handling.
     * 
     * @var [type]
     */
    private $fp;

    private $parse_header; 

    private $header; 

    private $delimiter; 

    private $length; 

    /**
     * Initialize the csvimporter with
     * @param [type]  $file_name    [description]
     * @param boolean $parse_header [description]
     * @param string  $delimiter    [description]
     * @param integer $length       [description]
     */
    public function __construct($file_name, $parse_header=false, $delimiter=",", $length=8000) 
    { 
        $this->fp = fopen($file_name, "r"); 
        $this->parse_header = $parse_header;
        $this->delimiter = $delimiter;
        $this->length = $length;

        if ($this->parse_header) 
        { 
           $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
        } 

    }

    /**
     * [__destruct description]
     */
    public function __destruct() 
    { 
        if ($this->fp) 
        { 
            fclose($this->fp); 
        } 
    }

    /**
     * [get description]
     * @param  integer $max_lines [description]
     * @return [type]             [description]
     */
    function get($max_lines=0) 
    { 
        //if $max_lines is set to 0, then get all the data 
        $data = array(); 

        if ($max_lines > 0) 
            $line_count = 0; 
        else 
            $line_count = -1; // so loop limit is ignored 

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) {
            if ($this->parse_header) { 
                foreach ($this->header as $i => $heading_i) { 
                    $row_new[$heading_i] = $row[$i]; 
                } 

                $data[] = $row_new; 

            } else {
                $data[] = $row;
            }

            if ($max_lines > 0)
                $line_count++;
        }

        return $data;
    }
}
