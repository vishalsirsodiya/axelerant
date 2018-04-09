<?php

namespace Drupal\axelerant\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AxelerantController.
 */
class AxelerantController extends ControllerBase {

  /**
   * Axelerant json.
   *
   * @param string $key
   *   Site api key.
   * @param int $nid
   *   Node id.
   *
   * @return jsonoutput
   *
   *   Json response for page node.
   */
  public function axelerant_json($key, $nid) {
    // Get the Site API Key from configuration.
    $site_api_key = \Drupal::config('system.site')->get('site_api_key');
    // Check if the API Key entered in the URL is Valid.
    if ($site_api_key === $key) {
      if (is_numeric($nid) && $nid > 0) {
        // Load the Node using the Node id from the request URL.
        $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);

        // Check if the node type is 'page'.
        if (!empty($node) && $node->getType() === 'page') {

          // Build appropriate JSON response.
          $json_response = [
            'nid' => $nid,
            'title' => $node->getTitle(),
            'body' => $node->get('body')->getValue(),
            'type' => $node->getType(),
          ];
          // Respond with the json representation of the node.
          return new JsonResponse($json_response);
        }
        else {
          // When other content types.
          return new JsonResponse(["error" => "access denied"], 401, ['Content-Type' => 'application/json']);
        }
      }
    }
    else {
      // Build appropriate JSON response.
      return new JsonResponse(["error" => "access denied"], 401, ['Content-Type' => 'application/json']);
    }

  }

}
