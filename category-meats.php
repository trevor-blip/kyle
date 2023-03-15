<?php include('partials-front/menu.php');?>
<?php 
    if(isset($_GET['category_id']))
    {
        //Category is set
        $category_id=$_GET['category_id'];
        //Get the category Title based on id
        $sql="SELECT title FROM tbl_category WHERE id=$category_id";
        //Execute the query
        $res=mysqli_query($conn,$sql);
        //Get value from database.
        $row=mysqli_fetch_assoc($res);
        //Get the title
        $category_title=$row['title'];
    }else
    {
        //Category not passed
        //Redirect to homepage
        header('location:'.SITEURL);
    }

    ?>
<style type="text/css">
        .text-white{
            text-align: center;
            color: rgb(45, 45, 73);
        }
        .head{
            color: rgb(45, 45, 73);
            text-align: center;
        }
        .button{
            color: white;
            background-color: rgb(45, 45, 73);
            padding: 4px;
            border: 1px solid white;
            border-radius: 2px;
            text-decoration: none;

        }
         .button:hover{
            background-color: rgb(58, 58, 84);
        }
        .float-text{
            background-color: black;
            padding-right: 10px;
            padding-left: 10px;
            padding-bottom: 5px;
            padding-top: 5px;
            opacity: 50%;
            border-radius: 4px;
        }
        .box-3{
            width: 21%;

        }

    </style>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <br>
            <h3>Meats on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h3>
            <br>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-white">Available Meats</h2>

             <?php
             //Getting items that are featured and active
            $sql2="SELECT * FROM tbl_meat WHERE category_id=$category_id";
            //Execute the query
            $res2=mysqli_query($conn,$sql2);
            //Count rows
            $count2=mysqli_num_rows($res2);
            //Check whether meat is available or not
            if($count2>0)
            {
                //meat is available
                while($rows=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $price=$rows['price'];
                    $description=$rows['description'];
                    $image_name=$rows['image_name'];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php if($image_name=="")
                                {
                                    //Display Message
                                    echo "<div class='error'>Image Not Available.</div>";
                                }else
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/meat/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                <?php
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?> /kg.</p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?item_id=<?php echo $id;?>" class="btn-secondary-a">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            }else
            {
                //meat is not available
                echo "<div class='error'>Meat Not Available</div>";
            }

            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>