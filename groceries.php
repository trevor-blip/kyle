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

    </style>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>grocery-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for grocery.." required>
                <input type="submit" name="submit" value="Search" class="button">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-white">Grocery</h2>

             <?php
            //Display meats that are active
            $sql="SELECT * FROM tbl_grocery WHERE active='Yes'";
            //Execute query
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count>0)
            {
                //Meats available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }else
                                    {
                                        //Image Available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/items/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?> /kg</p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order-grocery.php?item_id=<?php echo $id;?>" class="btn-secondary-a">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            }else
            {
                echo "<div class='error'>Meat Not Found.</div>";
            }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>