<?php
/**
 * systemSettings transport file for countTrackula extra
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
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'counttrackula.core_path',
  'name' => 'Core Path',
  'description' => 'The path to countTrackula\'s core component files',
  'namespace' => 'counttrackula',
  'xtype' => 'textfield',
  'value' => '{core_path}components/counttrackula/',
  'area' => '',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'counttrackula.algo',
  'name' => 'Algorithm',
  'description' => 'The algorithm to be used when generating a hash.',
  'namespace' => 'counttrackula',
  'xtype' => 'textfield',
  'value' => 'sha1',
  'area' => '',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'counttrackula.salt',
  'name' => 'Salt',
  'description' => 'The salt to be added when hashing a file.',
  'namespace' => 'counttrackula',
  'xtype' => 'textfield',
  'value' => 'countTrackula\'s best friend is decrypt-keeper',
  'area' => '',
), '', true, true);
return $systemSettings;
