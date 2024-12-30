<?php
include 'header.php';
require_once '../config/dbaccess.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['role'] || $_SESSION['role'] !== 'admin') {
    echo '<div class="alert alert-danger">Sie haben keine Berechtigung.</div>';
    exit();
}

if (!$db_obj) {
    die("Es besteht keine Verbindung zur Datenbank.");
}

// Benutzer aus der Datenbank abrufen
$sql = "SELECT user_id, username, status, useremail AS email FROM users ORDER BY user_id ASC";
$stmt = $db_obj->prepare($sql);

if (!$stmt) {
    die("Fehler beim Abrufen der Benutzerliste: " . htmlspecialchars($db_obj->error));
}

$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container-fluid mt-5">
    <h3 class="text-center">Benutzerliste</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Benutzer-ID</th>
                <th scope="col">Username</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                 <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <!-- GET-Methode für die Übergabe der user_id -->
                        <a href="update_user.php?user_id=<?php echo htmlspecialchars($row['user_id']); ?>" 
                           class="btn btn-primary btn-sm">Bearbeiten</a>
                        <?php if($row['status']== 'inactive'):?>
                             <a href='delete_user.php?user_id=<?php echo htmlspecialchars($row['user_id']); ?>' 
                           class="btn btn-secondary btn-sm">Löschen</a>
                          
            </div>
        </div>
    </div>
</div>


                        <?php endif ;?>   
                          
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
