<?php use Core\FH; ?>
<?php $this->setSiteTitle("Kişilerim"); ?>


<?php $this->start('body'); ?>
<h1 class="text-center">Kişi Ekle</h1>
<form class="form" action="<?= SROOT ?>contacts/add" method="POST">
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::csrfInput(); ?>
    <?= FH::inputBlock('text','Ad', 'fname', '', ["class" => "form-control"]); ?>
    <?= FH::inputBlock('text','Soyad', 'lname', '', ["class" => "form-control"]); ?>
    <?= FH::inputBlock('email','E-Posta', 'email', '', ["class" => "form-control"]); ?>
    <?= FH::inputBlock('tel','Telefon', 'telephone', '', ["class" => "form-control","pattern"=>"[0-9]{3}-[0-9]{2}-[0-9]{3}"]); ?>
    <?= FH::submitBlock('Kaydet', ["class" => "btn btn-primary"], ["class" => "text-right"]) ?>
</form>

<?php $this->end(); ?>