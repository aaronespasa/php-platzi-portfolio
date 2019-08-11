<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class ElementsController extends BaseController {
    public function getAddElementAction($request) {

        if (isset($_POST['submit_job'])) {
            if ($request->getMethod() == 'POST') {
                $postData = $request->getParsedBody();
                $job = new Job();
                $job->title = $postData['job_title'];
                $job->description = $postData['job_description'];
                $job->save();
            }
        }

        if (isset($_POST['submit_project'])) {
            if ($request->getMethod() == 'POST') {
                $postData = $request->getParsedBody();
                $project = new Project();
                $project->title = $postData['project_title'];
                $project->description = $postData['project_description'];
                $project->save();
            }
        }

        return $this->renderHTML('addElement.twig');
    } 
}