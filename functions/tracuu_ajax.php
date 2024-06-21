<?php
require_once "../admin/functions/db.php";

if (isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];

    $sql = "SELECT * FROM posts WHERE title = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $search_result = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $search_result]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy hồ sơ với mã đã nhập.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
