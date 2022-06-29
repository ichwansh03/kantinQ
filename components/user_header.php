<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="shop.php" class="logo">Kantin Kejujuran<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">Beranda</a>
         <a href="cart.php">Pesanan</a>
         <a href="products.php">Tambah Menu</a>
         <a href="contact.php">Kotak Saran</a>
      </nav>

      <div class="icons">
         <?php
            $fetch_balance = 0;
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();

            $count_balance = $conn->prepare("SELECT * FROM `balance` WHERE user_id = ?");
            $count_balance->execute([$user_id]);
            
            
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="#"><i class=" fas fa-money-check-alt"></i><span>(Rp.<?php if($count_balance->rowCount()>0){
               $fetch_balance = $count_balance->fetch(PDO::FETCH_ASSOC);
               echo $fetch_balance['pbalance'];} ?>)</span></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
            
      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">Update Profil</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Daftar Akun</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('keluar dari website?');">Keluar</a> 
         <?php
            }else{
         ?>
         <p>Silakan login atau daftar akun!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Daftar</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>