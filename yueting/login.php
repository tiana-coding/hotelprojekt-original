
<?php
session_start();
include 'include/header.php';

$valid_username = 'antonm';
$valid_passwort_hash = password_hash(password: '12345678Ab!', algo: PASSWORD_DEFAULT);
$errors='';//initialisierung der variablen
$kundendaten = [

    'sex' => 'Herr',
    'vorname' => 'Anton',
    'nachname' => 'Müller',
    'username' => 'antonm',
    'passwort'=> '1x345x78Ab!',
    'email'=> 'anton.m@gmx.at',
    ];//statische daten

    $username = ''; 
  if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
  }
  if(isset($_GET['logout']) && $_GET['logout'] === 'success'){
    echo '<div class="alert alert-success" role="alert"><p class="text-center">' . 'Sie wurden erfolgreich abgemeldet' . '</p></div>';
  }


// Überprüfen, ob das Formular abgesendet wurde
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['username']) ? trim(htmlspecialchars($_POST['username'])) : '';
    $passwort = isset($_POST['passwort']) ? trim(htmlspecialchars($_POST['passwort'])) : '';

    if($username === $valid_username && password_verify($passwort, $valid_passwort_hash)){ 
        
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['kundendaten'] = $kundendaten;

            header('Location: welcome.php');
            exit;
        }   else {
                $errors = 'Ihre Eingaben sind ungültig, Benutzername oder Passwort war falsch';
        }
        
    }     
    
?>


<div class="container rounded bg-primary py-5 my-3">
    <div class="container">
        <?php
        if(!empty($errors)){
            echo '<div class="alert alert-danger">' . $errors . '</div>';
            echo'<p class="text-center">'. htmlspecialchars($errors) . 'Bitte versuchen Sie es erneut</p>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="container">
                <h1 class="text-center my-3 py-5">Login</h1>
                <p>Melden Sie sich hier an</p>
                <hr>

                <div class="form-group">
                    <label for="username"><b>Username</b></label>
                    <input type="text"  class="form-control" placeholder="benutzername" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    
                </div>
                <div class="form-group mb-3">
                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="passwort eingeben" class="form-control" name="passwort" required>
                </div>

                
                
               
                
                <p>By creating an account you agree to our <a href="impressum.php" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="container">
                
                <button type="submit" class="btn btn-lg btn-light">Anmelden</button>
                
               
                </div>
            </div>    
    
                
              
        </form>
    </div>
</div>
    


<?php include 'include/footer.php';?>