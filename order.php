<?php include('partials-front/menu.php');?>
<?php
//Check whether food id is set or not
if(isset($_GET['item_id']))
{
    //Get the details of the selected meat
    $item_id=$_GET['item_id'];
    //Get details of the selected food
    $sql="SELECT * FROM tbl_meat WHERE id=$item_id";
    //Execute the query
    $res=mysqli_query($conn,$sql);
    //Count the number of rows
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //We have data
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];

    }else
    {
        //We don't have data
        //Redirect to homepage
        header('location:'.SITEURL);
    }


}else
{
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
        .don{
            padding: 3%;
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
        .slide{
            color: white;
        }

    </style>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            
            <h2 class="text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Meat</legend>

                    <div class="food-menu-img">
                        <?php
                        //Check whether the image is available or not.
                        if($image_name=="")
                        {
                            //Image not available
                            echo "<div class='error'>Image Not Available.</div>";
                        }else
                        {
                            //Image available
                            ?>
                                <img src="<?php echo SITEURL;?>images/meat/<?php echo $image_name;?>" alt="<?php echo $title?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="item" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo "$".$price." /kg";?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qnty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter you fullname...." class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter your phone number...." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter your email address...." class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter your physical address...." class="input-responsive" required></textarea>

                    <input type="submit" name="send" value="Confirm Order" class="button">
                </fieldset>

            </form>
            <?php
            //Check whether submit buttom is clicked or not.
            if(isset($_POST['send']))
            {
               //Get all the details from the form
               $item=$_POST['item'];
               $price=$_POST['price']; 
               $qnty=$_POST['qnty'];
               //The total price is price times quantity
               $total=$price*$qnty;
               $order_date= date("Y-m-d h:i:sa"); //Order date.
               $status="Odered";// Ordered, on delivery, delivered, cancelled.
               $customer_name=$_POST['full-name'];
               $customer_contact=$_POST['contact'];
               $customer_email=$_POST['email'];
               $customer_address=$_POST['address'];
               //Save the order in database

               $sql2="INSERT INTO tbl_order SET 
               meat='$item',
               price=$price,
               qty=$qnty,
               total=$total,
               order_date='$order_date',
               status='$status',
               customer_name='$customer_name',
               customer_contact='$customer_contact',
               customer_email='$customer_email',
               customer_address='$customer_address'
               ";
               //Execute the query
               $res2=mysqli_query($conn,$sql2);
               //Check whether query executed successfully or not
               if($res2==TRUE)
               {
                //Query executed and order saved
                $_SESSION['order']="<div class='success'>Order has been placed.</div>";
                header('location:'.SITEURL);
               }else
               {
                //Query not executed
                $_SESSION['order']="<div class='error'>Failed to place order.</div>";
                header('location:'.SITEURL);
               }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   <?php include('partials-front/footer.php');?>