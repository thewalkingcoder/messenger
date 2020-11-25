<?php

namespace App\Controller;

use App\Form\PostType;
use App\Post\Application\Command\CreatePostCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/", name="app")
     */
    public function index(Request $request): Response
    {
        $command = new CreatePostCommand();
        $form = $this->createForm(PostType::class, $command);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->commandBus->dispatch($command);
        }

        return $this->render(
            'app/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
