
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
        .float-text{
            padding-right: 10px;
            padding-left: 10px;
            padding-bottom: 5px;
            padding-top: 5px;
            border-radius: 4px;
        }
        .box-3{
            width: 21%;

        }
        @media only screen and (max-width:768px){
    .box-3{
        width: 100%;
        margin: 4% auto;
    }
}

    </style>
    <!-- CAtegories Section Starts Here -->
    <section class="categories food-menu">
        <div class="container">
            <h2 class="text-white">Meats and Groceries </h2>

            <?php
                //Display all the categories that are active
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                //Execute the query
                $res=mysqli_query($conn,$sql);
                //Count Rows
                $count=mysqli_num_rows($res);
                //Check whether category is available or not
                if($count>0)
                {
                    //Category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                       //Get the values
                       $id=$row['id'];
                       $title=$row['title'];
                       $image_name=$row['image_name']; 
                       if($title=="Grocery")
                       {
                            ?>
                       <a href="<?php echo SITEURL;?>category-grocery.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">

                            <h3 class="float-text text-center"><?php echo $title;?></h3><br>
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
                       }else
                       {
                            ?>
                       <a href="<?php echo SITEURL;?>category-meats.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">

                            <h3 class="float-text text-center"><?php echo $title;?></h3><br>
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
                       
                    }
                }else
                {
                    //Category not available
                    echo "<div class='error'>Category Not Found.</div>";
                }

            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-front/footer.php');?>