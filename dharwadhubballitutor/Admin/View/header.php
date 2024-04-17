 <?php
require_once "../DB Operations/notificationOps.php";

?>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>content Management System </title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel=stylesheet href=https://use.fontawesome.com/releases/v5.0.7/css/all.css />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel=stylesheet href="../../Admin/css/dharwadhubballitutoradmin.css" />
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css" />

    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-select/bootstrap-select.min.css" />
    <!-- Main Quill library -->
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <style>
        #editor-container {
            height: 375px;
        }
        
        div.auto{
            width : 310px;
            height : 310px;
            overflow : auto;
        }
        
    </style>
</head>

<?php
$notification = DBnotification::getAllnotifications();
$notification = DBnotification::getnotifications();
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                    <br/>
                    
                    <h3 class="brandName text-center">DharwadHubballi Tutor</h3> <br>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item" <?php if($_SESSION['Role_Id']==2){echo "style='display:none'";} ?>>
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="enquiries.php">
                    <i class="fas fa-search-plus"></i>
                    <span>Enquiries</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admissions.php">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <span>Admissions </span>
                </a>
            </li>
            
             <li class="nav-item">
                <a class="nav-link" href="company.php">
                <i class="fas fa-building"></i>
                    <span>Company </span>
                </a>
            </li>
            
              <li class="nav-item">
                <a class="nav-link" href="Expense.php">
                <i class="fas fa-money-bill-alt"></i>
                    <span>Expense </span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="trainers.php">
                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                    <span> Trainers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="courses.php">
                    <i class="fa fa-book"></i>
                    <span> Courses</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="fees.php">
                    <i class="fas fa-rupee-sign"></i>
                    <span> Fees</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="services.php">
                    <i class="fas fa-briefcase"></i>
                    <span> Services</span>
                </a>
            </li>
                        
            <li class="nav-item">
                <a class="nav-link" href="../../blogadmin/views/dashboard.php">
                    <i class="fas fa-rss"></i>
                    <span>Blog</span>
                </a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="sidebar-brand-text mx-3"><i class="fas fa-user"></i>
                        <?php echo $_SESSION['login_user']; ?>
                    </div>


                    <!-- Topbar Navbar -->

                    <ul class="navbar-nav ml-auto my-sm-0">

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Notification -->

                        <button class="navbar-toggler" id="notification" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-5" aria-controls="navbarSupportedContent-5" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent-5">
                            <ul class="navbar-nav ml-auto nav-flex-icons">
                                <li class="nav-item avatar dropdown">
                                    <a onclick="removeNumber()" class="nav-link dropdown-toggle  waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="badge badge-danger ml-2"><?php echo $notification->getId() ?>
                                        </span>
                                        <i class=" fas fa-bell"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
                                       
                                        <span class="">
                                             <div class="auto">
                                            <?php
                                            $result = "";
                                            $notificationlist = DBnotification::getAllnotifications();
                                            foreach ($notificationlist as $notification) {
                                                $result .= '<a class="dropdown-item my-2"  href="enquiries.php?id=' . $notification->getCategory() . '">
                                                   ' . $notification->getMessage() .  '</a>';
                                            }
                                            echo $result;
                                            ?>
                                                                                    </div>
                                        </span>

                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Nav Item - User Information -->

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="user_profile_name"></span>
                                <i class="fas fa-chevron-circle-down 7x"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="setting.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <script>
                        function removeNumber() {
                            document.getElementsByClassName('badge')[0].innerHTML = '';
                        }

                    </script>