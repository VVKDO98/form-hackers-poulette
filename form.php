<?php
require ('db.php');

function sanitize($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['mail']) && isset($_POST['description'])){

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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form__name">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Ron">
    </div>
    <div class="form__firstname">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" placeholder="Weasley">
    </div>
    <div class="form__mail">
        <label for="mail">E-mail</label>
        <input type="email" name="mail" placeholder="ronweasley@wizard.com">
    </div>
    <div class="form__description">
        <label for="description">Message</label>
        <input type="text" name="description">
    </div>
    <div class="form__submit">
        <input type="submit" value="Submit">
    </div>
</form>