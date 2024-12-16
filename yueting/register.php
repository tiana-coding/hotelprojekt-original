<?php
 session_start();
 include 'include/header.php';
 ?>
    
<div class="container">
    <div class="container">
        <?php //initialisierung

            $anrede = $nachname = $vorname = $username = $email = $passwort = $passwort_wiederholt = '';
             $errors =[];
             // Diese Funktion bereinigt Eingaben, um Sicherheitsluecke zu vermeiden, akzeptiert nur html entiät.
             function reset_input($data) {
                return htmlspecialchars(trim($data));
            }
            if($_SERVER["REQUEST_METHOD"] ==="POST"){

                $anrede = isset($_POST['sex']) ? reset_input($_POST['sex']) :'';
                $vorname = isset($_POST['vorname']) ? reset_input($_POST['vorname']) :'';
                $nachname = isset($_POST['nachname']) ? reset_input($_POST['nachname']) :'';
                $username = isset($_POST['username']) ? reset_input($_POST['username']) :'';
                $email =  isset($_POST['email']) ? reset_input($_POST['email']) :'';
                $passwort = isset($_POST['passwort']) ? reset_input($_POST['passwort']) :'';
                $passwort_wiederholt = isset($_POST['passwort_wiederholt']) ? reset_input($_POST['passwort_wiederholt']) :'';
                
                if (empty($anrede)) {
                    $errors['anrede'] = "Bitte wählen Sie eine Anrede aus.";
                }
                if (empty($vorname)) {
                    $errors['vorname'] = "Geben Sie Ihren Vornamen ein.";
                }
                if (empty($nachname)) {
                    $errors['nachname'] = "Geben Sie Ihren Nachnamen ein.";
                }
                if (empty($username)) {
                    $errors['username'] = "Geben einen Username ein.";
                }
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "E-Mail Adresse muss gültig sein.";
                }
                if (empty($passwort) || strlen($passwort) < 8 || 
                    !preg_match('/[A-Z]/', $passwort) || 
                    !preg_match('/[a-z]/', $passwort) || 
                    !preg_match('/[0-9]/', $passwort) || 
                    !preg_match('/[\W]/', $passwort) ) { 
                    $errors['passwort'] = "Das Passwort muss mindestens 8 Zeichen lang sein sowohl Groß- als auch Kleinbuchstaben enthalten, eine Zahl und ein Sonderzeichen enthalten.";
                }
                if ($passwort_wiederholt !== $passwort) {
                    $errors['passwort_wiederholt'] = "Paswörte müssen überein stimmen.";
                }
                //kunden anlegen wenn existiert--kundendaten.txt

                
                if (empty($errors)) {

                    $_SESSION['registered_user'] = array (
                        'sex'=> $anrede,
                        'anrede' => $anrede,
                        'vorname' => $vorname,
                        'nachname' => $nachname,
                        'username'=> $username,
                        'email'=> $email,
                        'password'=> $passwort,

                    );
                        
                    
                   
                        $_SESSION['success']="Sie sind erfolgreich registriert";

                        header("Location: login.php");//weiterleitung zur Login
                        exit;
                        } else {
                        $_SESSION['errors'] = $errors;
                        $_SESSION['input']=$_POST;
                        header("Location: register.php");//zurück zur Registrierung 
                        exit;
                            
                        }
                    }            
  
            $errors = $_SESSION['errors'] ?? [];
            $input = $_SESSION['input'] ?? [];
            unset($_SESSION['errors'], $_SESSION['input']);

            $anrede =$input['sex'] ?? '';
            $vorname= $input['vorname'] ??'';
            $nachname= $input['nachname'] ??'';
            $username= $input['username'] ??'';
            $email= $input['email'] ??'';
            $passwort= $input['passwort'] ??'';
            $passwort_wiederholt= $input['passwort_wiederholt'] ??'';
            

        ?>
        
        <!--register form -->
        <form class="container rounded bg-primary py-5 my-5" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" novalidate>
            <div class="container">
                <h1>Registierung</h1>
                <p>Melden Sie sich an</p>
                <hr>
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
                    <label for="passwort">Passwort eingeben:</label>
                    <input type="password"  id="passwort" name="passwort" placeholder="Passwort" class="form-control" required>
                    <?php if (isset($errors['passwort'])): ?>
                        <small class="text-muted"><?php echo $errors['passwort']; ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-auto">
                    <label for="passwort_wiederholt">Passwort wiederholen:</label>
                    <input type="password"  id="passwort_wiederholt" name="passwort_wiederholt" placeholder="Passwort wiederholen" class="form-control" value="<?php echo($_SERVER['REQUEST_METHOD'] ==="POST")? htmlspecialchars($passwort_wiederholt): '';?>"required>
                    <?php if (isset($errors['passwort_wiederholt'])): ?>
                        <small class="text-muted"><?php echo $errors['passwort_wiederholt']; ?></small>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-light btn-lg my-3 p-2">Registrieren</button>
                <div class="container signin p-2">
                    <p>Already have an account? <a href="login.php">Login</a>.</p>
                </div>
            </div>     
        </form>   
    </div>

<?php include 'include/footer.php';?>