<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
        </div>
        <div class="auth-side-form">
            <div class=" auth-content">
                <form method="POST" class="form-signin form-horizontal wow fadeIn animated" role="form" onsubmit="return false;">
                    <h3 class="mb-2 f-w-400 mt-4"><?php echo $logintitle;?></h3> 
                    <p class="text-muted mb-4"><?php echo $logingretting;?></p>
                    <div class="form-group">
                        <label class="label">Email</label>
                        <input type="text" name="email" placeholder="example@mail.com" required="" autofocus="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="label">Password</label>
                        <input type="password" name="password" placeholder="•••••••••••" required="" autofocus="" class="form-control pwd">
                        <a class="reveal" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                    </div>
                    
                    <button  type="submit" class="btn btn-login btn-block ladda-button" data-style="zoom-in">Masuk</button>
                    <div style="margin-top:10px" class="resultlogin"></div>
                </form>


                <form method="POST" class="form-signup form-horizontal wow fadeIn animated" style="display: none" onsubmit="return false;">
                    <h3 class="mb-2 f-w-400 mt-4"><?php echo $registitle;?> <br> <?php echo $regisgretting;?></h3>
                        <div class="form-group">
                            <label class="label">Email</label>
                            <input type="text" name="email" placeholder="Alamat Email Kamu" required="" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <input type="password" name="password" placeholder="Password" required="" autofocus="" class="form-control pwd">
                            <a class="reveal" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="form-group">
                            <label class="label">Confirm Password</label>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" required="" autofocus="" class="form-control pwd2">
                            <a class="reveal2" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        </div>                                    
                        <button  type="submit" class="btn btn-login btn-block ladda-button" data-style="zoom-in">Daftar</button>
                        <div style="margin-top:10px" class="resultregister"></div>
                </form>


                <div class="text-center saprator my-4"><span>atau</span></div>
                <div class="row text-center">
                    <div class="col ">
                        <a class="btn btn-outline-dark btn-google" href="<?php echo $loginGoogle; ?>" role="button" style="text-transform:none">
                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                        Google 
                        </a>
                    </div>
                    <div class="col">
                        <a class="btn btn-outline-dark btn-facebook" href="<?php echo $LoginFB;?>" role="button" style="text-transform:none">
                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/600px-Facebook_f_logo_%282019%29.svg.png" />
                        Facebook 
                        </a>
                    </div>
                </div>

                <p class="form-signin text-center mb-10 mt-5 text-muted">Belum punya akun? <a id="btn-register-form" href="javascript:void(0)" class="f-w-400">Daftar</a></p>
                <p class="form-signup text-center mb-10 mt-5 text-muted" style="display: none">Sudah punya akun? <a id="btn-login-form" href="javascript:void(0)" class="f-w-400">Masuk</a></p>

            </div>
            <footer class="footer-login">
                <span class="text-muted ">dipersembahkan oleh <span class="copyright-login"> MediaX.id</span></span>
            </footer>
        </div>
        
    </div>
</div>
<script>
    Ladda.bind( 'div:not(.progress-demo) button', { timeout: 2000 } );
    Ladda.bind( '.progress-demo button', {
        callback: function( instance ) {
            var progress = 0;
            var interval = setInterval( function() {
                progress = Math.min( progress + Math.random() * 0.1, 1 );
                instance.setProgress( progress );
                if( progress === 1 ) {
                    instance.stop();
                    clearInterval( interval );
                }
            }, 200 );
        }
    } ); 

    $("#btn-login-form").click(function() {
    $(".form-signin").show();
    $(".form-signup").hide();
    });

    $("#btn-register-form").click(function() {
    $(".form-signup").show();
    $(".form-signin").hide();
    });

    $(".reveal").on('click',function() {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
    $(".reveal2").on('click',function() {
        var $pwd2 = $(".pwd2");
        if ($pwd2.attr('type') === 'password') {
            $pwd2.attr('type', 'text');
        } else {
            $pwd2.attr('type', 'password');
        }
    });

    

</script>