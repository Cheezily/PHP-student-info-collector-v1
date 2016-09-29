<?php

require_once 'DB.php';

if (isset($_POST['submitInfo'])) {
    
    $instructors = array();
    forEach($_POST['instructor'] as $instructor) {
        if (!empty($instructor)) {
            array_push($instructors, filter_var($instructor,
                        FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }
    
    $university = filter_input(INPUT_POST, 'university', FILTER_SANITIZE_STRING);
    $studentFirstname = filter_input(INPUT_POST, 'studentFirstname', FILTER_SANITIZE_STRING);
    $studentLastname = filter_input(INPUT_POST, 'studentLastname', FILTER_SANITIZE_STRING);
    
    $error = FALSE;
    $universitySelected = $university;
    $universityName = $university;
    
    if (!$university) {
        $generalError = "University was not captured. Please reload the page and try again.";
        $error = TRUE;
    }
    
    if (!$studentFirstname || !$studentLastname) {
        $nameError = "<p class='miniWarning'>Your first and last name are required</p>";
        $error = TRUE;
    }
    
    if (count($instructors) == 0) {
        $instructorError = "<p class='miniWarning'>No instructor Selected or Entered!</p>";
        $error = TRUE;
    }
    
    if ($error == FALSE) {
        $success = submitInfo($studentFirstname, $studentLastname, $university, $instructors); 
    } else {
        require_once 'optionList.php';
    }
       
}

?>