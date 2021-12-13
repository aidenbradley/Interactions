<?php

namespace Drupal\Tests\interactions\Kernel;

use Drupal\Core\Url;
use Drupal\helpers\Concerns\Tests\MakesHttpRequests;
use Drupal\KernelTests\KernelTestBase;
use Symfony\Component\HttpFoundation\Response;

class InteractionsTest extends KernelTestBase
{
    use MakesHttpRequests;

    protected static $modules = [
        'interactions',
    ];

    /** @test */
    public function route_only_accepts_patch()
    {
        $endpoint = $this->route('interaction', [
            'interaction' => 'like',
        ]);

        $this->get($endpoint)->assertMethodNotAllowed();
        $this->post($endpoint)->assertMethodNotAllowed();
        $this->put($endpoint)->assertMethodNotAllowed();
        $this->delete($endpoint)->assertMethodNotAllowed();

        $this->patch($endpoint)->assertOk();
    }

    private function route(string $route, array $parameters = [], array $options = []): string
    {
        return Url::fromRoute(...func_get_args())->toString(true)->getGeneratedUrl();
    }
}
