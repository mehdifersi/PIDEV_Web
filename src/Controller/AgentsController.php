<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentsType;
use App\Repository\AgentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agents')]
class AgentsController extends AbstractController
{
    #[Route('/', name: 'app_agents_index', methods: ['GET'])]
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agents/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_agents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AgentRepository $agentRepository): Response
    {
        $agent = new Agents();
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agentRepository->save($agent, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_show', methods: ['GET'])]
    public function show(Agents $agent): Response
    {
        return $this->render('agents/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agents $agent, AgentRepository $agentRepository): Response
    {
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agentRepository->save($agent, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_delete', methods: ['POST'])]
    public function delete(Request $request, Agents $agent, AgentRepository $agentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $agentRepository->remove($agent, true);
        }

        return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
    }
}
