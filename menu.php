<?php
// Lấy tên tệp hiện tại
$current_file = basename($_SERVER['PHP_SELF']);
?>
<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
    <nav class="cl-effect-13" id="cl-effect-13">
    <ul class="nav navbar-nav">
        <li class="<?= $current_file == 'index.php' ? 'active' : '' ?>"><a href="index.php">Trang chủ</a></li>
        <li class="<?= $current_file == 'about.php' ? 'active' : '' ?>"><a href="about.php">Giới thiệu</a></li>
        <li class="<?= $current_file == 'hoso.php' ? 'active' : '' ?>"><a href="hoso.php">Tra cứu hồ sơ</a></li>
        <li class="<?= $current_file == 'contact.php' ? 'active' : '' ?>"><a href="contact.php">Liên hệ</a></li>
    </ul>
    
    </nav>

</div>