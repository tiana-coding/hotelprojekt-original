<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $errors = [];

        if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
            $errors[] = "Alle Felder müssen ausgefüllt werden.";
        }

        if ($password !== $password_confirm) {
            $errors[] = "Die Passwörter stimmen nicht überein.";
        }

        if (empty($errors)) {
            echo "<p>Registrierung erfolgreich! Sie können sich jetzt anmelden.</p>";
        } else {
            foreach ($errors as $error) {
                echo "<p class='text-danger'>$error</p>";
            }
        }
    }

    if (isset($_POST['login'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        $correct_username = 'admin';
        $correct_password = '1234';

        if ($login_username === $correct_username && $login_password === $correct_password) {
            echo "<p>Willkommen, $login_username!</p>";
        } else {
            echo "<p class='text-danger'>Ungültige Anmeldedaten!</p>";
        }
    }
}
?>

<?php include 'fct_register.php';?>
<hr>
<?php include 'fct_login.php';?>
