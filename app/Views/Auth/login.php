<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main'); ?>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
            <div class="card card-primary mt-5">
                <div class="card-header">
                    <h4><?= lang('Auth.loginTitle') ?></h4>
                </div>
                <div class="card-body">
                    <?= view('App\Views\Auth\_message_block') ?>

                    <form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">

                        <?= csrf_field() ?>

                        <?php if ($config->validFields === ['email']) : ?>
                            <div class="form-group">
                                <label for="login"><?= lang('Auth.email') ?></label>
                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label"><?= lang('Auth.password') ?></label>
                                <?php if ($config->activeResetter) : ?>
                                    <div class="float-right">
                                        <a href="<?= url_to('forgot') ?>" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>

                        <?php if ($config->allowRemembering) : ?>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="remember-me" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <label class="custom-control-label" for="remember-me"><?= lang('Auth.rememberMe') ?></label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                <?= lang('Auth.loginAction') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php if ($config->allowRegistration) : ?>
                <div class="mt-3 text-muted text-center">
                    Don't have an account? <a href="<?= url_to('register') ?>">Create One</a>
                </div>
            <?php endif; ?>
            <div class="simple-footer">
                Copyright &copy; Stisla <span class="year"></span>
            </div>
        </div>
    </div>
</div>
<script>
    var d = new Date();
    var n = d.getFullYear();
    document.getElementsByClassName("year")[0].innerHTML = n;
</script>
<?= $this->endSection(); ?>