<?php
/**
 * Properties file for countTrackula snippet
 *
 * Copyright 2016 by demon.devin <demon.devin@gmail.com>
 * Created on 10-07-2016
 *
 * @package counttrackula
 * @subpackage build
 */




$properties = array (
  'path' => 
  array (
    'name' => 'path',
    'desc' => 'path to the file to download with trailing slash',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'file' => 
  array (
    'name' => 'file',
    'desc' => 'filename of the download without any slashes',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'name' => 
  array (
    'name' => 'name',
    'desc' => 'the title of the link you want to show | defaults to &file',
    'type' => 'textfield',
    'options' => 
    array (
    ),
    'value' => '',
    'lexicon' => NULL,
    'area' => '',
  ),
  'resume' => 
  array (
    'name' => 'resume',
    'desc' => 'specify support for resumable download | defaults to false',
    'type' => 'combo-boolean',
    'options' => 
    array (
    ),
    'value' => false,
    'lexicon' => NULL,
    'area' => '',
  ),
  'showhits' => 
  array (
    'name' => 'showhits',
    'desc' => 'shows the hit count on a download link | defaults to false',
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

