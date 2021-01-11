<?php
 session_start();
 require_once("logic/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/delicious-layout.css">
    <link rel="stylesheet" href="css/orders.css">
    <link rel="stylesheet" href="css/orderdetails.css">
    <title>Delicious | Dashboard</title>
</head>
<body>
    <div class="dashboard-head moroon">
        
        <div id="logo-nav-head">
            <h1 class="logo" id="logo">Delicious</h1>
            <nav id="main-nav">
               <a href="index.php">Home</a>
               <a href="#">Menu</a>
               <a href="customer/viewCart.php">Cart <?php echo "(".count($_SESSION['cart']).")";?></a>
              <?php
                if(isset($_SESSION['user_id'])){
                    echo "<button onclick=\"location.href='myaccount.php'\">{$_SESSION['firstname']}</button>";
                }
              ?>
              <button onclick="location.href='<?php echo (isset($_SESSION['user_id']))?'Logic/logout.php/p=index':'login.php';?>'"><?php echo (isset($_SESSION['user_id']))?"Logout":"Login"; ?></button>
            </nav>
        </div>
    </div>
    <div class="sidenav moroon">
            <a href="" class="active">Orders</a>
            <a href="dishes.php">Dishes</a>
            <a href="add-dish.php">Add a dish</a>
            <a href="">Blog</a>
            <a href="">Pages</a>
            <a href="">Reviews</a>
            <a href="users.php">Users</a>
    </div>
    <div class="main" id='main'>
        <!-- the Orders table -->
        <div class="special-content">
            <h1 id="title">Orders</h1>
            <div id="dish-div">
                <label for="dish" id="dish-label">Dish Category:</label>
                <select id="dish">
                    <option value="all">All Categories</option>
                <?php 
                    $categories = return_food_categories();
                    foreach($categories as $id => $category_name){
                        echo "<option value='$id' >$category_name</option>";
                    }
                ?>
                </select>
            </div>
            <div id="status-div">
                <label for="status" id="status-label">Select Status:</label>
                <select id="status">
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                   
                </select>
            </div>

            <div id='status-div'>
            <label for='status' id='status-label'>between:</label>
            <select id='date-1'>";
                <?php
            foreach($dates as $thedate){
                echo "<option value='$thedate'>$thedate</option>";
            }
            echo "</select>
            <select id='date-2'>";
            sort($dates);
            foreach($dates as $thedate){
                echo "<option value='$thedate'>$thedate</option>";
            }
            ?>
            </select>
            

            <table id="orders" class="dashboard-table">
                <tr>
                    <th>Order ID</th>
                    <th>Dish name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th colspan="3">Action</th>
                </tr>
                <tr>
                    <td>123</td>
                    <td>Levi Kamara Zwannah</td>
                    <td>900</td>
                    <td>3</td>
                    <td><button type='button' id='view'>view</button></td>
                    <td><button type='button' id='complete'>complete</button></td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>Levi Kamara Zwannah</td>
                    <td>900</td>
                    <td><button type="button" id="view">view</button></td>
                    <td><button type="button" id="complete">complete</button></td>
                    <td type=" button" id="delete"><button>delete</button></td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
    <script src="js/order-view.js"></script>
    </footer>
    
</body>
</html>