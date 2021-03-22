<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La société Hackers Poulette ™ vend des kits d'accessoires Raspberry Pi pour créer les vôtres." />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>

<?php
if (isset($_POST['firstname'])){ //les variables sont déjà crées
	// initialisation variable
	$firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$country = $_POST['country'];
	$subject = $_POST['subject'];
    $message = $_POST['message'];
	$msg = ["", "", "", "", ""];

	// radio gender
	if ((isset($_POST['gender'])) && ($_POST['gender'] !== null)) { //complété
		$gender = $_POST['gender'];
		$gender1 = ($gender == "Madame") ? "checked" : "";
		$gender2 = ($gender == "Monsieur") ? "checked" : "";
		} else { // pas complété
			$msg[2] = "Le champ du genre n'est pas rempli.";
			$gender = "";
			$gender1 = "";
			$gender2 = "";
			}

	// nettoyage des champs
	// https://www.php.net/manual/en/filter.filters.sanitize.php
	$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$message = filter_var($_POST['story'], FILTER_SANITIZE_STRING);

	// validation des champs
	$formValid = true; // si pas d'erreur dans la formulaire
	if ($firstname == "") {
		$formValid = false;
		$msg[0] = "Votre prénom n'est pas correct.";
		}
    if ($lastname == "") {
        $formValid = false;
        $msg[1] = "Votre nom n'est pas correct.";
        }
	if (($email == "") || (false === filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$formValid = false;
		$msg[3]= "Votre email n'est pas correct.";
		}
	if ($country == "") {
		$formValid = false;
		$msg[4]= "Votre pays n'est pas choisi.";
		}
	if ($message == "") {
		$formValid = false;
		$msg[6]= "Votre message n'est pas rempli.";
		}

	if ($formValid) { // true
		/*try { // mettre dans la bdd
			$bdd = new PDO('mysql:host=localhost;dbname=test','root', '');
			$req = "INSERT INTO `bdd_form` (`id`, `firstname`, `email`, `age`, `painter`, `story`) VALUES (NULL, '".$firstname."', '".$email."', ".$age.", '".$painter."', '".$story."')";
			$bdd->exec($req);
			$bdd = null; // fermer la connexion à la base de données
			echo "Envoi dans la BDD";
			} catch (PDOException $e) {
				print "Erreur !: ".$e->getMessage()."<br/>";
				die();
				}*/
        print_r("OK");
		// tout s'est bien passé, renvoi vers une autre page
		/*header("Location: merci.php");*/

		} else { // false

			}

	} else { // 1ère fois qu'on on accède à la page
		$firstname = "";
        $lastname = "";
        $gender1 = "";
		$gender2 = "";
		$email = "";
		$country = "";
		$subject = "Other";
		$story = "";
		$msg = ["", "", "", "", "", "", ""];
		}

?>


    <form method="post" action="index.php">
        <label for="firstname">First name : </label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>" required>
            <div class="error"><?php echo $msg[0];?></div>
        <label for="firstname">Last name : </label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $lastname;?>" required>
            <div class="error"><?php echo $msg[1];?></div>
        <label for="gender" required>Genre : </label>
            <input type="radio" id="madame" name="gender" value="Madame" <?php echo $genderF;?> required> Madame 
            <input type="radio" id="monsieur" name="gender" value="Monsieur"<?php echo $genderM;?>> Monsieur
            <div class="error"><?php echo $msg[2];?></div>
        <label for="email">Email : </label>
            <input type="text" id="email" name="email" value="<?php echo $email;?>" required>
            <div class="error"><?php echo $msg[3];?></div>
        <label for="country">Country :</label>
            <select class="form-select" id="country" required>
                <option value="" selected disabled>Choose your country : </option>
                <option>Belgium</option>
                <option>France</option>
                <option>Luxembourg</option>
                <option>Netherlands</option>
                <option>Germany</option>
            </select>
            <div class="error"><?php echo $msg[4];?></div>
        <label for="subject">Subject :</label>
            <select class="form-select" id="subject">
                <option value="" selected>Other</option>
                <option>Informations</option>
                <option>Reimbursement</option>
                <option>Delivery</option>
            </select>
            <div class="error"><?php echo $msg[5];?></div>
        <label for="message">Message :</label>
            <textarea name="message" id="message"><?php echo $message;?></textarea>
            <div class="error"><?php echo $msg[6];?></div>
        <input type="submit" name="submit" value="Send">
    <script src="assets/js/script.js"></script>
</body>

</html>