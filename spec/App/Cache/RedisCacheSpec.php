<?php

namespace spec\App\Cache;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Messenger\MessageBusInterface;

class RedisCacheSpec extends ObjectBehavior
{
    private const REDIS_PORT = 6379;

    public function it_should_return_null(MessageBusInterface $bus)
    {
        $this->beConstructedWith('', self::REDIS_PORT, $bus);
        $this->get('test')->shouldEqual(null);
    }
}
