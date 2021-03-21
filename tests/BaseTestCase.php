<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseTestCase extends WebTestCase
{
    /** @var KernelBrowser */
    protected $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function get(string $id)
    {
        return static::$container->get($id);
    }
}