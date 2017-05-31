<?php

/**
 * Register application modules
 */
$app->registerModules(array(
  'app' => array(
    'className' => 'Agenda\Modules\App\Module',
    'path' => __DIR__ . '/../modules/app/Module.php'
  )
));
