<?php
function addTrainer(){



    if (!session_id()) {
        session_start();
    }
    global $wpdb, $table_prefix;

    require_once('wp-config.php');
    require_once('wp-includes/wp-db.php');




    if(isset($_SESSION['email'])){
    global $wpdb;
    $email=$_SESSION['email'];
    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}users  WHERE `user_email`='$email'", OBJECT );

    foreach ($results as $res) {

        ?>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



        <nav class="navbar navbar-expand navbar-dark bg-primary"> <a href="#menu-toggle" id="menu-toggle" class="navbar-brand">
                <span class="navbar-toggler-icon"></span></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

            <div class="collapse navbar-collapse" id="navbarsExample02">

                <form class="form-inline my-2 my-md-0"> </form>
            </div>
        </nav>
        <div id="wrapper" class="toggled">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
               <?php
               include('admin-menu.php');
               ?>
            </div> <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <?php

                    $urll = site_url();
                    $dirx=$urll.'/wp-content/plugins/Club/includes/help-trainer.php';
                    ?>
                    <form action="<?=$dirx;?>" method="post" class="create_trainer">
                        <h3>Add a person / coach / trainer:

                        </h3>
                        <div class="form-group"><input type="text" name="name_trainer"  placeholder="Name">
                            <select name="type">
                                <option value="trainer">trainer</option>
                                <option value="president">president</option>
                                <option value="marketing">marketing</option>
                            </select>
                            <input type="email" placeholder="Email" name="email"></div>
                        <div class="form-group">
                            <input type="phone" placeholder="Phone" name="phone">
                            <input type="url" placeholder="Homepage" name="hompage">
                            <input type="password" placeholder="Password" name="password">
                            <button name="create_person">Save</button>
                        </div>



                    </form>
                </div>
            </div> <!-- /#page-content-wrapper -->
        </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script> <!-- Menu Toggle Script -->
        <script>
            $(function(){
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });

                $(window).resize(function(e) {
                    if($(window).width()<=768){
                        $("#wrapper").removeClass("toggled");
                    }else{
                        $("#wrapper").addClass("toggled");
                    }
                });
            });

        </script>


        <?php
    }

}
    else{
        $url = site_url();
        $dir=$url.'/login';

        echo "<a href=".$dir.">Go to login</a>";


    }
}

add_shortcode( 'addTrainer','addTrainer');


