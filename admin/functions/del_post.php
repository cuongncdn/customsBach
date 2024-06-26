<?php
require_once "db.php"; // File chứa kết nối đến cơ sở dữ liệu

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    // Câu SQL với tham số hóa
    $sql = "UPDATE posts SET deleted = 1 WHERE id = ?";

    // Chuẩn bị câu lệnh SQL
    $stmt = $db->prepare($sql);

    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh SQL: " . $db->error);
    }

    try {
        // Bind tham số và gán giá trị
        $stmt->bind_param("i", $id);

        // Thực thi câu lệnh SQL
        if ($stmt->execute()) {
            // Chuyển hướng sau khi cập nhật thành công
            header('Location: ../posts.php?deleted');
            exit;
        } else {
            // Xử lý lỗi khi thực thi câu lệnh SQL
            echo "Lỗi khi cập nhật.";
        }
    } catch (Exception $e) {
        // Xử lý các ngoại lệ (trường hợp lỗi)
        echo "Lỗi: " . $e->getMessage();
    }

    // Đóng câu lệnh prepared statement
    $stmt->close();
} else {
    // Xử lý khi không có đủ thông tin từ form
    header('Location: ../posts.php?del_error');
    exit;
}

