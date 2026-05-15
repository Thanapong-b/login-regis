<?php include_once('header.php'); ?>

<?php include_once('nav.php'); ?>

<div class="container">
    <h3 class="my-3">Login Page</h3>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="email address" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="email" placeholder="Enter your email"/>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" aria-describedby="password" placeholder="Enter your password"/>
        </div>
        <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
    </form>

    <p class="mt-3">Do not have an account yet? go to <a href="signup.php">Sign Up</a> Page</p>

    <hr>
    <a href="index.php" class="btn btn-secondary">Go back</a>


</div>

<?php include_once('footer.php'); ?>