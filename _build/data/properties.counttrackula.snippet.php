<?php
/**
 * Properties file for countTrackula snippet
 *
 * Copyright 2019 by daemon.devin <daemon.devin@gmail.com>
 * Created on 10-05-2019
 *
 * @package counttrackula
 * @subpackage build
 */




$properties = array (
  'file' => 
  array (
    'name' => 'file',
    'desc' => 'This can be a local file or remote file.
 
If local, define the file with just the extension without the file path. Use the path property to define the file\'s path. For example: countTrackula.zip

If remote, be sure to define a fully qualified URL to the remote file. For example: http://example.com/countTrackula.zip',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'hits' => 
  array (
    'name' => 'hits',
    'desc' => 'If set to true, the snippet will only output the download count of the file.',
    'type' => 'combo-boolean',
    'options' => 
    array (
    ),
    'value' => false,
    'lexicon' => NULL,
    'area' => '',
  ),
  'name' => 
  array (
    'name' => 'name',
    'desc' => 'The name of the download file',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'path' => 
  array (
    'name' => 'path',
    'desc' => 'The path to the download file. 
NOTE: If the file property is a remote file and not a local file than omit this property entirely!',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'term' => 
  array (
    'name' => 'term',
    'desc' => 'The word to be shown next to the down count number. For example: 18 hits <--hits is the term
',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => 'downloads',
    'lexicon' => NULL,
    'area' => '',
  ),
  'tpl' => 
  array (
    'name' => 'tpl',
    'desc' => 'The chunk to be used when displaying the download link.',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => 'downloadLinkTpl',
    'lexicon' => NULL,
    'area' => '',
  ),
  'type' => 
  array (
    'name' => 'type',
    'desc' => 'The mimetype of the file to be downloaded.',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'unique' => 
  array (
    'name' => 'unique',
    'desc' => 'If set to true, will show unique download count based on the clients IP address',
    'type' => 'combo-boolean',
    'options' => 
    array (
    ),
    'value' => false,
    'lexicon' => NULL,
    'area' => '',
  ),
);

return $properties;

