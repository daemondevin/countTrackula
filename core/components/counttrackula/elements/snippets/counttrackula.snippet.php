<?php
/**
 * countTrackula snippet for countTrackula extra
 *
 * Copyright 2016 by daemon.devin <daemon.devin@gmail.com>
 * Created on 9-15-2019
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
 * @author     daemon.devin
 * @link       PortableAppz.x10.mx/
 * @copyright  2019
 * @package    countTrackula
 * @version    2.0
 *
 * With this snippet you will have the ability to display the number of downloads for a local file or
 * the number of clicks on a remote file. It'll also create a hashed link of the local or remote file
 * for security purposes hiding the filepath of a locally hosted file.
 *
 * PROPERTIES
 * &path       string   required    path to the file to download with trailing slash
 * &file       string   required    filename of the download without any slashes
 * &term       string   optional    The word shown next to download count (i.e. 18 hits)
 * &type       string   optional    mimetype of the file (i.e. zip archive would be: application/zip)
 * &name       string   optional    the title of the link you want to show | defaults to &file
 * &hits       boolean  optional    just shows the download count of &file | defaults to false
 * &tpl        string   optional    the chunk used to display the link for downloading
 *
 * EXAMPLE
 * Define a download with a path property of `downloads/` and a file property of `MyPackage.zip`
 * with the name property of `My Package`
 *
 * [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &name=`My Package`]]
 *
 * Output: My Package (# downloads)
 * Output pagesource: <a href="http://example.com/?download=SALTEDHASH">My Package</a> (# hits)
 *
 * To just show the number of times a file has been downloaded with the term property set to hits.
 *
 * [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &hits=`true` &term=`hits`]]
 *
 * Output: 18 hits
 * Output pagesource: 18 hits
 *
 * To define a remote file for download just set the file property to the link to the file
 *
 * [[!countTrackula? &file=`http://example.com/files/countTrackula-2.0-pl.transport.zip` &name=`countTrackula`]]
 *
 * Output: countTrackula (18 downloads)
 */

$modx->trackula = $modx->getService(
  'counttrackula', 'countTrackula',
  $modx->getOption('counttrackula.core_path', null,
    $modx->getOption('core_path') .
    'components/counttrackula/') .
  'model/counttrackula/',
  $scriptProperties
);

if (!($modx->trackula instanceof countTrackula)) {
  $err = "[countTrackula] Cannot load the countTrackula class.";
  $modx->log(modX::LOG_LEVEL_ERROR, $err);
  throw new Exception($err);
}

$file = (string)  $modx->getOption('file', $scriptProperties, '');
$name = (string)  $modx->getOption('name', $scriptProperties, '');
$type = (string)  $modx->getOption('type', $scriptProperties, '');
$path = (string)  $modx->getOption('path', $scriptProperties, '');
$hits = (boolean) $modx->getOption('hits', $scriptProperties, false);
$term = (string)  $modx->getOption('term', $scriptProperties, 'downloads');
$tpl  = (string)  $modx->getOption('tpl', $scriptProperties, 'downloadLinkTpl');

if (!$modx->trackula->validURL($file)) {
  $link = false;
  $modx->trackula->_set("isLink", false);

  if (!file_exists(MODX_BASE_PATH . $path . $file)) {
    $err = "[countTrackula] Cannot locate file for transfer: {$file}";
    $modx->log(modX::LOG_LEVEL_ERROR, $err);
    throw new Exception($err);
  }

  if (!is_readable(MODX_BASE_PATH . $path . $file)) {
    $err = "[countTrackula] Cannot read file for transfer: {$file}";
    $modx->log(modX::LOG_LEVEL_ERROR, $err);
    throw new Exception($err);
  }

  $byte = [];

  $fcontents    = file_get_contents(MODX_BASE_PATH . $path . $file);
  $byte['file'] = $file;
  $byte['path'] = MODX_BASE_PATH . $path . $file;
  $byte['hash'] = $modx->trackula->generateHash($fcontents);
  $byte['name'] = $name ? $name : basename($byte['path']);
  $byte['link'] = $modx->trackula->generateLink($byte['hash']);

  if (isset($_GET['download'])) {
    if ($modx->trackula->hashEquals($byte['hash'], $_GET['download'])) {
      // Taken from the FileLister MODx Extra
      // by Shaun McCormick <shaun@modxcms.com>
      $tenMinAgo = time() - (60 * 5);
      $tenMinAgo = strftime('%Y-%m-%d %H:%M:%S', $tenMinAgo);
      $double    = $modx->getCount('Victims', [
        'path' => $byte['path'],
        'ip' => $modx->trackula->clientIP(),
        'downloadedon:>' => $tenMinAgo,
      ]);
      if ($double <= 0) {
        $unique = $modx->getCount('Victims', [
          'path' => $byte['path'],
          'ip' => $modx->trackula->clientIP(),
        ]);
        $victim = $modx->newObject('Victims');
        $victim->set('path', $byte['path']);
        $victim->set('ip', $modx->trackula->clientIP());
        $victim->set('downloadedon', strftime('%Y-%m-%d %H:%M:%S'));
        $victim->set('unique', $unique > 0 ? false : true);
        $victim->set('referer', urldecode($_SERVER['HTTP_REFERER']));
        if ($modx->user->hasSessionContext($modx->context->get('key'))) {
          $victim->set('user', $modx->user->get('id'));
        }
        $victim->save();
      }
      $modx->trackula->outputFile($byte['path'], false);
    }
  }

} else {
  $link = true;
  $modx->trackula->_set("isLink", true);
  $modx->trackula->_set("link", $file);

  $byte = [];

  $byte['file'] = $file;
  $byte['hash'] = $modx->trackula->generateHash($file);
  $byte['name'] = $name ? $name : pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_BASENAME);
  $byte['link'] = $modx->trackula->generateLink($byte['hash']);

  if (isset($_GET['download']) && !empty($_GET['link'])) {
    if ($modx->trackula->hashEquals($byte['hash'], $_GET['download'])) {
      // Taken from the FileLister MODx Extra
      // by Shaun McCormick <shaun@modxcms.com>
      $tenMinAgo = time() - (60 * 5);
      $tenMinAgo = strftime('%Y-%m-%d %H:%M:%S', $tenMinAgo);
      $double    = $modx->getCount('Victims', [
        'path' => $byte['file'],
        'ip' => $modx->trackula->clientIP(),
        'downloadedon:>' => $tenMinAgo,
      ]);
      if ($double <= 0) {
        $unique = $modx->getCount('Victims', [
          'path' => $byte['file'],
          'ip' => $modx->trackula->clientIP(),
        ]);

        $victim = $modx->newObject('Victims');
        $victim->set('path', $byte['file']);
        $victim->set('ip', $modx->trackula->clientIP());
        $victim->set('downloadedon', strftime('%Y-%m-%d %H:%M:%S'));
        $victim->set('unique', $unique > 0 ? false : true);
        $victim->set('referer', urldecode($_SERVER['HTTP_REFERER']));
        if ($modx->user->hasSessionContext($modx->context->get('key'))) {
          $victim->set('user', $modx->user->get('id'));
        }
        $victim->save();
      }
      $modx->sendRedirect($_GET['link']);
    }
  }
}

$dlCount = ['path' => $link === false ? $byte['path'] : $byte['file']];
if ($unique) {
  $dlCount['unique'] = true;
}

$downloads = $modx->getCount('Victims', $dlCount);
unset($dlCount);
if ($hits) {
  $output = $downloads . " " . $term;
} else {
  $output = $modx->trackula->getChunk($tpl, [
    'name' => $byte['name'],
    'link' => $byte['link'],
    'term' => $term,
    'count' => $downloads,
  ]);
}
unset($byte);
return $output;