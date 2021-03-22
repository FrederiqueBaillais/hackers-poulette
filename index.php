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
    <form method="post" action="form-application.php">
        <label for="firstname">First name : </label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>" required>
            <div class="error"><?php echo $msg[0];?></div>
        <label for="firstname">Last name : </label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $lastname;?>" required>
            <div class="error"><?php echo $msg[0];?></div>
        <label for="gender" required>Genre : </label><br>
            <input type="radio" id="madame" name="gender" value="Madame" <?php echo $genderF;?> required> Madame 
            <input type="radio" id="monsieur" name="gender" value="Monsieur"<?php echo $genderM;?>> Monsieur <br>
            <div class="error"><?php echo $msg[3];?></div>
        <label for="email">Email : </label><br>
            <input type="text" id="email" name="email" value="<?php echo $email;?>" required><br>
            <div class="error"><?php echo $msg[1];?></div>
        <label for="country">Country :</label>
            <select class="form-select" id="country" required>
                <option value="" selected disabled>Choose your country : </option>
                <option>Belgique</option>
                <option>France</option>
                <option>Luxembourg</option>
                <option>Pays-Bas</option>
                <option>Allemagne</option>
            </select>
            <div class="error"><?php echo $msg[5];?></div>
        <label for="subject">Sujet :</label><br>
            <select class="form-select" id="subject">
                <option value="" selected>Autre</option>
                <option>Informations</option>
                <option>Reimbursement</option>
                <option>Delivery</option>
            </select><br>
            <div class="error"><?php echo $msg[5];?></div><br>
        <label for="message">Message :</label><br>
            <textarea name="message" id="message"><?php echo $message;?></textarea><br>
            <div class="error"><?php echo $msg[4];?></div><br>
        <input type="submit" name="submit" value="Submit">
    <script src="assets/js/script.js"></script>
</body>

</html>