<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Giriş Yap</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="<?= SROOT ?>register/login" method="POST">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Kullanıcı adı girin">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Şifre">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Beni Hatırla</label>
                </div>
                <button type="submit" class="btn btn-primary">Giriş Yap</button>
                <div class="text-right">
                    Üye olmak için <a href="<?= SROOT ?>register/register">buraya</a> tıklayın.
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->end(); ?>