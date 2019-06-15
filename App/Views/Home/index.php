<?php $this->setSiteTitle("Site Başlığı"); ?>
<?php $this->start('head'); ?>
<meta content="test" />
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h1 class="text-center">Hoş Geldiniz Beyefendi</h1>
<?= inputBlock('text', 'adınız', 'ad', 'Furkan', ['class' => 'form-control naber'], ['onclick' => 'anan']); ?>
<?= submitBlock('Gönder', ['class' => 'btn btn-primary'], ['class' => 'text-right']); ?>
<?= submitTag('Gönder', ['class' => 'btn btn-primary']); ?>
<?php $this->end(); ?>