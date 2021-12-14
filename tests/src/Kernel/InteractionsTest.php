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
    public function only_accepts_patch()
    {
        $endpoint = $this->route('interaction', [
            'interaction' => 'like',
        ]);

        $this->get($endpoint)->assertMethodNotAllowed();
        drupal_flush_all_caches();

        $this->put($endpoint)->assertMethodNotAllowed();
        drupal_flush_all_caches();

        $this->delete($endpoint)->assertMethodNotAllowed();
        drupal_flush_all_caches();

        $this->post($endpoint)->assertOk();
    }

    private function route(string $route, array $parameters = [], array $options = []): string
    {
        return Url::fromRoute(...func_get_args())->toString(true)->getGeneratedUrl();
    }
}
