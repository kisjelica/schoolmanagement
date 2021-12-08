<?php
session_start();

if (!(isset($_SESSION['login']))) {
    header('location:../index.php');
}
if (isset($_POST['submit'])) {
    include('../config/DbFunction.php');
    $obj = new DbFunction();
    $obj->create_course($_POST['course-short'], $_POST['course-full'], $_POST['cdate']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>School management</title>

    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">


    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <form method="post">
        <div id="wrapper">
            <?php include('leftbar.php') ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Add Course</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">

                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Course Short Name<span id="" style="font-size:11px;color:red">*</span> </label>
                                        </div>
                                        <div class="col-lg-6">

                                            <input class="form-control" name="course-short" id="cshort" required="required" onblur="courseAvailability()">
                                            <span id="course-availability-status" style="font-size:12px;"></span>
                                        </div>

                                    </div>

                                    <br><br>

                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Course Full Name<span id="" style="font-size:11px;color:red">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="course-full" id="cfull" required="required" onblur="coursefullAvail()">
                                            <span id="course-status" style="font-size:12px;"></span>
                                        </div>
                                    </div>

                                    <br><br>

                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Creation Date</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" name="cdate">

                                        </div>
                                    </div>
                                </div>

                                <br><br>

                                <div class="form-group">
                                    <div class="col-lg-4">

                                    </div>
                                    <div class="col-lg-6"><br><br>
                                        <input type="submit" class="btn btn-primary" name="submit" value="Create Course"></button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </form>
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>


    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>

    <script>
        function courseAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "course_availability.php",
                data: 'cshort=' + $("#cshort").val(),
                type: "POST",
                success: function(data) {
                    $("#course-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }

        function coursefullAvail() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "course_availability.php",
                data: 'cfull=' + $("#cfull").val(),
                type: "POST",
                success: function(data) {
                    $("#course-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</body>

</html>