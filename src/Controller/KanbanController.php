<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Services\GitHubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class KanbanController extends AbstractController
{
    public function showKanbanBoard(GitHubService $gitHubService)
    {

        $milestones = $gitHubService->getAllMilestones();
        foreach ($milestones as $key => $milestone){
            $milestones[$key]['openedIssues'] = $gitHubService->getIssuesByStatusForMilestone('open' , $milestone['number']);
            $milestones[$key]['closedIssues'] = $gitHubService->getIssuesByStatusForMilestone('closed' , $milestone['number']);
        }

        Return new JsonResponse($milestones);
    }
}
