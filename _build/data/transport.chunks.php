<?php
/**
 * chunks transport file for countTrackula extra
 *
 * Copyright 2019 by daemon.devin <daemon.devin@gmail.com>
 * Created on 10-05-2019
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
/* @var xPDOObject[] $chunks */


$chunks = array();

$chunks[1] = $modx->newObject('modChunk');
$chunks[1]->fromArray(array (
  'id' => 1,
  'name' => 'downloadLinkTpl',
), '', true, true);
$chunks[1]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/downloadlinktpl.chunk.html'));

return $chunks;
