<?php
session_start();

// Anmeldeprozess
/*if (isset($_POST['username']) && isset($_POST['password'])) {
    // Hier wird angenommen, dass du den Benutzernamen und das Passwort überprüfst
    // Beispiel:
    if ($_POST['username'] == 'username' && $_POST['password'] == 'password') {
        $_SESSION['username'] = $_POST['username'];  // Speichern des Benutzernamens in der Session
        // Nach erfolgreichem Login Weiterleitung zu index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Ungültige Anmeldedaten.";
    }
}*/
$error_msg = "";
$success_msg = "";
require_once '../config/dbaccess.php';//datenbank in register.php einbinden

// Wenn das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Benutzereingaben validieren
    $username = htmlspecialchars(trim($_POST['username']));
    
    $password = $_POST['password'];
    

    // Einfaches Beispiel: Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($username) || empty($password)) {
        echo "<p class='text-danger'>Alle Felder müssen ausgefüllt werden.</p>";
    }
    // Überprüfen, ob die Passwörter übereinstimmen
    
    else {
        //Validierung erfolgreich -> DB-Zugriff Prepared Statements


        // Passwort sicher Hashen
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       //check gibt es schon eine username oder useremail schon in der db?
        $sql_check = "SELECT id from users WHERE username = ? ";
        $stmt_check = $db_obj->prepare($sql_check);
        $stmt_check-> bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        //wenn daten schon vorliegt
        if($stmt_check->num_rows>0){
          $stmt_check->bind_result($hashed_password_db);
          $stmt_check->fetch();
        } 
         if($password_verrify($password, $hashed_password_db)){
            
          $_SESSION['username'] = $username;//username speichern in session
          
        }else{
          $error_msg = "ungültige Anmededaten.";
        }

           $stmt_insert->close();
        }
        $stmt_check->close();

      }

?>

<!-- login -->
<?php include '../include/header.php';?>
<?php include '../include/nav.php';?>
<div class="container-fluid my-5" >
  <h2 class="text-center">Login</h2>
  <?php if(!empty($error_msg)): ?>
    <div class="alert alert-danger"><?php echo $error_msg;?></div>
  <?php endif;?> 

  <?php if(!empty($success_msg)): ?>
    <div class="alert alert-sucess"><?php echo $success_msg;?></div>
  <?php endif;?>  
  <form class="container border rounded bg-grey border-shadow py-5 my-5" style= "max-width:640px;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div> 
<div class="container-fluid my-5 py-4 bg-primary">
  <?php include '../include/footer.php';?>
</div>
