<!-- Search results fetching starts here  -->
<div class="container my-3" style="min-height: 78vh;margin-top: 12vh !important;">
    <h1>Search Results For <em>"<?php echo $_GET['search']?>"</em></h1>
    <div class="results my-2">
        <?php
            $query = $_GET['search'];
            $sql = "SELECT * FROM threads WHERE MATCH (`thread_title`,`thread_desc`) against ('$query')";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $thread_id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $url = "thread.php?threadid=".$thread_id;
                echo    '<h4 class="my-2">
                            <a href="'.$url.'" class="text-dark">'.$title.'</a>
                        </h4>
                        <p>'.$desc.'</p>';
            }  
    
            if($noResult){
                echo    '<div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <p class="display-4">No Results Found</p>
                            <p class="lead">
                                <ul>
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords.</li>
                                    <li>Try fewer keywords.</li>
                                </ul>
                            </p>
                        </div>
                </div>';
            }      
        ?>
    </div>
</div>