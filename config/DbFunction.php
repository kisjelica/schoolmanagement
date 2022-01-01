<?php
require('Database.php');
class DbFunction
{
    function login($loginid, $password)
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT loginid, password FROM tbl_login where loginid=? and password=? ";
        $stmt = $mysqli->prepare($query);
        if ($stmt == false) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param('ss', $loginid, $password);
            $stmt->execute();
            $stmt->bind_result($loginid, $password);
            $rs = $stmt->fetch();
            echo "<script>alert('Invalid username or password')</script>";
            if (!$rs) {
                echo "<script>alert('Invalid username or password')</script>";
            } else {
                header('location:add-course.php');
            }
        }
    }
    function create_course($cshort, $cfull, $cdate)
    {
        if ($cshort == "") {
            echo "<script>alert('Course Short Name Needed')</script>";
        } else if ($cfull == "") {
            echo "<script>alert('Course Full Name Needed')</script>";
        } else {
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "insert into tbl_course(cshort,cfull,cdate)values(?,?,?)";
            $stmt = $mysqli->prepare($query);
            if ($stmt == false) {
                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {
                $stmt->bind_param('sss', $cshort, $cfull, $cdate);
                $stmt->execute();
                echo "<script>alert('Course Added Successfully')</script>";
                //header('location:login.php');
            }
        }
    }

    function showCourse()
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM tbl_course ";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    function del_course($id)
    {

        //  echo $id;exit;
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "delete from tbl_course where cid=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        echo "<script>alert('Course has been deleted')</script>";
        echo "<script>window.location.href='view-course.php'</script>";
    }

    function create_subject($cshort, $cfull, $sub1, $sub2, $sub3, $sub4, $sub5)
    {

        if ($cshort == "") {

            echo "<script>alert('Select  Course Short Name')</script>";
        } else if ($cfull == "") {

            echo "<script>alert('Select  Course Full Name')</script>";
        } else {


            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "insert into subject(cshort,cfull,sub1,sub2,sub3,sub4,sub5)values(?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            if (false === $stmt) {

                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {

                $stmt->bind_param('sssssss', $cshort, $cfull, $sub1, $sub2, $sub3, $sub4, $sub5);
                $stmt->execute();
                echo "<script>alert('Course Added Successfully')</script>";
            }
        }
    }

    function showSubject(){
	
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM subject ";
        $stmt= $mysqli->query($query);
        return $stmt;
        
    }
}
