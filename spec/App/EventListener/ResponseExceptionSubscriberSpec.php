<?php

namespace spec\App\EventListener;

use App\EventListener\ResponseExceptionSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseExceptionSubscriberSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ResponseExceptionSubscriber::class);
    }

    public function it_should_subscribe_to_kernel_exceptions()
    {
        $this::getSubscribedEvents()->shouldEqual([KernelEvents::EXCEPTION => 'onKernelException']);
    }
}
