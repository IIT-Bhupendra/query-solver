<?php include 'utils/__topAddons.php' ?>

<!-- Fetching Records From categories Table  -->
<?php
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    
?>

<!-- Categories container starts here  -->
<div class="container mb-3 JumBo">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
        <p class="lead"><?php echo $catdesc;?></p>
        <hr class="my-4">
        <p>1. No Spam / Advertising / Self-promote in the forums</p>
        <p>2. Do not post copyright-infringing material</p>
        <p>3. Do not post “offensive” posts, links or images</p>
        <p>4. Do not PM users asking for help</p>
        <p>5. Remain respectful of other members at all times</p>
        <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>

<!-- Inserting thread into thread table  -->
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){            
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_SESSION['sno'];

        $th_title = str_replace(">","&gt;",$th_title);
        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace("'","\'",$th_title);
        
        $th_desc = str_replace(">","&gt;",$th_desc);
        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace("'","\'",$th_desc);

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added successfully, Please wait till community responds.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
    }        
?>

<!-- Inserting threads manually from threads page on our website -->
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                    <h2>Start a Discussion</h2>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" maxlength="255" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your problem title as short and crisp as
                            possible.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Elaborate Your Concern </label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
    }
    else{
        echo '<div class="container my-2 alert alert-warning" role="alert">
        <p class="lead">You are not signed in. Please sign in to be able to add a discussion.</p>
        </div>';
    }    
?>

<!-- Fetching threads from threads table in order to show over the thread page  -->
<div class="container my-4">
    <h1>Browse Questions</h1>
    <?php
    
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $thread_user_id = $row['thread_user_id'];
            $desc = $row['thread_desc'];
            $time = $row['timestamp'];
            
            
            $sql2="SELECT * FROM `users` WHERE user_serial_number='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user_fname = $row2['user_first_name'];
            $user_lname = $row2['user_last_name'];

            echo '<div class="media my-3">
                <img src="img/default_user.png" width="80px" class="mr-3" alt="...">
                <div class="media-body">                    
                    <h5 class="mt-0"> <a href="thread.php?threadid='.$id.'" class="text-dark">'.$title.'</a></h5>
                    '.$desc.'
                    <p>Asked by: <b>'.$user_fname.' '.$user_lname.'</b> at '.$time.'</p>
                </div>
            </div>';
        }  
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">No Threads Found</p>
                <p class="lead">Be the first person to ask something in this category.</p>
            </div>
            </div>';
        }      
    ?>
</div>

<?php include 'utils/__bottomAddons.php' ?>