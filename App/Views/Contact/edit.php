<?php $this->setSiteTitle($this->contact->FullName() . ' Düzenle'); ?>


<?php $this->start('body'); ?>
<h1 class="text-center"><?= $this->contact->FullName() . ' adlı kişinin bilgilerini düzenle' ?></h1>
<div class="bg-danger form-errors"><?= $this->displayErrors ?></div>
<form class="form" action="<?= $this->postAction ?>" method="POST">
    <?= inputBlock('text','Ad', 'fname', $this->contact->fname, ["class" => "form-control"]); ?>
    <?= inputBlock('text','Soyad', 'lname', $this->contact->lname, ["class" => "form-control"]); ?>
    <?= inputBlock('email','E-Posta', 'email', $this->contact->email, ["class" => "form-control"]); ?>
    <?= inputBlock('tel','Telefon', 'telephone', $this->contact->telephone, ["class" => "form-control","pattern"=>"[0-9]{3}-[0-9]{2}-[0-9]{3}"]); ?>
    <?= submitBlock('Kaydet', ["class" => "btn btn-primary"], ["class" => "text-right"]) ?>
</form>

<?php $this->end(); ?>