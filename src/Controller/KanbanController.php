<?php

namespace App\Controller;

use App\Services\GitHubAnonymousStrategy;
use App\Services\GitHubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class KanbanController extends AbstractController
{
    public function showKanbanBoard(Request $request)
    {
        $owner = $request->get('owner');
        $repository = $request->get('repository');

        $gitHubService = new GitHubService(new GitHubAnonymousStrategy(), $owner, $repository);

        $milestones = $gitHubService->getAllMilestones();
        foreach ($milestones as $key => $milestone){
            $milestones[$key]['openedIssues'] = $gitHubService->getIssuesByStatusForMilestone($gitHubService::STATUS_OPENED_ISSUES , $milestone['number']);
            $milestones[$key]['closedIssues'] = $gitHubService->getIssuesByStatusForMilestone($gitHubService::STATUS_CLOSED_ISSUES , $milestone['number']);
        }

        return $this->render('view.html.twig', [
            'milestones' => $milestones
        ]);
    }

    public function chooseRepo(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('owner', TextType::class, [
                'label' => 'Owner of the repository',
            ])
            ->add('repository', TextType::class, [
                'label' => 'Repository name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Pick',
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('app_show_kanban_board',$data);
        }

        return $this->render('chose_repo.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
