<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kyle meats|Food Order Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
    .food-searchh{
        background-color: #ececec;
    }
    .success{

    color: #4cd137;
    font-weight: bold;
    background: transparent;
    display:inline-block;
    text-align:center;
    padding: 2px;
    }
    .error{
    color: #e74c3c;
    font-weight: bold;
    background: transparent;
    display:inline-block;
    text-align:center;
    padding: 2px;
    width: 100%;
    }

    </style>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL;?>" title="Logo">
                    <img src="images/logo.png" alt="KyleMeats Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>meats.php">Meats</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>groceries.php">Groceries</a>
                    </li>
                    <li>
                        <a href="#">Branches</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->