<?php
/**
* Resolve creating db tables
*
* @package cliche
* @subpackage build
*/
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $modelPath = $modx->getOption('counttrackula.core_path',null,$modx->getOption('core_path').'components/counttrackula/').'model/';
            if (!file_exists($modelPath)) break;

            if (!$modx->addPackage('counttrackula', $modelPath)) {
                $modx->log(modX::LOG_LEVEL_ERROR, "[countTrackula] was unable to load this package!");
                return false;
            }

            $modx->log(modX::LOG_LEVEL_INFO, ' ');
            $modx->log(modX::LOG_LEVEL_INFO, '[countTrackula] Creating the database table...');

            $manager = $modx->getManager();
            if(!$manager->createObjectContainer('Victims')) {
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_ERROR, '[countTrackula] Failed to create the database table...');
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_ERROR, 'Please manually create a database table for countTrackula! ');
              $modx->log(modX::LOG_LEVEL_ERROR, 'The name should be something like: "modx_Victims"');
              $modx->log(modX::LOG_LEVEL_ERROR, 'Where "modx_" is the prefix of your modx database install!');
            } else {
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_INFO, '[countTrackula] Successfully created the database table...');
            };
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $modx =& $object->xpdo;

            $modelPath = $modx->getOption('counttrackula.core_path',null,$modx->getOption('core_path').'components/counttrackula/').'model/';
            if (!file_exists($modelPath)) break;

            if (!$modx->addPackage('counttrackula', $modelPath)) {
                $modx->log(modX::LOG_LEVEL_ERROR, "[countTrackula] was unable to load this package!");
                return false;
            }

            $manager = $modx->getManager();
            if(!$manager->removeObjectContainer('Victims')) {
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_ERROR, '[countTrackula] Failed to delete the database table...');
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_ERROR, 'Please manually delete the database table for countTrackula! ');
              $modx->log(modX::LOG_LEVEL_ERROR, 'The name should be something like: "modx_Victims"');
              $modx->log(modX::LOG_LEVEL_ERROR, 'Where "modx_" is the prefix of your modx database install!');
            } else {
              $modx->log(modX::LOG_LEVEL_INFO, ' ');
              $modx->log(modX::LOG_LEVEL_INFO, '[countTrackula] Successfully deleted the database table...');
            };
            break;
    }
}
return true;
