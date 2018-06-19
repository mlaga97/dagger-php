<?php

function getAssessments() {
  $assessments = getUnmergedConfig($filename = 'assessment.json');

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
