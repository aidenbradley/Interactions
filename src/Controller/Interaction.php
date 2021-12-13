<?php

namespace Drupal\interactions\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class Interaction
{
    public function __invoke(): JsonResponse
    {
        return JsonResponse::create('Interacted');
    }
}
