<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Post\Application\Event\PostWasCreated;
use App\Post\Domain\Post;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class CreatePostCommandHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreatePostCommand $postCommand)
    {
        $post = new Post($postCommand->name);
        //call repository

        $this->eventBus->dispatch(
            (new Envelope(new PostWasCreated()))->with(new DispatchAfterCurrentBusStamp())
        );
    }
}