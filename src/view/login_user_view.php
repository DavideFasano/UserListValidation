
<?php include './src/view/head.php' ?> 
<?php include './src/view/header.php' ?>


<div class="container">
        <!-- <form action="add_user_form.php" method="POST"> -->
        <form class="mt-4" action="<?= $action ?>" method="POST">
           
            <div class="form-group">
               <label for="">email</label>
               <!-- is-invalid  -->
               <input
                value="<?= $email ?>" 
                class="form-control <?= $loginClass ?>"  
                name="email"  
                type="text">
               
            </div>


            <div class="form-group">
               <label for="">password</label>
               <!-- is-invalid  -->
               <input
                value="<?= $password ?>" 
                class="form-control <?= $loginClass ?>"  
                name="password"  
                type="text">
               <div class="<?= $loginClassMessage ?>">
                  <?= $loginMessage ?>
               </div> 
            </div>
  
             <button class="btn btn-primary mt-3" type="submit"><?= $submit ?></button>
        </form>
    </div>
    
</body>
</html>