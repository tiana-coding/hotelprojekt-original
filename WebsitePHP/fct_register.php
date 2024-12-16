<h2>Kundenregistrierung</h2>
<form method="POST" action="site_register.php">
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
