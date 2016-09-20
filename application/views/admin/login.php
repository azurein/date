
    <div class="login-clean">
        <form method="post" action="<?=base_url()?>login/checkLoginData">
            <!-- <h2 class="text-uppercase text-center">D.A.T.E. Login</h2> -->
            <div class="illustration"><i class="icon ion-ios-locked"></i></div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" required="" placeholder="Username" autofocus>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" required="" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Masuk</button>
            </div>
            <?php
                if($this->session->flashdata('login_status') == 'failed') {
                    echo "
                        <script>
                            $('.illustration').addClass('animated shake');
                            $('input.form-control').addClass('invalid-login');
                            $('input.form-control').css('border', 'solid 0.5px #f4476b');
                        </script>
                    ";
                }
            ?>
        </form>
    </div>
</body>
</html>
