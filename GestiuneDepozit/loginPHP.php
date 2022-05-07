<?php 
require_once('connection.php');
require 'alert.php';
$msg = "";
$page = "";
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['uname']) || empty($_POST['pass']))
       {
            $msg = "Completati toate campurile";
            $page = "login.php?Invalid= Campuri necompletate";
            phpAlert($msg, $page);
       }
       else
       {
            
            $query="select * from login where name='".$_POST['uname']."' and pass='".$_POST['pass']."'";
            
            $result=mysqli_query($con,$query);

            if($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['user']=$_POST['uname'];
                
                $_SESSION['tip'] = $row['tip'];
                
            
            //header('location:'.$_SESSION['tip']);
            header("location:acasa.php");
            }
            else
            {
                $msg = "Date incorecte";
                $page = "login.php?Invalid= Date de autentificare gresite";
                phpAlert($msg, $page);
            }
       }
    }
    else
    {
        
        $msg = "Eroare";
        $page = "login.php?Invalid= Eroare";
        phpAlert($msg, $page);
    }

?>