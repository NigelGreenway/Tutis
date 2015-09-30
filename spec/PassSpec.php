<?php

namespace spec\Tutis;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tutis\Exception\InactivePassException;
use Tutis\Exception\InvalidPasswordException;
use Tutis\Pass;
use Tutis\PassInterface;
use Tutis\Provider\BasicPasswordProvider;

class PassSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThroughGenerate(
            'username',
            BasicPasswordProvider::hash('password1', [])
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
        $this->getActiveStatus()->shouldReturn(1);
    }

    function it_should_return_false_for_an_inactive_pass()
    {
        $this->deactivate();
        $this->isActive()->shouldReturn(false);
    }

    function it_should_return_a_hashed_version_of_the_given_password()
    {
        $this->getPassword()->shouldNotReturn('password1');
    }

    function it_should_throw_InvalidPasswordException_with_bad_password()
    {
        $password = BasicPasswordProvider::hash('password1');

        $this
            ->shouldThrow(InvalidPasswordException::class)
            ->duringAuthenticate(
                'username',
                'password2',
                $password->getHash(),
                BasicPasswordProvider::class,
                Pass::ACTIVE
            );
    }

    function it_should_throw_InactivePassException_when_pass_set_to_inactive()
    {
        $password = BasicPasswordProvider::hash('password1');

        $this
            ->shouldThrow()
            ->duringAuthenticate(
                'username',
                'password1',
                $password->getHash(),
                BasicPasswordProvider::class,
                Pass::INACTIVE
            );
    }
}
