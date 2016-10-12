<?php
/**
 * snippets transport file for countTrackula extra
 *
 * Copyright 2016 by demon.devin <demon.devin@gmail.com>
 * Created on 10-07-2016
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
  'description' => 'Call this snippet to render the link for download.',
  'properties' => NULL,
), '', true, true);
$snippets[1]->setContent(file_get_contents(MODX_BASE_PATH . 'assets/mycomponents/counttrackula/core/components/counttrackula/elements/snippets/snippet.countTrackula.php'));

return $snippets;
