<?php

function getAssessments() {
  $rawAssessments = getUnmergedConfig($filename = 'assessment.json');

  // Index by ID
  $assessments = [];
  foreach($rawAssessments as $assessment) {
    $assessments[$assessment['metadata']['id']] = $assessment;
  }

  // TODO: Filtering, etc.

  return $assessments;
}

function getAssessmentByID($id) {
  foreach(getAssessments() as $assessment) {
    if($id == $assessment['metadata']['id']) {
      return $assessment;
    }
  }

  return null;
}

function getAssessmentList() {
  $assessmentList = [];

  foreach(getAssessments() as $assessment) {
    array_push($assessmentList, $assessment['metadata']['id']);
  }

  return $assessmentList;
}

function getAssessmentMetadata() {
  $assessmentMetadata = [];

  foreach(getAssessments() as $assessment) {
    $assessmentMetadata[$assessment['metadata']['id']] = $assessment['metadata'];
  }

  return $assessmentMetadata;
}

?>
