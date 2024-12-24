<?php

include('header.php');
include('../config/dbaccess.php');

if(isset($_SESSION['username']) && isset($_SESSION['registered_user'])){
    


/*Kundendaten aufrufen */

$kundendaten = $_SESSION['registered_user'];
$success = '';
$errors = [];// von fehlermeldungen

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Kundendaten speichern, vergleichen, wenn nicht gleich aktualisieren
    $kundendaten['sex'] = $_POST['sex'] ?? $kundendaten['sex'];
    $kundendaten['vorname'] = $_POST['vorname'] ??  $kundendaten['vorname'];
    $kundendaten['nachname'] = $_POST['nachname'] ?? $kundendaten['nachname'];
    $kundendaten['username'] = $_POST['username'] ?? $kundendaten['username'];
    $kundendaten['email'] = $_POST['email'] ?? $kundendaten['email']; 

    //Passwort überprüfen, wenn geaendert werden soll!!
    if(!empty(($_POST['passwort']) && !empty($_POST['reset_passwort']) && !empty($_POST['reset_passwort_wiederholt']))){
        $passwort = $_POST['passwort'];//altes passwort
        $reset_passwort = $_POST['reset_passwort'];//neues Passwort
        $reset_passwort_wiederholt = $_POST['reset_passwort_wiederholt'];// neues passwort noch mal eingeben

        if(password_verify($passwort, $kundendaten['passwort'])){
            if($reset_passwort === $reset_passwort_wiederholt){
                $kundendaten['passwort'] = password_hash($reset_passwort, PASSWORD_DEFAULT);//salting kann auch implementiert werden, wird sicherer!!
            }else{
                $errors['reset_passwort'] = "Passwörter stimmen nicht überein";
                
            }
        }    
        if(empty($errors)){//if error ist empty kundendaten wurden erfolgreich geändert/aktuellisert, meldung für erfolgreiche änderung.
            $_SESSION['registered_user'] = $kundendaten;
            $success = "Ihre Daten wurden erfolgreich aktualisiert";
       
        }        
    }
}
else{
    header('Location: fct_logout.php');// nach erfolgreicher änderung der kundendaten, wird kunden weitergeleitet zur logoutseite
}
$_SESSION['registered_user'] = $kundendaten;//Kundendaten speichern
$success = $success ?: "Ihre Daten wurden erfolgreich aktualisiert";
//wenn es erfolgreich ist dann ist es entgültig fertig gespeichert
}



?>

<div class="container">
    <h1 class="text-center my-5">Kundendaten</h1>
    <p class="text-center">Hier können Sie Ihre Daten bearbeiten</p>
    <?php if($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
</div>
<div class="container py-4 my-3">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" novalidate>
        <div class="form-group">
                            <div class="container">
                                <label>Anrede</label>
        
                                <input  type="radio" name="sex" id="female" value="female" <?php echo ($anrede == 'female') ? 'checked':'';?>>
                                <label  for="female">Frau</label>
        
                                <input  type="radio" name="sex" id="male" value="male" <?php echo ($anrede == 'male') ? 'checked':'';?>>
                                <label  for="male">Herr</label>
                            </div>
                        </div>
        
                        <div class="form-group col-auto">
                            <label>Vorname:</label>
                            <input type="text"  id="vorname" name="vorname" value="<?php echo (empty($errors)) ? htmlspecialchars($vorname) : ''; ?>" >
                            <?php if (isset($errors['vorname'])): ?>
                                <small class="text-muted"><?php echo $errors['vorname']; ?></small>
                            <?php endif; ?>
                        </div>
        
                        <div class="form-group col-auto">
                            <label for="nachname">Nachname:</label>
                            <input type="text"  id="nachname" name="nachname" value="<?php echo (empty($errors)) ? htmlspecialchars($nachname) : ''; ?>" required >
                            <?php if (isset($errors['nachname'])): ?>
                                <small class="text-muted"><?php echo $errors['nachname']; ?></small>
                            <?php endif; ?>
                        </div>
        
                        <div class="form-group col-auto">
                            <label for="username">Username:</label>
                            <input type="text"  id="UID" name="username" placeholder="Username"  value="<?php echo (empty($errors)) ? htmlspecialchars($username) : ''; ?>"  required>
                            <?php if (isset($errors['username'])): ?>
                                <small class="text-muted"><?php echo $errors['username']; ?></small>
                            <?php endif; ?>
                        </div>
        
                        <div class="form-group col-auto">
                            <label for="E-mail">E-Mail:</label>
                            <input type="email"  id="email" name="email" class="form-control"  value="<?php echo (empty($errors)) ? htmlspecialchars($email) : ''; ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <small class="text-muted"><?php echo $errors['email']; ?></small>
                            <?php endif; ?>
                        </div>
        
                        <div class="form-group col-auto">
                            <label for="passwort"> altes Passwort eingeben:</label>
                            <input type="password"  id="passwort" name="passwort" placeholder="Passwort" class="form-control" required>
                            <?php if (isset($errors['passwort'])): ?>
                                <small class="text-muted"><?php echo $errors['passwort']; ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-auto">
                            <label for="reset_passwort">neues Passwort eingeben</label>
                            <input type="password"  id="reset_passwort" name="reset_passwort" placeholder="Passwort wiederholen" class="form-control" value="<?php echo($_SERVER['REQUEST_METHOD'] ==="POST")? htmlspecialchars($reset_passwort): '';?>"required>
                        <div class="form-group col-auto">
                            <label for="reset_passwort_wiederholt">neues Passwort eingeben</label>
                            <input type="password"  id="reset_passwort_wiederholt" name="reset_passwort_wiederholt" placeholder="Passwort wiederholen_wiederholt" class="form-control" value="<?php echo($_SERVER['REQUEST_METHOD'] ==="POST")? htmlspecialchars($reset_passwort_wiederholt): '';?>"required>
                            <?php if (isset($errors['reset_passwort'])): ?>
                                <small class="text-muted"><?php echo $errors['reset_passwort']; ?></small>
                            <?php endif; ?>
                        </div>
                        <button href="site_kundendaten.php" class="btn btn-lg btn-success mt-5">Daten aktualisieren</button>
        </div>
    </form>
  </div>  



<?php include('footer.php'); ?>