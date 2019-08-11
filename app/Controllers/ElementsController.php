<?php

namespace App\Controllers;

use App\Models\{Job, Project};
use Respect\Validation\Validator;

class ElementsController extends BaseController {
    public function getAddElementAction($request) {

        $responseMessage = null;

        // Submit job to database
        if (isset($_POST['submit_job'])) {
            if ($request->getMethod() == 'POST') {
                // Get the data which is send by the method post    
                $postData = $request->getParsedBody();
                
                // Validate if the data is a string and if it isn't empty
                $jobValidator = Validator::key('job_title', Validator::stringType()->notEmpty())
                                 ->key('job_description', Validator::stringType()->notEmpty());

                try {
                    $jobValidator->assert($postData);

                    $files = $request->getUploadedFiles();
                    $logo = $files['job_logo'];
                    $logoLocation = "";

                    if($logo->getError() == UPLOAD_ERR_OK) {
                        $fileName = $logo->getClientFilename();
                        $logoLocation = "uploads/$fileName";
                        $logo->moveTo($logoLocation);
                    }

                    // Apply to a new Job object the data which had been sent
                    // by the method post
                    $job = new Job();
                    $job->title = $postData['job_title'];
                    $job->description = $postData['job_description'];
                    $job->logo = $logoLocation;
                    $job->save();

                    $responseMessage = 'The file has been succesfully submited to database';
                } catch (\Exception $e) {
                    $responseMessage = $e->getMessage();
                }
            }
        }

        // Submit project to database
        if (isset($_POST['submit_project'])) {
            if ($request->getMethod() == 'POST') {
                $postData = $request->getParsedBody();

                $projectValidator = Validator::key('project_title', Validator::stringType()->notEmpty())
                                 ->key('project_description', Validator::stringType()->notEmpty());

                try {
                    $projectValidator->assert($postData);

                    $project = new Project();
                    $project->title = $postData['project_title'];
                    $project->description = $postData['project_description'];
                    $project->save();

                    $responseMessage = 'The file has been succesfully submited to database';
                } catch (\Exception $e) {
                    $responseMessage = $e->getMessage();
                }
            }
        }

        return $this->renderHTML('addElement.twig', [
            'responseMessage' => $responseMessage
        ]);
    } 
}