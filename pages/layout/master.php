<?php
session_start();
if (!isset($_SESSION["user_id"]) && ($_SESSION["role"] != 'doctor' && $_SESSION["role"] != 'employee')) {
    header("Location:index.php");
}
?><!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Tracker</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="../assets/css/demo.css" rel="stylesheet"/>
    <link href="../assets/css/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>
    <link href="../assets/js/datetimepicker/datetimepicker.css" rel="stylesheet"/>
    <script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/datetimepicker/jquery.datetimepicker.full.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="./../assets/img/stethoscope.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Tracker DO IT
                </a>
            </div>
            <ul class="nav">
                <li class="<?php echo($nav == 'appointment' ? 'active' : ''); ?>">
                    <a href="../pages/appointment.php">
                        <i class="fa fa-calendar"></i>
                        <p>Termin</p>
                    </a>
                </li>
                <li class="<?php echo($nav == 'employee' ? 'active' : ''); ?>">
                    <a href="../pages/employee.php">
                        <i class="fa fa-user"></i>
                        <p>Angestellter</p>
                    </a>
                </li>
                <li class="<?php echo($nav == 'doctor' ? 'active' : ''); ?>">
                    <a href="../pages/doctor.php">
                        <i class="fa fa-user-md"></i>
                        <p>Arzt</p>
                    </a>
                </li>
                <li class="<?php echo($nav == 'patient' ? 'active' : ''); ?>">
                    <a href="../pages/patient.php">
                        <i class="fa fa-bed"></i>
                        <p>Patient</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $title ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div style="padding-top: 1.5rem;">
                                <img style="height: 30px; margin-right: 0.3rem;border: 1px solid #000;border-radius: 50%;"
                                     src="../assets/img/default-avatar.png"/>
                                <span><?php echo $_SESSION["name"] ?></span>
                            </div>
                        </li>
                        <li>
                            <a href="index.php">
                                <p>Abmelden</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <?php echo $content; ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </footer>
    </div>
</div>
<?php echo $modals; ?>

</body>

<!--   Core JS Files   -->
<script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>


</html>