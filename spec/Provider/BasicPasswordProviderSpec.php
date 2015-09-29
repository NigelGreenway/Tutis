<?php

namespace spec\Tutis\Provider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tutis\Exception\InvalidPasswordException;

class BasicPasswordProviderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThroughHash(
            'p455w0rd1',
            []
        );
    }

    function it_should_implement_PasswordProviderInterface()
    {
        $this->shouldHaveType('\Tutis\PasswordProviderInterface');
    }

    function it_should_not_return_the_raw_password()
    {
        $this->getHash()->shouldNotReturn('p455w0rd1');
    }

    function it_should_throw_an_InvalidPasswordException_incorrect_match()
    {
        $this
            ->shouldThrow(InvalidPasswordException::class)
            ->duringVerify('p455w0rd1', '50m3h45h');
    }

    function it_should_verify_correctly()
    {
        $this::verify('p455w0rd1', $this->getHash())->shouldReturn(true);
    }
}
