<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delicious-layout.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Home Delicious</title>
</head>
<?php
    require_once('./logic/functions.php');
?>
<body>
    <!-- The header section  -->
    <header class="heading">
        <div id="logo-nav-head">
            <h1 class="logo" id="logo">Delicious</h1>
            <nav id="main-nav">
               <a href="index.php">Home</a>
               <a href="#">Menu</a>
               <?php 
               if(isset($_SESSION['user_id'])){
                 echo "<a href='customer/viewCart.php'>Cart ("; echo count($_SESSION['cart']).")</a>";
               }
               ?>
              <button onclick="location.href='<?php echo (isset($_SESSION['user_id']))?'Logic/logout.php/p=index':'login.php';?>'"><?php echo (isset($_SESSION['user_id']))?"Logout":"Login"; ?></button>
              <button onclick="location.href='<?php echo (isset($_SESSION['user_id']))?'myaccount.php':'registration.php';?>'"><?php echo (isset($_SESSION['user_id']))?$_SESSION['firstname']:"Register"; ?></button>
              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
                echo "<button onclick=\"location.href='orders.php'\">Dashboard</button>";
              }
              ?>
             
            </nav>
        </div>
        
        <!-- headline -->
     <h1>Our Dishes are the epitome Taste</h1>
     <!-- subheadline -->
     <h2>We provide you healthy and delicious meals</h2>
     <div class="search-grouping" id="header-search-group">
        <input type="search" name="meal-search" id="meal-search-field" placeholder="Search for your favorite meal"/><button type="button" id="search-btn">Search</button>
     </div>
     
    </header>

    <section id="benefits-list">
     <div class="benefits">
         <h2>Healthy and Nutritious meal</h2>
     </div>
     <div class="benefits">
         <h2>Enjoy our Just In Time Delivery</h2>
     </div>
     <div class="benefits">
         <h2>Enjoy our do it yourself package</h2>
     </div>
     <div class="benefits">
         <h2>National Food Commission Approved dishes</h2>
     </div>
    </section>
    <!-- The body section  -->
    <main>
        <section class="display-section">
            <div class="header-div">
                <h3 id="section-header">These are delicious meals. </h3>
            </div>
            
            <div class="dish-display">
            <?php
                $conn = connect();
                //geting the food from the database
                $sql = "SELECT dish_id, dish_name, price from dish where `status` = 'publish' limit 0, 20";
                $res = $conn->query($sql);

                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        $id = $row['dish_id'];
                        $name = $row['dish_name'];
                        $price = $row['price'];
                        $imageSrc = returnImageSrc($id);
                        
                        echo "<div class='dish' id='$id'>
                        <img id='dish-image' src='$imageSrc'>
                        <p id='dish-name'>$name</p> 
                        <button type='button' id='$id' onclick='order(this)'>Order Now <span id='price'>$price ksh</span></button>
                    </div>"; 
                    }
                }
                
            ?>
            
            </div>
        </section>
    </main>
    <!-- The footer section  -->
    <section class="footer-section">
    <div class="why-us">
        <h1>Why Us</h1>
        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pharetra purus sed hendrerit interdum. Aenean condimentum, lectus sit amet luctus pulvinar, nisl enim pharetra enim, eu iaculis nulla tortor vitae augue. Aliquam erat tellus, pulvinar non justo nec, dictum condimentum purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec nec felis et massa vulputate ornare. Cras sed dolor quis ipsum accumsan eleifend. Integer vestibulum, nisi in accumsan placerat, odio justo euismod mauris, nec interdum nulla ipsum congue nulla. Aliquam consequat lectus ut quam pellentesque dictum. Mauris commodo at sem nec suscipit. Praesent quis tincidunt nisl.</p>
    </div>
        <div class="categories">
            <h1>Our Categories Of Food</h1>
            <ul>
                <?php
                $sql = "SELECT * from category where `status` ='dish'";
                $res  = $conn->query($sql);
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        $id = $row['category_id'];
                        $cat_name = $row['category_name'];
                        echo " <li><a href='#$id'>$cat_name</a></li>";
                    }
                }
                $conn->close();
                ?>
            </ul>
        </div>
        <!--This is the list of users currently on the system-->
        
        <div class="trust-contents">
            <div class="partners">

            </div>
        </div>
    </section>
    <footer class="footer">
        <script src="js/index.js"></script>
        <h2>&copy; Delicious 2020</h2>
    </footer>
</body>
</html>