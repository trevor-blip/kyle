    <?php include('partials-front/menu.php');?>

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
        .don{
            padding: 3%;
        }
        .float-text{
            /*background-color: black;*/
            padding-right: 10px;
            padding-left: 10px;
            padding-bottom: 5px;
            padding-top: 5px;
            /*opacity: 50%;*/
            border-radius: 4px;
        }
        .slide{
            color: white;
        }

    </style>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container don">
            <marquee behavior="scroll" direction="left" class="slide" loop="infinite" scrolldelay="100">We are running a promotion, buy more than 5ks meat and get 2kgs of sugar. Hurry now before the promo is over!!!.</marquee><br><br>
            <form action="<?php echo SITEURL;?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Meat...." required>
                <input type="submit" name="submit" value="Search" class="button">
            </form>
            <br><br>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
                <h4 class="head"><?php
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
                ?></h4>
            <br>
            <h2 class="head">Explore Meats</h2>

            <?php
            //Create sql query to display data from database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='YES' LIMIT 3";
            //Execute the querry
            $res=mysqli_query($conn,$sql);
            //Count rows to check if category is available
            $count=mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL;?>category-meats.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <h3 class="float-text text-center"><span><?php echo $title; ?></span></h3><br>
                        <?php if($image_name=="")
                        {
                            //Display Message
                            echo "<div class='error'>Image Not Available.</div>";
                        }else
                        //Image available
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                        <?php
                        ?>
                    </div>
                    </a>
                    <?php
                }
            }else
            {
                //category not available
                echo "<div class='error'>Category Not Added.</div>";
            }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="head">Our Best Meats</h2>

            <?php
             //Getting items that are featured and active
            $sql2="SELECT * FROM tbl_meat WHERE active='Yes' AND featured='Yes' LIMIT 6";
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

        <p class="text-center">
            <a href="#">See All Items</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>