<?php

namespace Drupal\alerte_module_pleiade\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\Component\Serialization\JSON;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Drupal\user\PrivateTempStoreFactory;


class AlerteModuleController extends ControllerBase {
    public function __construct() {
        $moduleHandler = \Drupal::service('module_handler');
        if ($moduleHandler->moduleExists('alerte_module_pleiade')) {
          $this->settings_message = \Drupal::config('alerte_module_pleiade.settings');    
        }
      }
    
      public function message_fields(Request $request){
        $entityTypeManager = \Drupal::entityTypeManager();
        $query = $entityTypeManager->getStorage('node')->getQuery();
        $query->condition('type', 'message_informatif');
        $query->condition('status', 1); // Published content condition
        $entityIds = $query->execute();
        $messages = $entityTypeManager->getStorage('node')->loadMultiple($entityIds);

        $msg = [];

        foreach ($messages as $message) {
            $body = $message->get('body')->value;
            $importance = $message->get('field_importance_du_message')->value;

            $msg[] = [
            'body' => $body,
            'importance' => $importance,
            ];
        }

        return new JsonResponse(json_encode($msg), 200, [], true);
    }

    
}