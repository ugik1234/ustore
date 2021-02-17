                <div class="login-wrapper">
                    <div class="h4">Sign in</div>
                    <form id="loginForm">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="required" autocomplete="username" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required" autocomplete="current-password" />
                        </div>
                        <div class="form-group">
                            <a href="#forgotpassword" class="open-popup">Forgot password?</a>
                            <a href="#createaccount" class="open-popup">Don't have an account?</a>
                        </div>
                        <button id="loginBtn" type="submit" class="btn btn-block btn-main">
                            Submit
                        </button>
                    </form>
                </div>
                <script>
                    $(document).ready(function() {

                        var loginForm = $('#loginForm');
                        var submitBtn = loginForm.find('#loginBtn');
                        <?php if (!empty($activator)) {
                            echo 'swal("Succes Activation", "", "success")';
                        } ?>;

                        loginForm.on('submit', (ev) => {
                            ev.preventDefault();
                            buttonLoading(submitBtn);
                            $.ajax({
                                url: "<?= site_url() . 'login-process' ?>",
                                type: "POST",
                                data: loginForm.serialize(),
                                success: (data) => {
                                    buttonIdle(submitBtn);
                                    json = JSON.parse(data);
                                    if (json['error']) {
                                        swal("Login Gagal", json['message'], "error");
                                        return;
                                    }
                                    $(location).attr('href', '<?= base_url() ?>');
                                },
                                error: () => {
                                    buttonIdle(submitBtn);
                                }
                            });
                        });

                        var lang_in = $('#lang_in');
                        var lang_en = $('#lang_en');
                        lang_in.on('click', (ev) => {
                            document.cookie = "lang_set=in";
                            location.reload();
                        });
                        lang_en.on('click', (ev) => {
                            document.cookie = "lang_set=en";
                            location.reload();
                        });


                    });
                </script>
