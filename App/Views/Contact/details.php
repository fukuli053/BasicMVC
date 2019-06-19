<?php $this->setSiteTitle($this->contact->FullName()); ?>


<?php $this->start('body'); ?>
<div class="col-md-12 mt-3">
    <a href="<?= SROOT ?>contacts" class="btn btn-xs btn-primary">Geri Dön</a>
    <h2 class="text-center"><?= $this->contact->FullName() ?></h2>
    <div class="col-md-6">
        <p><strong>Email: </strong> <?= $this->contact->email ?></p>
        <p><strong>Telephone: </strong> <?= $this->contact->telephone ?></p>
        <p><strong>First Name: </strong> <?= $this->contact->fname ?></p>
        <p><strong>Last Name: </strong> <?= $this->contact->lname ?></p>
    </div>
</div>
<?php $this->end(); ?>