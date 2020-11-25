<?php

declare(strict_types=1);

namespace App\Post\Application\Event;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class NotifyWhenPostCreatedHandlerEvent implements MessageHandlerInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(PostWasCreated $postWasCreated)
    {
        $email = (new Email())
            ->from('from@test.com')
            ->to('to@test.com')
            ->subject('my subjet post mail')
            ->html('my content post mail')
        ;

        $this->mailer->send($email);
    }
}