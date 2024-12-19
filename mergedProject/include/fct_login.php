<?php
session_start();

$error_msg = "";
$success_msg = "";
require_once '../config/dbaccess.php';//datenbank in register.php einbinden
//prüfen ob db verbindung gibt
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}

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
        //DB-Zugriff Prepared Statements

       //check gibt es schon username in der db?
        $sql_check = "SELECT password from users WHERE username = ?";
        $stmt_check = $db_obj->prepare($sql_check);
        $stmt_check-> bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        //wenn username schon vorliegt
        if($stmt_check->num_rows>0){
          $stmt_check->bind_result($hashed_password_db);
          $stmt_check->fetch();
          if(password_verify($password, $hashed_password_db)){  
            $_SESSION['username'] = $username;//username speichern in session
            $success_msg="Login erfolgreich!";
          }else{
            $error_msg = "Ungültige Anmeldedaten. Versuchen Sie es noch mal!";
          }
  
        } 


      }
        $stmt_check->close();

    }

?>

<!-- login -->
<?php include '../include/header.php';?>

<div class="container-fluid my-5" >
  <h2 class="text-center">Login</h2>  
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

  <?php include '../include/footer.php';?>