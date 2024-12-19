<?php 
session_start(); 
$error_msg = "";
$success_msg = "";
require_once '../config/dbaccess.php';//datenbank in register.php einbinden
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}


// Wenn das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Benutzereingaben validieren
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Einfaches Beispiel: Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        echo "<p class='text-danger'>Alle Felder müssen ausgefüllt werden.</p>";
    }
    // Überprüfen, ob die Passwörter übereinstimmen
    elseif ($password !== $password_confirm) {
        echo "<p class='text-danger'>Die Passwörter stimmen nicht überein.</p>";
    }
    // E-Mail-Validierung
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='text-danger'>Ungültige E-Mail-Adresse.</p>";
    } else {
        //Validierung erfolgreich -> DB-Zugriff Prepared Statements


        // Passwort sicher Hashen
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       //check gibt es schon eine username oder useremail schon in der db?
        $sql_check = "SELECT id from users WHERE username = ? OR useremail = ? ";
        $stmt_check = $db_obj->prepare($sql_check);
        $stmt_check-> bind_param("ss", $username, $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        //wenn daten schon vorliegt
        if($stmt_check->num_rows>0){
          $error_msg="Benuzer existiert, loggen Sie sich bitte ein.";
        } 
        else{//insert user into table
              $sql_insert = "INSERT INTO users(`username`, `password`, `useremail`) VALUES (?,?,?)";
              $stmt_insert = $db_obj->prepare($sql_insert);
              $stmt_insert->bind_param("sss", $username, $hashed_password, $email);

            //wenn kundendaten hinzugefügt wurde
           if($stmt_insert->execute()) {
              $success_msg = "Ihre Registrierung war erfolgreich. Sie können sich einloggen";
              header("Location: welcome.php");
              exit();
            
    
           } else{
            $error_msg="Die Registrierung ist fehlgeschlagen, versuchen Sie es noch mal.";
           }

           $stmt_insert->close();
        }
        $stmt_check->close();




  
    }
    
}
?>

<!-- Sign up/Registrierungsformular -->
<?php include '../include/header.php';?>

<div  class="container-fluid my-5" style= "max-width:640px;">
  <h2 class="text-center">Kundenregistrierung</h2>
  <!-- registrierung fehlgeschlagen, fehlermeldung -->
  <?php if(!empty($error_msg)): ?>
    <div class="alert alert-danger"><?php echo $error_msg;?></div>
  <?php endif;?> 

  <?php if(!empty($success_msg)): ?>
    <div class="alert alert-sucess"><?php echo $success_msg;?></div>
  <?php endif;?>  


  <form class="container border rounded bg-grey border-shadow py-5 my-5" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-Mail</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
      <label for="password_confirm" class="form-label">Passwort bestätigen</label>
      <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrieren</button>
  </form>
</div>  

  <?php include '../include/footer.php';?>
