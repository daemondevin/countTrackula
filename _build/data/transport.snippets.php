<?php
/**
 * snippets transport file for countTrackula extra
 *
 * Copyright 2019 by daemon.devin <daemon.devin@gmail.com>
 * Created on 09-14-2019
 *
 * @package counttrackula
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'countTrackula',
  'description' => 'Call this snippet to render the link for download or to show just the download count of a file.',
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/counttrackula.snippet.php'));


$properties = include $sources['data'].'properties/properties.counttrackula.snippet.php';
$snippets[1]->setProperties($properties);
unset($properties);

return $snippets;
