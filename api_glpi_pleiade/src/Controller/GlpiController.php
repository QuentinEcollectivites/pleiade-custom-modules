<?php

namespace Drupal\api_glpi_pleiade\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\Component\Serialization\JSON;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\user\Entity\UserInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;


class GlpiController extends ControllerBase {

    public function __construct() {
      $moduleHandler = \Drupal::service('module_handler');
      if ($moduleHandler->moduleExists('api_glpi_pleiade')) {
        $this->settings_glpi = \Drupal::config('api_glpi_pleiade.settings');    
      }
    }
    public function glpi_list_tickets(Request $request){
      // // API endpoint URL
      // $glpi_url = $this->settings_glpi->get('glpi_url');
      // $app_token = $this->settings_glpi->get('app_token');
      // $endpoint_ticket = $this->settings_glpi->get('endpoint_ticket');
      // $url1 = 'http://127.0.0.2/apirest.php/initSession';
      // // Initialize curl
      // $curl1 = curl_init($url1);
      // // Set the request method to POST
      // curl_setopt($curl1, CURLOPT_POST, true);
      // // Set the response format to JSON
      // curl_setopt($curl1, CURLOPT_HTTPHEADER, array(
      //     'Content-Type: application/json',
      //     'Authorization: Basic Z2xwaTpnbHBp',
      //     'App-Token: '.$app_token
      // ));
      // // Set the option to return the response as a string
      // curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
      // // Execute the request
      // $response1 = curl_exec($curl1);
      // // Close the curl session
      // curl_close($curl1);
      // // Decode the JSON response
      // $response_data1 = json_decode($response1, true);
      // // Get the session token from the response
      // $session_token = $response_data1['session_token'];     // Load the user
      // $url = $glpi_url . $endpoint_ticket ;
      // // Session token obtained from initSession API
      // // Initialize curl
      // $curl = curl_init($url);
      // // Set the request method to GET 
      // curl_setopt($curl, CURLOPT_HTTPGET, true);
      // // Set the response format to JSON
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      //     'Content-Type: application/json',
      //     'Session-Token: '.$session_token,
      //     'App-Token: '.$app_token
      // ));
      // // Set the option to return the response as a string   
      // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // // Execute the request 
      // $response = curl_exec($curl);
      // // Close the curl session 
      // curl_close($curl);
      // // Decode the JSON response
      // $response_data = json_decode($response, true); 
      // return new JsonResponse(json_encode($response_data), 200, [], true);
      
    }
}