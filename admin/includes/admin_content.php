<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

<?php
// equivalent to mysqli_query("SELECT * FROM users")
// $users = User :: find_all_users();

// $users -> username = "tferris88";
// $users -> password = "something_ok";
// $users -> first_name = "Tim";
// $users -> last_name = "Ferris";
// $users -> create();

// forEach($users as $user) {
//     echo $user -> username . "<br/>";
// }

$user = User :: find_user(3);
$user ->delete();

?>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->