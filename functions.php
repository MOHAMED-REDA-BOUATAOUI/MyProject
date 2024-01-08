<?php

function check_login($con){

    if(isset($_SESSION['client_permis']))
    {

        $permis =  $_SESSION['client_permis'];
        $query = "select * from clients where permis = $Permis limit 1 " ;

        $result = mysqli_query($con , $query);

        if($result && mysqli_num_rows($result) > 0 ){

                $clients_data = mysqli_fetch_assoc($result);

                return $clients_data;
        }
    }
}

header("location : index.php");
die;