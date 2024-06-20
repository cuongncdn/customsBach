
<?php 

    ob_start();
    require_once "functions/db.php";

    // Initialize the session

    session_start();

    // If session variable is not set it will redirect to login page

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){

      header("location: login.php");

      exit;
    }
    if(!isset($_GET['id'])){
        echo 'Not Found 404!';
        exit;
    }else{
        $sql = 'SELECT * FROM posts WHERE id='.$_GET['id'];

        $query = mysqli_query($connection, $sql);
        $post = mysqli_fetch_array($query);
        if(isset($post)){
          
        }else{
            echo 'Not Found 404!';
            exit;
        }
        
    }

    $email = $_SESSION['email'];
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/icon.png">
    <title>Cục Hải Quan Đà Nẵng</title>
    <!-- Bootstrap Core CSS -->
   <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Wizard CSS -->
    <link href="../plugins/bower_components/jquery-wizard-master/css/wizard.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
  <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                 <div class="top-left-part"><a class="logo" href="index.php"><b><img src="../plugins/images/icon.png" style="width: 30px; height: 30px;" alt="home" /></b><span class="hidden-xs"><b>Company</b></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    
                    <!-- /.dropdown -->
                    
                  
                   
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <?php include 'layout/sidebar-left.php';?>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $email;?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="#">Tranh chính</a></li>
                            <li><a href="#">Hồ sơ</a></li>
                            <li class="active"><?php echo $post['title']?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                       <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Cập nhật: <?php echo $post['title']?></h3>
                            <p class="text-muted m-b-30 font-13"> Cập nhật hồ sơ với 3 bước Cán bộ thực hiện -> Mã hồ sơ -> Nội dung hồ sơ.</p>
                            <div id="exampleValidator" class="wizard">
                                <ul class="wizard-steps" role="tablist">
                                    <li class="active" role="tab">
                                        <h4><span><i class="ti-user"></i></span>Cán bộ thực hiện</h4> </li>
                                    <li role="tab">
                                        <h4><span><i class="ti-marker-alt"></i></span>Mã hồ sơ</h4> </li>
                                    <li role="tab">
                                        <h4><span><i class="ti-book"></i></span>Nội dung hồ sơ</h4> </li>
                                </ul>
                                <form id="validation" class="form-horizontal" action="functions/new_post.php" method="post">
                                    <div class="wizard-content">
                                        <div class="wizard-pane active" role="tabpanel">
                                            <div class="form-group">
                                                <label class="col-xs-3 control-label">Cán bộ thực hiện  (<i>Nhập tên Người thực hiện hồ sơ.</i>)</label>
                                                <div class="col-xs-5">
                                                    <input type="text" value="<?php echo $post['author']?>" class="form-control" name="author"/> </div>
                                            </div>
                                        </div>
                                        <div class="wizard-pane" role="tabpanel">
                                            <div class="form-group">
                                                <label class="col-xs-3 control-label">Mã hồ sơ</label>
                                                <div class="col-xs-5">
                                                    <input type="text" value="<?php echo $post['title']?>" class="form-control" name="title" required/> </div>
                                            </div>
                                        </div>
                                        
                                        <div class="wizard-pane" role="tabpanel">
                                            <div class="form-group">
                                                <label class="col-xs-3 control-label">Nội dung hồ sơ</label>
                                                <div class="col-xs-5">
                                                    <textarea id="myTextarea" class="form-control" name="content" required ><?php echo $post['content']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            const textarea = document.getElementById('myTextarea');

                                            textarea.addEventListener('input', function () {
                                                this.style.height = 'auto';
                                                this.style.height = this.scrollHeight + 'px';
                                            });

                                            // Optional: Auto-resize the textarea when the page loads (if it has content)
                                            window.addEventListener('load', function () {
                                                textarea.style.height = 'auto';
                                                textarea.style.height = textarea.scrollHeight + 'px';
                                            });
                                        </script>
                                    </div>
                                    <input type="hidden" name="owner" value="<?php echo $email?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul>
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-info">
                                        <input id="checkbox1" type="checkbox" class="fxhdr">
                                        <label for="checkbox1"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
                                        <label for="checkbox2"> Fix Sidebar </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox4" type="checkbox" class="open-close">
                                        <label for="checkbox4"> Toggle Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                           
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2024 &copy; Cục Hải Quan Đà Nẵng </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Form Wizard JavaScript -->
    <script src="../plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" href="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
    <script src="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script type="text/javascript">
    (function() {
        // $('#exampleBasic').wizard({
        //     onFinish: function() {
        //         alert('finish');
        //     }
        // });
        // $('#exampleBasic2').wizard({
        //     onFinish: function() {
        //         alert('finish');
        //     }
        // });
        $('#exampleValidator').wizard({
            onInit: function() {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        author: {
                            validators: {
                                notEmpty: {
                                    message: 'Tên cán bộ là bắt buộc.'
                                },
                                stringLength: {
                                    min: 4,
                                    max: 100,
                                    message: 'Tên cán bộ phải có độ dài hơn 4 ký tự và ít hơn 100 ký tự.'
                                },
                                regexp: {
                                    regexp: /^[a-zA-ZÀ-ỹ\s]+$/,
                                    message: 'Tên cán bộ chỉ có thể bao gồm chữ cái'
                                }
                            }
                        },
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'Mã hồ sơ là bắt buộc.'
                                }
                            }
                        },
                        content: {
                            validators: {
                                notEmpty: {
                                    message: 'Nội dung là bắt buộc.'
                                }
                            }
                        }
                    }
                });
            },
            validator: function() {
                var fv = $('#validation').data('formValidation');
                var $this = $(this);
                // Validate the container
                fv.validateContainer($this);
                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }
                return true;
            },
        
            templates: {
                buttons: function() {
                    var options = this.options;
                    // Thay đổi các nhãn nút tại đây
                    options.buttonLabels.back = 'Quay lại';
                    options.buttonLabels.next = 'Tiếp theo';
                    options.buttonLabels.finish = 'Hoàn thành';
                    return '<div class="panel-footer"><ul class="pager">' + '<li class="previous">' + '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' + '</li>' + '<li class="next">' + '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' + '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' + '</li>' + '</ul></div>';
                }
            },
            onBeforeShow: function(step) {
                step.$pane.collapse('show');
            },
            onBeforeHide: function(step) {
                step.$pane.collapse('hide');
            },
            onFinish: function() {
                $.post("/admin/functions/new_post.php", $("#validation").serialize()).done(function() {
                    alert("Đã tạo thành công hồ sơ.");
                });
            }
        });
        // $('#accordion').wizard({
        //     step: '[data-toggle="collapse"]',
        //     buttonsAppendTo: '.panel-collapse',
        //     templates: {
        //         buttons: function() {
        //             var options = this.options;
        //             // Thay đổi các nhãn nút tại đây
        //             options.buttonLabels.back = 'Quay lại';
        //             options.buttonLabels.next = 'Tiếp theo';
        //             options.buttonLabels.finish = 'Hoàn thành';
        //             console.log('options',options)
        //             return '<div class="panel-footer"><ul class="pager">' + '<li class="previous">' + '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' + '</li>' + '<li class="next">' + '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' + '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' + '</li>' + '</ul></div>';
        //         }
        //     },
        //     onBeforeShow: function(step) {
        //         step.$pane.collapse('show');
        //     },
        //     onBeforeHide: function(step) {
        //         step.$pane.collapse('hide');
        //     },
        //     onFinish: function() {
        //         alert('Hoàn thành');
        //     }
        // });
    })();
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
