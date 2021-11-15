<?php include 'utils/__topAddons.php' ?>
    
<!-- fetching Records from threads table  -->
<?php        
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        $sql2="SELECT * FROM `users` WHERE user_serial_number='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by_fname = $row2['user_first_name'];
        $posted_by_lname = $row2['user_last_name'];
    }  
?>

<!-- Inserting comments into comments table  -->
<?php
        // echo $_SERVER['REQUEST_METHOD'];
    if($_SERVER['REQUEST_METHOD']=='POST'){            
        $content = $_POST['comment'];
        $id = $_GET['threadid'];
        $sno = $_SESSION['sno'];

        $content = str_replace("'","\'",$content);
        $content = str_replace(">","&gt;'",$content);
        $content = str_replace("<","&lt;'",$content);

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$content', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
    }
?>

<!-- Categories container starts here  -->
<div class="container my-3">
    <div class="jumbotron">
        <h1 class="display-4"><?php echo $title; ?></h1>
        <p class="lead"><?php echo $desc;?></p>
        <hr class="my-4">
        <p>1. No Spam / Advertising / Self-promote in the forums</p>
        <p>2. Do not post copyright-infringing material</p>
        <p>3. Do not post “offensive” posts, links or images</p>
        <p>4. Do not PM users asking for help</p>
        <p>5. Remain respectful of other members at all times</p>
        <p><b>Posted by : <?php echo $posted_by_fname." ".$posted_by_lname;?></b></p>
        <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>

<!-- To insert comments from threads page in Forum website -->
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <h2>Post a Comment</h2>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"> </label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"
                        placeholder="Type your comment"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
            <h1>Discussion</h1>
        </div>';
    }
    else{
        echo '<div class="container my-2 alert alert-warning" role="alert">
                <p class="lead">You are not signed in. Please sign in to be able to post your comments.</p>
            </div>';
    }    
?>

<!-- Fetching Comments from comments table  -->
<div class="container my-4">
<?php    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $comment_by = $row['comment_by'];

        $sql2="SELECT * FROM `users` WHERE user_serial_number='$comment_by'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user_fname = $row2['user_first_name'];
        $user_lname = $row2['user_last_name'];

        echo '<div class="media my-3">
            <img src="img/default_user.png" width="60px" class="mr-3" alt="...">
            <div class="media-body">
            '.$content.'
            <p class="font-weight-bold my-0">Commented by: '.$user_fname.' '.$user_lname.' at '.$comment_time.'</p>    
            </div>
        </div>';
    }  
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <p class="display-4">No Discussion Found</p>
            <p class="lead">Be the first person to comment on this query.</p>
        </div>
        </div>';
    }      
?>

<?php include 'utils/__bottomAddons.php' ?>