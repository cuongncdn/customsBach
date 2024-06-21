
<?php
require_once "admin/functions/db.php";

// Biến để lưu kết quả tra cứu
$search_result = null;

// Kiểm tra nếu người dùng đã gửi yêu cầu tra cứu
if (isset($_POST['search'])) {
    $search_term = $_POST['search_term'];

    // Tìm kiếm hồ sơ theo mã đã nhập
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $search_result = $result->fetch_assoc();
    } else {
        $search_result = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="images/icon.png">
<title>Company</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Coalition Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- banner -->
	<div class="banner1">
		<div class="container">
		<?php include "head_bar.php"?>
			<div class="agileits_w3layouts_banner_nav">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img-responsive"></a></h1>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<?php include "menu.php"?>
				</nav>
			</div>
		</div>
	</div>
<!-- //banner -->
	<div class="gallery">
		<div class="container">
			<h2 class="w3l_head w3l_head1">Tra cứu hồ sơ</h2>
			<div class="wthree_gallery_grids">
				
			<div class="row">
				<!-- Form tra cứu hồ sơ -->
				<form id="searchForm">
					<div class="form-group">
						<label for="search_term">Nhập mã hồ sơ:</label>
						<input type="text" class="form-control" id="search_term" name="search_term" required>
					</div>
					<button type="submit" class="btn btn-primary">Tra cứu</button>
				</form>
			</div>

			<div class="row" id="searchResult">
				<!-- Kết quả tra cứu sẽ được hiển thị ở đây -->
			</div>
			<script src="js/jzBox.js"></script>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		$('#searchForm').on('submit', function(event){
			event.preventDefault();
			var searchTerm = $('#search_term').val();
			$.ajax({
				url: 'functions/tracuu_ajax.php',
				type: 'POST',
				data: {search_term: searchTerm},
				dataType: 'json',
				success: function(response){
					if(response.status == 'success'){
						var result = response.data;
						$('#searchResult').html(`
							<div class="result-box">
								<h3>Kết quả tra cứu:</h3>
								<p><strong>Mã hồ sơ:</strong> ${result.title}</p>
								<p><strong>Tên cán bộ quản lý:</strong> ${result.author}</p>
								<p><strong>Nội dung:</strong> ${result.content.replace(/\n/g, '<br>')}</p>
							</div>
						`);
					} else {
						$('#searchResult').html(`<p>${response.message}</p>`);
					}
				},
				error: function(){
					$('#searchResult').html('<p>Đã xảy ra lỗi trong quá trình tra cứu.</p>');
				}
			});
		});
	});
	</script>
	
	<?php 
		include("footer.php");
	?>
