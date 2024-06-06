<?php 
require_once "db.php";

session_start();

// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
//     header('Location:../login.php');
//   exit;
// }

// $email = $_SESSION['email'];

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    // This is an AJAX request

    
        $author = $_POST['author'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Add task to DB
        $sql = "INSERT INTO posts(author, title, content) VALUES (?,?,?)";

        $stmt = $db->prepare($sql);

        try {
            $stmt->execute([$author, $title, $content]);
            echo json_encode(['status' => 'success', 'message' => 'Post added successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
   
} else {
    // This is a normal request (non-AJAX)
    if (isset($_POST["submit"])) {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Add task to DB
        $sql = "INSERT INTO posts(author, title, content) VALUES (?,?,?)";

        $stmt = $db->prepare($sql);

        try {
            $stmt->execute([$author, $title, $content]);
            header('Location:../posts.php?posted');
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
