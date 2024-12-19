<?php
session_start();

$error_msg = "";
$success_msg = "";
require_once '../config/dbaccess.php';//datenbank in register.php einbinden
<<<<<<< HEAD
//prüfen ob db verbindung gibt
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
=======
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
>>>>>>> 7a7124abd40d8f56ad1eae4cef8ddc9f9754a417

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
<<<<<<< HEAD
        //DB-Zugriff Prepared Statements

       //check gibt es schon username in der db?
        $sql_check = "SELECT password from users WHERE username = ?";
=======
       //check gibt es schon den username in der db?
        $sql_check = "SELECT password from users WHERE username = ? ";
>>>>>>> 7a7124abd40d8f56ad1eae4cef8ddc9f9754a417
        $stmt_check = $db_obj->prepare($sql_check);
        $stmt_check-> bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        //wenn username schon vorliegt
        if($stmt_check->num_rows>0){
          $stmt_check->bind_result($hashed_password_db);
          $stmt_check->fetch();
<<<<<<< HEAD
          if(password_verify($password, $hashed_password_db)){  
            $_SESSION['username'] = $username;//username speichern in session
            $success_msg="Login erfolgreich!";
          }else{
            $error_msg = "Ungültige Anmeldedaten. Versuchen Sie es noch mal!";
          }
  
        } 

=======
          if(password_verify($password, $hashed_password_db)){
            
            $_SESSION['username'] = $username;//username speichern in session
            
          }else{
            $error_msg = "ungültige Anmededaten.";
          }
          }
        } 
         
        $stmt_check->close();
>>>>>>> 7a7124abd40d8f56ad1eae4cef8ddc9f9754a417

      }
        $stmt_check->close();

    }

?>

<!-- login -->
<?php include '../include/header.php';?>

<div class="container-fluid my-5" >
<<<<<<< HEAD
  <h2 class="text-center">Login</h2>  
=======
  <h2 class="text-center">Login</h2>
 
>>>>>>> 7a7124abd40d8f56ad1eae4cef8ddc9f9754a417
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