<?php
require ('db.php');

function sanitize($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $firstname = $mail = $description = "";
    $nameErr = $firstnameErr = $mailErr = $descriptionErr = "";

    if (empty($_POST['name'])){
        $nameErr = "Name is required";
    } else{
        $name = sanitize($_POST['name']);
    }
    if (empty($_POST['firstname'])){
        $firstnameErr = "Firstname is required";
    } else{
        $firstname = sanitize($_POST['firstname']);
    }
    if (empty($_POST['mail'])){
        $firstnameErr = "Mail is required";
    } else{
        $mail = sanitize($_POST['mail']);
    }
    if (empty($_POST['description'])){
        $firstnameErr = "Description is required";
    } else{
        $description = sanitize($_POST['description']);
    }

    $insert = $db->prepare("INSERT INTO contact (name,firstname,mail,description) VALUES (?,?,?,?)");

    $insert->execute([
        $name,
        $firstname,
        $mail,
        $description
    ]);
}




?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form__name">
        <label for="name">Enter your name</label>
        <input type="text" name="name" placeholder="Ron">
    </div>
    <div class="form__firstname">
        <label for="firstname">Enter your firstname</label>
        <input type="text" name="firstname" placeholder="Weasley">
    </div>
    <div class="form__mail">
        <label for="mail">Enter your mail</label>
        <input type="text" name="mail" placeholder="ronweasleyisnotginger@mail.com">
    </div>
    <div class="form__description">
        <label for="description">Describe the problem</label>
        <input type="text" name="description">
    </div>
    <div class="form__submit">
        <input type="submit" value="Submit">
    </div>
</form>