<!-- Categories container starts here  -->
<div class="container my-3">
        <h1 class="text-center my-3">qSolver - Browse Categories </h1>

        <!-- Fetch all categories here  -->
        <div class="row">
            <!-- Use a for loop to iterate through categories -->
            <?php

              $sql = "SELECT * FROM `categories`";
              $result = mysqli_query($conn, $sql);
              
              while($row = mysqli_fetch_assoc($result)){
                // echo $row['category_id'];
                // echo $row['category_name'];
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                echo '<div class="col-md-4 my-2">
                <div class="card shadow mt-2" style="width: 20rem;">
                    <img src="https://source.unsplash.com/500x400/?'.$cat.',coding" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <a href="threadlist.php?catid='.$id.'" > '.$cat.'</a></h5>
                        <p class="card-text">'.substr($desc,0,80).'...</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">Threads</a>
                    </div>
                </div>
            </div>';
              }
        
        ?>
        </div>
    </div>