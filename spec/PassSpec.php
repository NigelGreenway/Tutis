<?php

namespace spec\Tutis;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tutis\Exception\InvalidPasswordException;
use Tutis\Pass;
use Tutis\PassInterface;
use Tutis\Handler\BasicPasswordHandler;

/**
 * Spec for Pass
 *
 * @mixin \Tutis\Pass
 *
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
class PassSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThroughGenerate(
            'username',
            BasicPasswordHandler::hash('password1', [])
        );
    }

    function it_should_implement_PassInterface()
    {
        $this->shouldHaveType(PassInterface::class);
    }

    function it_should_be_of_Pass_type()
    {
        $this->shouldHaveType(Pass::class);
    }

    function it_should_return_true_for_an_active_pass()
    {
        $this->isActive()->shouldReturn(true);
    }

    function it_should_return_an_active_status_of_1()
    {
        $this->currentStatus()->shouldReturn(1);
    }

    function it_should_be_inactive()
    {
        $this->deactivate();
        $this->shouldNotBeActive();
    }

    function it_should_return_true()
    {
        $this->isActive()->shouldReturn(true);
    }

    function it_should_return_the_username()
    {
        $this->toUsername()->shouldReturn('username');
    }

    function it_should_return_a_hashed_version_of_the_given_password()
    {
        $this->toHash()->shouldNotReturn('password1');
    }

    function it_should_throw_InvalidPasswordException_with_bad_password()
    {
        $password = BasicPasswordHandler::hash('password1');

        $this
            ->shouldThrow(InvalidPasswordException::class)
            ->duringAuthenticate(
                'username',
                'password2',
                $password->getHash(),
                BasicPasswordHandler::class,
                Pass::ACTIVE
            );
    }

    function it_should_throw_InactivePassException_when_pass_set_to_inactive()
    {
        $password = BasicPasswordHandler::hash('password1');

        $this
            ->shouldThrow()
            ->duringAuthenticate(
                'username',
                'password1',
                $password->getHash(),
                BasicPasswordHandler::class,
                Pass::INACTIVE
            );
    }
}
