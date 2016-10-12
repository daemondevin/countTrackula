<?php
/**
 * trackulaFile
 * 
 * @package countTrackula
 * @author PortableAppz.cu.cc/
 * @copyright 2016
 * @version 1.0.1
 * @access private
 */
class trackulaFile { 
    public $filename; 
    public $hits; 
    public $hasotherdata; 
    public $data; 

    /**
     * 
     * @return
     */
    function trackulaFile($filename, $hasotherdata = false) { 
        $this->filename = $filename; 
        $this->hasotherdata = $hasotherdata; 
        $file_desc = @fopen($this->filename, 'r'); 
        if ($file_desc == FALSE) { 
            $this->hits = 0; 
            return; 
        } 
        if ($this->hasotherdata) { 
            $fd = fread($file_desc, filesize($this->filename)); 
            $a = explode('\|', $fd); /* Split on NULL char */ 
            $this->hits = intval($a[0]); 
            $this->data = $a[1]; 
        } else { 
            $this->hits = intval(fread($file_desc, filesize($this->filename))); 
        } 
        fclose($file_desc); 
    } 
     
    /**
     * Set ancillary data
     * @return
     */
    function SetData($data) { 
        $this->data = $data; 
    } 
 
    /**
     * Get ancillary data
     * @return
     */
    function GetData() { 
        return $this->data; 
    } 
 
    /**
     * Returns the count as an integer
     * @return
     */
    function Get() { 
        return $this->hits; 
    } 

    /**
     * Increments count value and rewrites hits file
     * @return
     */
    function Increment() { 
        $this->hits++; 
        $file_desc = @fopen($this->filename, 'w'); 
        if ($file_desc != FALSE) { 
            if ($this->hasotherdata) 
                fwrite($file_desc, $this->hits.'|'.$this->data); 
            else 
                fwrite($file_desc, $this->hits); 
            fclose($file_desc); 
        } 
    } 
}; 
