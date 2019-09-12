<?php
  session_start();
  if (!isset($_SESSION['username'])){
    header("location:\DK\login.php");
  }
  if ($_SESSION['role'] != "Staff"){
    header("location:\DK\\".$_SESSION['role']."\Records.php");
  }
  if ($_SESSION['role'] == ""){
    header("location:\DK\login.php");
  }
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $user=$_SESSION['username'];
  $sql="SELECT * FROM users WHERE username='$user' AND roles='Staff'";
  $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $myrow= mysqli_fetch_row ($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="author" content="Abdul_Azeez">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="icon" href="\DK\images\DKicon.png">
  <link rel="stylesheet" href="\DK\css\Records.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Vollkorn|Russo+One|Acme|Josefin+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
  <style media="screen">
  body{
    margin: 0;
    padding: 0;
    background: #0b769a8f;
  }

   a:hover{
    text-decoration: none;
  }
  input:invalid , input:focus:required:invalid{
    border-bottom-color: red;
  }
  .table-responsive{
    display: block;
    width: auto;
  }
  #load{
    width:100%;
    height:100%;
    position:fixed;
    top:0px;
    left:0px;
    z-index:9999;
    background:url("/DK/loader1.gif") no-repeat 50% 50% #90bac6a8;
  }
  #wait{
    width:100%;
    height:100%;
    position:fixed;
    top:0px;
    left:0px;
    z-index:9999;
    background:url("/DK/wait.gif") no-repeat 50% 50% #90bac6a8;
  }
  @media screen and (max-width: 1060px) {
    .table-responsive {
      width: 90%;
      margin: 20px 6px 0px 0px;
    }
    .modal {
        margin-left: 27% !important;
    }
  }
  @media screen and (max-width: 992px) {
    .modal {
        margin-left: 22% !important;
        margin-right: 22% !important;
      }
  }
  </style>