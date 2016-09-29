<?php 

    require_once 'DB.php';
    require_once 'credentials/credentials.php';
    
    $username = getOutputCreds()[0];
    $password = getOutputCreds()[1];
    
    if (isset($_POST['username']) && $_POST['username'] === $username &&
            isset($_POST['password']) && $_POST['password'] === $password) {
        $verified = TRUE;
    } else {
        $verified = FALSE;
    }
    
    //$out will be filled with data that can be exported directly as a .csv file.
    //No file needs to be saved. The raw csv data will be downloaded as a file by
    //the browser
    if ($verified == TRUE) {
        $out = "Student First Name, Student Last Name, University, ".
                "Instructor, Time \n";
        $results = getAll();
        forEach($results as $line) {
            $out .= $line['studentFirstname'].',';
            $out .= $line['studentLastname'].',';
            $out .= $line['university'].',';
            $out .= $line['instructor'].',';
            $out .= date("M j Y g:i:s A", strtotime($line['whenSubmitted']))." CST \n";
        }

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=output.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        print $out;
        $verified = FALSE;

        
    } else { ?>
        <!DOCTYPE html>

            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="css/main.css">
                <title>Participation Survey</title>
            </head>
            <body>
                <div class='wrapper'>
                    <form method='post' action='pull.php'>
                        <label class='nameLabel' for='username'>Username</label>
                        <input type='text' name='username'>
                        <label class='nameLabel' for='password'>Password</label>
                        <input type='password' name='password'>                        
                        <input type='submit' name='getData' value='Download'>
                    </form>
                </div>
            </body>
        </html>        
    <?php } 
?>


