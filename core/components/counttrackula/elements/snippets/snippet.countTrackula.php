<?php
/**
 * countTrackula snippet for countTrackula extra
 *
 * Copyright 2016 by demon.devin <demon.devin@gmail.com>
 * Created on 10-07-2016
 *
 * countTrackula is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * countTrackula is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * countTrackula; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package counttrackula
 */
 
/**
 * countTrackula
 *
 * @author     demon.devin
 * @link       PortableAppz.cu.cc/
 * @copyright  2016
 * @package    countTrackula
 * @version    1.1
 * 
 * With this snippet you will have the ability to display the number of downloads along with a hashed link.
 *
 * PROPERTIES
 * &path       string   required    path to the file to download with trailing slash
 * &file       string   required    filename of the download without any slashes
 * &name       string   optional    the title of the link you want to show | defaults to &file
 * &hits       boolean  optional    just shows the download count of &file | defaults to false
 * &resume     boolean  optional    specify support for resumable download | defaults to false
 * &showhits   boolean  optional    shows the hit count on a download link | defaults to false
 *
 * EXAMPLE 
 * Give a file with a &path of `downloads/` and a &file name of `MyPackage.zip` 
 * With the &name of `My Package` and supports resume download while showing the hit count. # = the actual number
 *
 * [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &name=`My Package` &resume=`true` &showhits=`true`]]
 *
 * Output: My Package (# hits)
 * Output pagesource: <a href="REQUEST_URI?download=FILENAMEmd5HASH">My Package</a> (# hits)
 *
 * To just show the number of times &file has been downloaded.  # = the actual number
 *
 * [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &hits=`true`]]
 *
 * Output: #
 * Output pagesource: #
 *
 */

//require_once $modx->getOption('core_path').'components/counttrackula/model/counttrackula/countTrackula.class.php';
$trackula = $modx->getService(
    'counttrackula',
    'counttrackula',
    $modx->getOption('counttrackula.core_path',null,
    $modx->getOption('core_path').
    'components/counttrackula/').
    'model/counttrackula/',
    $scriptProperties);
if (!($trackula instanceof counttrackula)) return '[countTrackula] Cannot load the countTrackula class.';

$path     = $modx->getOption('path',$scriptProperties,'');
$file     = $modx->getOption('file',$scriptProperties,'');
$name     = $modx->getOption('name',$scriptProperties,'');
$hits     = (boolean)$modx->getOption('hits',$scriptProperties,false);
$resume   = (boolean)$modx->getOption('resume',$scriptProperties,false);
$showhits = (boolean)$modx->getOption('showhits',$scriptProperties,false);

$filePath = $path.$file;
$trackula->countTrackula($filePath);

if ($hits === true) {
    $output = $trackula->printcount($file);
} else {
    $output = $trackula->printdownloadlink($name, $showhits, $resume);
}
return $output;