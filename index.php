<?php
    date_default_timezone_set ("America/Chicago");
    $success = FALSE;
    $universityError = '';
    $nameError = '';
    $instructorError = '';
    require_once 'dbFunctions.php';
    require_once 'optionList.php';
    
    if (isset($success) && $success === TRUE) {
        header("Location: success.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <title>Participation Survey</title>
    </head>
    <body>
        <div class='wrapper'>
        <?php if (isset($universitySelected)) { ?>
                <h1>Selected University: <?php echo $universityName;?></h1>
                <?php echo $goback ?>
                <hr>
                <br>
                <form method='post' action=''>
                    <div class='textInputWrapper'>
                        <label class='nameLabel' for='studentFirstname'>Your First Name</label>
                        <input id='studentFirstname' type='text' name='studentFirstname' 
                               placeholder='First Name'>
                        <label class='nameLabel' for='studentLastname'>Your Last Name</label>
                        <input id='studentLastname' type='text' name='studentLastname' 
                               placeholder='Last Name'>
                    </div>
                    <?php echo $nameError; ?>
                    <p class='instructions'>Please select the instructors who were offering extra credit 
                        for your participation or enter their name in the space below</p>
                    <div class='instructorWrapper'>
                        <?php echo $instructorList; ?>
                    </div>
                    <div class='textInputWrapper'>
                        <label for='other' class='otherLabel'>Other, if Instructor not Listed</label>
                        <input id='other' name='instructor[]' type='text' 
                               placeholder='Other Instructor'>
                    </div>
                    <?php echo $instructorError; ?>
                    <input type='hidden' name='university' value="<?php echo $universityName;?>">
                    <input type='submit' name='submitInfo' value='Submit Info'>
                </form>
        <?php } else { ?>
            <h1>Please Select Your University</h1>
            <form method='post' action=''>
                <select id='university' name='university'>
                    <?php echo $universityList; ?>
                </select>
                <?php echo $universityError; ?>
                <input type='submit' name='selectUniversity' value='Submit'>
            </form>
            <a href='pull.php'>Click here to retrieve data</a>
        <?php } ?>
        </div>
    </body>
</html>
