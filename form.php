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
        } elseif (strlen($_POST['description']) > 255){
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
    }
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="contactForm">
    <div class="form">
        <div class="form__name form__block">
            <input class="form__input" type="text" name="name" placeholder="Your name" id="inputName">
            <?php if(isset($nameErr)){?>
                <p><?php echo $nameErr ?></p>
            <?php } ?>
        </div>
        <div class="form__firstname form__block">
            <input class="form__input" type="text" name="firstname" placeholder="Your firstname" id="inputFirstname">
            <?php if(isset($firstnameErr)){?>
                <p><?php echo $firstnameErr ?></p>
            <?php } ?>
        </div>
        <div class="form__mail form__block">
            <input class="form__input" type="email" name="mail" placeholder="Your email" id="inputMail">
            <?php if(isset($mailErr)){?>
                <p><?php echo $mailErr ?></p>
            <?php } ?>
        </div>
        <div class="form__description form__block">
            <input class="form__input" type="text" name="description" placeholder="Your message" id="inputDescription">
            <?php if(isset($descriptionErr)){?>
                <p><?php echo $descriptionErr ?></p>
            <?php } ?>
        </div>
        <div class="form__submit form__block">
            <input type="submit" value="Send" id="submit">
        </div>
    </div>
</form>