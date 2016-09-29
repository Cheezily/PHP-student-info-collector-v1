<?php

    //TODO: this data needs to be offloaded to a db so it's manageable by the user
    $optionListData = array(
    'University Name 1'=>
        array(
            'Professor Name 1',
            'Professor Name 2',
            'Professor Name 3'
        ),
    'University Name 2'=>
        array(
            'Professor Name 1',
            'Professor Name 2',
            'Professor Name 3'
        ),
    'University Name 3'=>
        array(
            'Professor Name 1',
            'Professor Name 2',
            'Professor Name 3'
        )
    );
    
    //get a list of the university names
    $optionKeys = array_keys($optionListData);
    $universityList = '<option></option>';
    for ($i = 0; $i < count($optionKeys); $i++) {
        $universityList .= "<option value='".$optionKeys[$i]."'>".
                    $optionKeys[$i].
                "</option>";
    }
    
    //handles if the university name is passed by the welcome page or an error page
    if (isset($_POST['selectUniversity']) || isset($universityName)) {
        
        if (!isset($universityName)) {
            $universityName = filter_input(INPUT_POST, 'university', FILTER_SANITIZE_STRING);
        } else {
            
        }
        
        if ($universityName == TRUE) {
            $instructorList = '';
            $universityOptions = $optionListData[$universityName];
        
            if ($universityName == TRUE) {
                $universitySelected = TRUE;
                for ($i = 0; $i < count($universityOptions); $i++) {
                    $instructorList .= "<input id='box".$i."' class='css-checkbox' type='checkbox' ".
                            "name='instructor[]' value='".$universityOptions[$i]."'>".
                        "<label class='css-label' for='box".$i."'>".$universityOptions[$i].
                        "</label>".
                        "<br>";
                }
            }
        } else {
            $universityError = "<div class='warning'>Please Select a University ".
                        "From the List".
                    "</div>";
        }

    }
    
    //button to go back to the welcome page to select another university
    $goback = "<form method='post' action=''>".
            "<input type='submit' name='goback' value='<<< Click to Go Back and Select a Different University'>".
            "</form>";
    
    if (isset($_POST['goback'])) {
        header("Location: index.php");
    }
?>