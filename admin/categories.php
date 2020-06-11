<?php include "includes/header.php";
include "../includes/db.php";
ob_start();
?>

    <div id="wrapper">

        <!-- Navigation : SideBar and TopBar-->
        <?php include "includes/navigation.php";?>


        <!-- Main Page Data -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                    </div>


                    <div class="col-xs-6">

                        <h3 class="media-heading">
                            Categories
                        </h3>

                        <form action="" method="post">
                            <div class="form-group">
                                <label>Add Category: </label>
                                <input name="add_cat" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button name="add_cat_button" type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>

                        <?php
                        //adding more categories
                        if(isset($_POST['add_cat_button'])){
                            $cat_title = $_POST['add_cat'];
                            if($cat_title == "" || empty($cat_title) || trim($cat_title) == ''){
                                echo "Please Enter Category Name";//not shown because of header below
                            }
                            else{
                                $query = "INSERT INTO categories (cat_title) VALUE ('{$cat_title}')";
                                $result = mysqli_query($connection,$query);
                                if(!$result)
                                    die("Connection Error ".mysqli_error());
                            }

                            header('Location: categories.php');
                            exit;
                        }

                        ?>

                        <?php
                        //Edit category
                        if(isset($_GET['edit']) && !isset($_POST['edit_cat_button'])){
                            $cat_id = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                            $result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $cat_title = $row['cat_title'];

                                ?>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Update Category: </label>
                                            <input value="<?php if(isset($cat_title)) echo $cat_title; ?>" name="edit_cat" type="text" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button name="edit_cat_button" type="submit" class="btn btn-primary" >Update</button>
                                    </div>
                                </form>

                                <?php

                            }
                        }

                        ?>


                        <?php

                        if(isset($_POST['edit_cat_button'])){
                            $cat_title = $_POST['edit_cat'];
                            $cat_id = $_GET['edit'];
                            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                            $result = mysqli_query($connection,$query);
                            if($result){
                                echo "<div><i>Updated Category to '{$cat_title}'</i></div>";
                            }

                        }

                        ?>

                    </div>

                    <div class="col-xs-6">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th> Category ID </th>
                                    <th> Category Title </th>
                                    <th> Delete </th>
                                    <th> Edit </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //showing categories on right side
                            $query = "SELECT * from categories";
                            $result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($result)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                ?>

                                <tr>
                                    <td> <?php echo $cat_id?> </td>
                                    <td> <?php echo $cat_title?> </td>
                                    <td> <span><a href="categories.php?delete=<?php echo $cat_id?>" class="fa fa-fw fa-trash-o"></a> </span> </td>
                                    <td> <span><a href="categories.php?edit=<?php echo $cat_id?>" class="fa fa-fw fa-pencil"></a> </span> </td>
                                </tr>

                            <?php }


                            if(isset($_GET['delete'])){
                                $cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
                                $result = mysqli_query($connection,$query);
                                header("Location: categories.php");
                            }


                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    </div>

    <!-- Footer -->
<?php include "includes/footer.php";?>