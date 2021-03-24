<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La société Hackers Poulette ™ vend des kits d'accessoires Raspberry Pi pour créer les vôtres." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Hackers poulette FBA</title>
</head>

<body>

<?php

                //Import PHPMailer classes into the global namespace
                //These must be at the top of your script, not inside a function
                require PHPMailer\PHPMailer\PHPMailer;
                require PHPMailer\PHPMailer\SMTP;
                require PHPMailer\PHPMailer\Exception;

                //Load Composer's autoloader
                require 'vendor/autoload.php';

                //Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);
                
if(isset($_POST['fake-field']) && $_POST['fake-field'] != '') {
    die();

    } else {
        if (isset($_POST['firstname'])){ //les variables sont déjà crées
            // initialisation variable
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $country = $_POST['country'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $msg = ["", "", "", "", "", "", ""];

            // radio gender
            if ((isset($_POST['gender'])) && ($_POST['gender'] !== null)) { //complété
                $gender = $_POST['gender'];
                $gender1 = ($gender == "miss") ? "checked" : "";
                $gender2 = ($gender == "mister") ? "checked" : "";
                } else { // pas complété
                    $msg[2] = "The gender field is not filled in.";
                    $gender = "";
                    $gender1 = "";
                    $gender2 = "";
                    }

            // nettoyage des champs
            // https://www.php.net/manual/en/filter.filters.sanitize.php
            $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
            $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

            // validation des champs
            $formValid == true; // si pas d'erreur dans la formulaire
            if ($firstname == "") {
                $formValid == false;
                $msg[0] = "Your first name is not correct.";
                }
            if ($lastname == "") {
                $formValid == false;
                $msg[1] = "Your last name is not correct.";
                }
            if (($email == "") || (false === filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $formValid == false;
                $msg[3]= "Your email is not correct.";
                }
            if ($country == "") {
                $formValid == false;
                $msg[4]= "Please select a country.";
                }
            if ($message == "") {
                $formValid == false;
                $msg[6]= "Your message is not filled in.";
                }

            if ($formValid == true) { // true
                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->IsSMTP();                                            //Send using SMTP
                    $mail->Mailer = "smtp";
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->SMTPSecure = "PHPMailer::ENCRYPTION_SMTPS";          //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    $mail->Host       = "smtp.yopmail.com";                     //Set the SMTP server to send through
                    $mail->Username   = "fred.bail.becode@yopmail.com";         //SMTP username

                    $mail->AddAddress("fred.bail.becode@yopmail.com", "Fred Bail");
                    $mail->AddAddress("$email", "$firstname $lastname");
                    $mail->SetFrom("$email", "$firstname $lastname");
                    
                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = "Name : $gender $name $lastName <br> From : $email <br> Country : $country <br> Content :  $message  ";
                    $mail->send();

                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
echo("OK");
            } else { // 1ère fois qu'on on accède à la page
                $firstname = "";
                $lastname = "";
                $gender1 = "";
                $gender2 = "";
                $email = "";
                $country = "";
                $subject = "Other";
                $message = "";
                $msg = ["", "", "", "", "", "", ""];
                }
            }
        }

?>

<img class="rounded mx-auto d-block" src="/img/hackers-poulette-logo.png" alt="Logo de la société Hackers Poulette"/>
<h1 class="title text-center">Contact form</h1>

    <form method="post" action="index.php" class="row g-3 needs-validation" novalidate>
    <!-- https://getbootstrap.com/docs/5.0/forms/validation/ -->

        <div class="fake"><input name="fake-field"></div>

        <div class="form-check form-check-inline col-10 col-md-2 offset-1 offset-md-3 text-center">
            <label for="firstname">First name</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>" required>
            <div class="error text-center"><?php echo $msg[0];?></div>
        </div>
<!--         <?php print_r($firstname); ?> -->
        <div class="form-check form-check-inline col-10 col-md-2 offset-1 offset-md-2 text-center">
            <label for="lastname">Last name</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $lastname;?>" required>
            <div class="error text-center"><?php echo $msg[1];?></div>
        </div>
<!--         <?php print_r($lastname); ?> -->
        <div class="form-check form-check-inline offset-1 col-10 offset-md-3 col-md-2">
            <label for="gender" required>Gender</label>
        </div>
        <div class="form-check form-check-inline offset-1 col-4 col-md-2">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="miss" required>
            <label class="form-check-label" for="miss">Miss</label>
        </div>
        <div class="form-check form-check-inline col-4 col-md-2">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="mister">
            <label class="form-check-label" for="mister">Mister</label>
        </div>
        <div class="error text-center"><?php echo $msg[2];?></div>
<!--         <?php print_r($gender); ?> -->
        <div class="col-10 col-md-6 offset-1 offset-md-3 text-center">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name ="email" id="email" value="<?php echo $email;?>" required>
            <div class="error text-center"><?php echo $msg[3];?></div>
        </div>
<!--         <?php print_r($email); ?> -->
        <div class="col-10 col-md-6 offset-1 offset-md-3 text-center">
            <label for="country" class="form-label">Country</label>
            <select class="form-select" aria-label="country" id="country" name="country" required>
                <option selected>Choose your country</option>
                <option value="Belgium">Belgium</option>
                <option value="France">France</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Germany">Germany</option>
            </select>
            <div class="error text-center"><?php echo $msg[4];?></div>
        </div>
<!--         <?php print_r($country); ?> -->
        <div class="col-10 col-md-6 offset-1 offset-md-3 text-center">
            <label for="subject" class="form-label">Subject</label>
            <select class="form-select" aria-label="subject" id="subject" name="subject">
                <option value="Other" selected>Other</option>
                <option value="Informations">Informations</option>
                <option value="Reimbursement">Reimbursement</option>
                <option value="Delivery">Delivery</option>
            </select>
            <div class="error text-center"><?php echo $msg[5];?></div>
        </div>
<!--         <?php print_r($subject); ?> -->
        <div class="col-10 col-md-6 offset-1 offset-md-3 text-center">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="message" rows="3" style="resize: none;"><?php echo $message;?></textarea>
            <div class="error text-center"><?php echo $msg[6];?></div>
        </div>
<!--         <?php print_r($message); ?> -->
        <div class="col-2 col-md-2 offset-5 offset-md-5 text-center">
            <button type="submit" class="btn btn-primary mb-2">Send</button>
        </div>

    </form>       

    <p class="text-center">Créé par FrederiqueBaillais pour BeCode (Charleroi)</p>

    <!--<script src="assets/js/script.js"></script>-->
</body>

</html>