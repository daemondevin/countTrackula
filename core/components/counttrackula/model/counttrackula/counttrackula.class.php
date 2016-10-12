<?php
/**
 * countTrackula
 * 
 * @package countTrackula
 * @author demon.devin
 * @link PortableAppz.cu.cc/
 * @copyright 2016
 * @version 1.0.1
 * @access public
 */
class countTrackula { 
    public $tf;
    public $filename; 
    public $filehash; 
    public $modx;
    public $types;
    
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
        
        $this->modx->addPackage('counttrackula',MODX_CORE_PATH.'/components/counttrackula/model/counttrackula/');
    }
    
    /**
     * countTrackula::countTrackula()
     * 
     * @param mixed $localfilename
     * @param mixed $tfobject
     * @return void
     */
    function countTrackula($localfilename, $tfobject = NULL) {
        if (file_exists($localfilename)) 
            $this->filename = $localfilename; 
        else 
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[countTrackula] Could not find '.$this->filename.'!');

        /* This might run slow, and we better find some cache method for it. */
        //$this->filehash = md5_file($localfilename);

        /* Decide whether we use supplied trackulaFile object or the default */
        if (empty($tfobject)) {
            //require_once('./trackulaFile.class.php');
            if (!$this->modx->loadClass('trackulaFile',MODX_CORE_PATH.'/components/counttrackula/model/counttrackula/',true,true)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR,'[countTrackula] Could not load trackulaFile class.');
                return false;
            } else {
                $this->tf = new trackulaFile($localfilename.".hits", true);
            }
        } else {
            $this->tf = $tfobject;
            $this->filehash = md5_file($localfilename);
        }

        /* Get hash from hits file instead of regenerating it every time. */
        if ($this->tf->GetData()!='') {
            $this->filehash = $this->tf->GetData();
        } else {
            $this->filehash = md5_file($localfilename);
            $this->tf->SetData($this->filehash);
        }

        /* Check query string */
        if (isset($_GET['download'])) {
            if (strcmp($_GET['download'], $this->filehash)==0) {
                if (isset($_GET['resume']))
                    $this->download_resume(basename($this->filename));
                else
                    $this->download(basename($this->filename));
            }
        }
    }
    
    /**
     * countTrackula::download()
     *
     * Sends the file to the browser and
     * increments the hit counter.
     *
     * @param mixed $clientfilename
     */
    function download($clientfilename) {
      
        $this->types = array(
        '323'      =>  'text/h323',
        '*'        =>  'application/octet-stream',
        'acx'      =>  'application/internet-property-stream',
        'ai'       =>  'application/postscript',
        'aif'      =>  'audio/x-aiff',
        'aifc'     =>  'audio/x-aiff',
        'aiff'     =>  'audio/x-aiff',
        'asf'      =>  'video/x-ms-asf',
        'asr'      =>  'video/x-ms-asf',
        'asx'      =>  'video/x-ms-asf',
        'au'       =>  'audio/basic',
        'avi'      =>  'video/x-msvideo',
        'axs'      =>  'application/olescript',
        'bas'      =>  'text/plain',
        'bcpio'    =>  'application/x-bcpio',
        'bin'      =>  'application/octet-stream',
        'bmp'      =>  'image/bmp',
        'c'        =>  'text/plain',
        'cat'      =>  'application/vnd.ms-pkiseccat',
        'cdf'      =>  'application/x-cdf',
        'cdf'      =>  'application/x-netcdf',
        'cer'      =>  'application/x-x509-ca-cert',
        'class'    =>  'application/octet-stream',
        'clp'      =>  'application/x-msclip',
        'cmx'      =>  'image/x-cmx',
        'cod'      =>  'image/cis-cod',
        'cpio'     =>  'application/x-cpio',
        'crd'      =>  'application/x-mscardfile',
        'crl'      =>  'application/pkix-crl',
        'crt'      =>  'application/x-x509-ca-cert',
        'csh'      =>  'application/x-csh',
        'css'      =>  'text/css',
        'dcr'      =>  'application/x-director',
        'der'      =>  'application/x-x509-ca-cert',
        'dir'      =>  'application/x-director',
        'dll'      =>  'application/x-msdownload',
        'dms'      =>  'application/octet-stream',
        'doc'      =>  'application/msword',
        'dot'      =>  'application/msword',
        'dvi'      =>  'application/x-dvi',
        'dxr'      =>  'application/x-director',
        'eps'      =>  'application/postscript',
        'etx'      =>  'text/x-setext',
        'evy'      =>  'application/envoy',
        'exe'      =>  'application/octet-stream',
        'fif'      =>  'application/fractals',
        'flr'      =>  'x-world/x-vrml',
        'gif'      =>  'image/gif',
        'gtar'     =>  'application/x-gtar',
        'gz'       =>  'application/x-gzip',
        'h'        =>  'text/plain',
        'hdf'      =>  'application/x-hdf',
        'hlp'      =>  'application/winhlp',
        'hqx'      =>  'application/mac-binhex40',
        'hta'      =>  'application/hta',
        'htc'      =>  'text/x-component',
        'htm'      =>  'text/html',
        'html'     =>  'text/html',
        'htt'      =>  'text/webviewhtml',
        'ico'      =>  'image/x-icon',
        'ief'      =>  'image/ief',
        'iii'      =>  'application/x-iphone',
        'ins'      =>  'application/x-internet-signup',
        'isp'      =>  'application/x-internet-signup',
        'jfif'     =>  'image/pipeg',
        'jpe'      =>  'image/jpeg',
        'jpeg'     =>  'image/jpeg',
        'jpg'      =>  'image/jpeg',
        'js'       =>  'application/x-javascript',
        'latex'    =>  'application/x-latex',
        'lha'      =>  'application/octet-stream',
        'lsf'      =>  'video/x-la-asf',
        'lsx'      =>  'video/x-la-asf',
        'lzh'      =>  'application/octet-stream',
        'm13'      =>  'application/x-msmediaview',
        'm14'      =>  'application/x-msmediaview',
        'm3u'      =>  'audio/x-mpegurl',
        'man'      =>  'application/x-troff-man',
        'mdb'      =>  'application/x-msaccess',
        'me'       =>  'application/x-troff-me',
        'mht'      =>  'message/rfc822',
        'mhtml'    =>  'message/rfc822',
        'mka'      =>  'audio/x-matroska',
        'mkv'      =>  'video/x-matroska',
        'mk3d'     =>  'video/x-matroska-3d',
        'mid'      =>  'audio/mid',
        'mny'      =>  'application/x-msmoney',
        'mov'      =>  'video/quicktime',
        'movie'    =>  'video/x-sgi-movie',
        'mp2'      =>  'video/mpeg',
        'mp3'      =>  'audio/mpeg',
        'mp4'      =>  'video/mp4',
        'mpa'      =>  'video/mpeg',
        'mpe'      =>  'video/mpeg',
        'mpeg'     =>  'video/mpeg',
        'mpg'      =>  'video/mpeg',
        'mpp'      =>  'application/vnd.ms-project',
        'mpv2'     =>  'video/mpeg',
        'ms'       =>  'application/x-troff-ms',
        'msg'      =>  'application/vnd.ms-outlook',
        'mvb'      =>  'application/x-msmediaview',
        'nc'       =>  'application/x-netcdf',
        'nws'      =>  'message/rfc822',
        'oda'      =>  'application/oda',
        'p10'      =>  'application/pkcs10',
        'p12'      =>  'application/x-pkcs12',
        'p7b'      =>  'application/x-pkcs7-certificates',
        'p7c'      =>  'application/x-pkcs7-mime',
        'p7m'      =>  'application/x-pkcs7-mime',
        'p7r'      =>  'application/x-pkcs7-certreqresp',
        'p7s'      =>  'application/x-pkcs7-signature',
        'pbm'      =>  'image/x-portable-bitmap',
        'pdf'      =>  'application/pdf',
        'pfx'      =>  'application/x-pkcs12',
        'pgm'      =>  'image/x-portable-graymap',
        'pko'      =>  'application/ynd.ms-pkipko',
        'pma'      =>  'application/x-perfmon',
        'pmc'      =>  'application/x-perfmon',
        'pml'      =>  'application/x-perfmon',
        'pmr'      =>  'application/x-perfmon',
        'pmw'      =>  'application/x-perfmon',
        'pnm'      =>  'image/x-portable-anymap',
        'pot'      =>  'application/vnd.ms-powerpoint',
        'ppm'      =>  'image/x-portable-pixmap',
        'pps'      =>  'application/vnd.ms-powerpoint',
        'ppt'      =>  'application/vnd.ms-powerpoint',
        'prf'      =>  'application/pics-rules',
        'ps'       =>  'application/postscript',
        'pub'      =>  'application/x-mspublisher',
        'qt'       =>  'video/quicktime',
        'ra'       =>  'audio/x-pn-realaudio',
        'ram'      =>  'audio/x-pn-realaudio',
        'ras'      =>  'image/x-cmu-raster',
        'rgb'      =>  'image/x-rgb',
        'rmi'      =>  'audio/mid',
        'roff'     =>  'application/x-troff',
        'rtf'      =>  'application/rtf',
        'rtx'      =>  'text/richtext',
        'scd'      =>  'application/x-msschedule',
        'sct'      =>  'text/scriptlet',
        'setpay'   =>  'application/set-payment-initiation',
        'setreg'   =>  'application/set-registration-initiation',
        'sh'       =>  'application/x-sh',
        'shar'     =>  'application/x-shar',
        'sit'      =>  'application/x-stuffit',
        'snd'      =>  'audio/basic',
        'spc'      =>  'application/x-pkcs7-certificates',
        'spl'      =>  'application/futuresplash',
        'src'      =>  'application/x-wais-source',
        'sst'      =>  'application/vnd.ms-pkicertstore',
        'stl'      =>  'application/vnd.ms-pkistl',
        'stm'      =>  'text/html',
        'sv4cpio'  =>  'application/x-sv4cpio',
        'sv4crc'   =>  'application/x-sv4crc',
        'svg'      =>  'image/svg+xml',
        'swf'      =>  'application/x-shockwave-flash',
        't'        =>  'application/x-troff',
        'tar'      =>  'application/x-tar',
        'tcl'      =>  'application/x-tcl',
        'tex'      =>  'application/x-tex',
        'texi'     =>  'application/x-texinfo',
        'texinfo'  =>  'application/x-texinfo',
        'tgz'      =>  'application/x-compressed',
        'tif'      =>  'image/tiff',
        'tiff'     =>  'image/tiff',
        'torrent'  =>  'application/x-bittorrent',
        'tr'       =>  'application/x-troff',
        'trm'      =>  'application/x-msterminal',
        'tsv'      =>  'text/tab-separated-values',
        'txt'      =>  'text/plain',
        'uls'      =>  'text/iuls',
        'ustar'    =>  'application/x-ustar',
        'vcf'      =>  'text/x-vcard',
        'vrml'     =>  'x-world/x-vrml',
        'wav'      =>  'audio/x-wav',
        'wcm'      =>  'application/vnd.ms-works',
        'wdb'      =>  'application/vnd.ms-works',
        'wks'      =>  'application/vnd.ms-works',
        'wmf'      =>  'application/x-msmetafile',
        'wps'      =>  'application/vnd.ms-works',
        'wri'      =>  'application/x-mswrite',
        'wrl'      =>  'x-world/x-vrml',
        'wrz'      =>  'x-world/x-vrml',
        'xaf'      =>  'x-world/x-vrml',
        'xbm'      =>  'image/x-xbitmap',
        'xla'      =>  'application/vnd.ms-excel',
        'xlc'      =>  'application/vnd.ms-excel',
        'xlm'      =>  'application/vnd.ms-excel',
        'xls'      =>  'application/vnd.ms-excel',
        'xlt'      =>  'application/vnd.ms-excel',
        'xlw'      =>  'application/vnd.ms-excel',
        'xof'      =>  'x-world/x-vrml',
        'xpm'      =>  'image/x-xpixmap',
        'xwd'      =>  'image/x-xwindowdump',
        'z'        =>  'application/x-compress',
        'zip'      =>  'application/zip'
        );
        
        $extension = pathinfo($this->filename,PATHINFO_EXTENSION);
        $fileSize  = @filesize($this->filename);
        
        $mime = '';
        if (isset($this->types[$extension])) {
            $mime = $this->types[$extension];
        }
        
        header("Content-Type: ".$mime);
        header('Content-Disposition: attachment; filename="' . $clientfilename . '"');
        header("Content-Type: application/save");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Location: http://".$_SERVER['HTTP_HOST']."/".$this->filename."");
        
        $this->sendDownload($this->filename);

    } 
    
    
    /**
     * countTrackula::sendDownload()
     * 
     * @param mixed $file
     * @return void
     */
    public function sendDownload($file) {
        @set_time_limit(300);
        $absolutePath = $file;
        $chunkSize = 1 * (1024 * 1024); // how many bytes per chunk
        $fileSize = intval(sprintf("%u", filesize($absolutePath)));
        if ($fileSize > $chunkSize) {
            $handle = fopen($absolutePath, 'rb');
            while (!feof($handle)) {
                $buffer = fread($handle, $chunkSize);
                echo $buffer;
                ob_flush();
                flush();
            }
          
            if (!connection_aborted()) $this->tf->Increment();
            fclose($handle);
        } else {
            if (!connection_aborted()) $this->tf->Increment();
            readfile($absolutePath);
        }
    }
    

    /**
     * countTrackula::download_resume()
     * 
     * Sends the file to the client (browser, user-agent, whatever you like to call it) and 
     * increments the hit counter if the download was successfull. 
     * Supports resuming of downloads. 
     * 
     * @param mixed $clientfilename
     * @return void
     */
    function download_resume($clientfilename) { 
        @set_time_limit(0); 

        $size=filesize($this->filename); 
        $fh=fopen($this->filename, "rb");
        if ($handle === false) { 
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[countTrackula] Could not open '.$this->filename.'!'); 
        } 

        header("Content-Type: ".$mime);
        header('Content-Disposition: attachment; filename="' . $clientfilename . '"');
        header("Content-Type: application/save");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Location: ".$this->filename."");
        
        // check if http_range is sent by browser (or download manager) 
        $httprange = getenv("HTTP_RANGE"); 
        if($httprange !== false) { // if yes, download missing part 
            header("HTTP/1.1 206 Partial Content"); 
            $httprange = eregi_replace("^bytes=", "", $httprange); 
            $from = eregi_replace("-$", "", $httprange); 
            $to=$size-1; 
            header("Content-Range: bytes $from-$to/$size"); 
            $new_length=$to-$from; 
            header("Content-Length: $new_length"); 
            fseek($fh, $httprange); 
        } else { //if not, download whole file 
            $to=$size-1; 
            header("Content-Range: bytes 0-$to/$size"); 
            header("Content-Length: ".$to); 
        } 
        $buffer = ''; 
        while (!feof($fh)) { 
            $buffer = fread($fh, 2048); 
            print $buffer; 
            if (connection_aborted()) break; 
        } 
        if (!connection_aborted()) $this->tf->Increment();
        @fclose($fh); 
    } 

    /**
     * countTrackula::printdownloadlink()
     * 
     * Call with $showhits set to a string to localize (default is false and will print e.g. " (20 hits)" ). 
     * If $title is empty the basename of the filename is used. 
     * 
     * @param string $title
     * @param bool $showhits
     * @param bool $allowresume
     * @return 
     */
    function printdownloadlink($title = '', $showhits = false, $allowresume = false) { 
        echo '<a href="'.$_SERVER['REQUEST_URI'].'?download='.$this->filehash.($allowresume?'&resume=yes':'').'">' .
            (empty($title) ? basename($this->filename) : $title) . 
            '</a>'; 
        if ($showhits === true) { 
            return ' (' . $this->tf->Get() . ' hits)';
        } elseif (is_string($showhits) and !empty($showhits)) { 
            return ' (' . $this->tf->Get() . ' $showhits)';
        } 
    } 
 
    /**
     * countTrackula::printcount()
     * 
     * Prints out the hitcount for the file. 
     * Just calls the Get() on the associated hitsfile object.
     * 
     * @return
     */
    function printcount($file) { 
      $this->filename = $file; 
      $this->filehash = md5_file($file);
      if (strcmp($this->filehash, $this->tf->GetData)==0) {
        return $this->tf->Get();
      } else {
        $this->modx->log(modX::LOG_LEVEL_ERROR,'[countTrackula] Invalid file '.$this->filename.'!');
      }
    } 
}; 

?>