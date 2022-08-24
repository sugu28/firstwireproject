
 <?php
    include "database.php";
    
    session_start(); 
    $message = "";
    if (isset($_POST['submit'])) {
        if (isset($_POST['userid']) && isset($_POST['password'])) {

            function validate($data)
            {

                $data = trim($data);

                $data = stripslashes($data);

                $data = htmlspecialchars($data);

                return $data;
            }

            $uname = validate($_POST['userid']);

            $pass = validate($_POST['password']);

            $sql = " SELECT * FROM logindetails WHERE userid ='$uname' and password='$pass '";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                  

                    if ($row['userid'] === $uname && $row['password'] === $pass) {

                        $role=$row["role"];
                        

                        switch ($role) {

                            case "Admin":
                                $_SESSION['login'] = $uname;
                                $_SESSION['uid']=$role;
                                echo "<script> location.href='admin/admin_dashboard.php'; </script>";
                                exit();
                                break;

                            case "Distributor":
                                $_SESSION['login'] = $uname;
                                $_SESSION['uid']=$role;
                                echo "<script> location.href='distributor/dist_dashboard.php'; </script>";
                                exit();
                                break;

                            case "Retailer":
                                $_SESSION['login'] = $uname;
                                $_SESSION['uid']=$role;
                                echo "<script> location.href='retailer/ret_dashboard.php'; </script>";
                                exit();
                                break;
                                
                            default:
                                $errormsg[] = "Wrong Userid or Password";
                        }

                    } 
                    
                    else {
                        $message = "UserID or Password is not correct";
                    }
                }
            } 
        } 
    }

    ?>