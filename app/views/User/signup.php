<p class="h2 text-center">Регистрация</p>
<form class="form-signin" method="post" action="http://php.st/fw.loc/user/signup">
    <img class="mb-4" src="fw.loc/public/img/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Введите следующие данные</h1>

    <label for="login" class="sr-only">Name</label>
    <input type="text" id="login" name="login" class="form-control" placeholder="login" required autofocus value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) :''; ?>">
      
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required >

    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) :''; ?>>
      
    <label for="name" class="sr-only">Name</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Youre name" required value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) :''; ?>>
      
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    <?php= if(isset($_SESSION['form_data']) {
        unset($_SESSION['form_data']);
    } ?>
</form>
