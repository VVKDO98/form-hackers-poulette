<?php
require ('db.php');

function sanitize($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name is valid
    if(!isset($_POST['name'])){
        $nameErr = "Name is empty";
        $valid = false;
    } else{
        if(strlen($_POST['name']) < 2){
            $nameErr = "Name contains less than 2 characters";
            $valid = false;
        } elseif (strlen($_POST['name']) > 255){
            $nameErr = "Name contains more than 255 characters";
            $valid = false;
        }
    }
    // Check if firstname is valid
    if(!isset($_POST['firstname'])){
        $firstnameErr = "Firstname is empty";
        $valid = false;
    }else{
        if(strlen($_POST['firstname']) < 2){
            $nameErr = "Firstname contains less than 2 characters";
            $valid = false;
        } elseif (strlen($_POST['firstname']) > 255){
            $nameErr = "Firstname contains more than 255 characters";
            $valid = false;
        }
    }
    // Check if mail is valid
    if(!isset($_POST['mail'])){
        $mailErr = "Mail is empty";
        $valid = false;
    }else{
        if(strlen($_POST['mail']) < 2){
            $mailErr = "Mail contains less than 2 characters";
            $valid = false;
        } elseif (strlen($_POST['mail']) > 255){
            $mailErr = "Mail contains more than 255 characters";
            $valid = false;
        }
    }
    // Check if description is valid
    if(!isset($_POST['description'])){
        $descriptionErr = "Description is empty";
        $valid = false;
    }else{
        if(strlen($_POST['description']) < 2){
            $descriptionErr = "Description contains less than 2 characters";
            $valid = false;
        } elseif (strlen($_POST['description']) > 1000){
            $descriptionErr = "Description contains more than 255 characters";
            $valid = false;
        }
    }

    // If it's valid send to DB
    if ($valid){
        $name = filter_var(sanitize($_POST['name']),FILTER_SANITIZE_STRING);
        $firstname = filter_var(sanitize($_POST['firstname']),FILTER_SANITIZE_STRING);
        $mail = filter_var(sanitize($_POST['mail']),FILTER_SANITIZE_EMAIL);
        $description = filter_var(sanitize($_POST['description']),FILTER_SANITIZE_STRING);

        $insert = $db->prepare("INSERT INTO contact (name,firstname,mail,description) VALUES (?,?,?,?)");

        $insert->execute([
            $name,
            $firstname,
            $mail,
            $description
        ]);

        // Send mail
        // $to = "vanvolcksom.doriano01@gmail.com";
        // $subject = "Message successfully sent";
        // $message = "We have received your email, we will contact you as soon as possible!";

        // mail($to,$subject,$message);
    }
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="contactForm">
    <div class="form">
        <div class="form__error">
            <p id="form__errorMessage"></p>
        </div>
        <div class="form__name form__block">
            <input class="form__input" id="inputName" type="text" name="name" placeholder="Your name" required>
        </div>
        <div class="form__firstname form__block">
            <input class="form__input" id="inputFirstname" type="text" name="firstname" placeholder="Your firstname" required>
        </div>
        <div class="form__mail form__block">
            <input class="form__input" id="inputMail" type="email" name="mail" placeholder="Your email" required>
        </div>
        <div class="form__description form__block">
            <textarea class="form__input" name="description" id="inputDescription" cols="30" rows="10"  placeholder="Your message"  required></textarea>
        </div>
        <div class="form__submit form__block">
            <input type="submit" value="Send" id="submitbtn">
        </div>
    </div>
</form>