<?php $this->setSiteTitle("Kişilerim"); ?>


<?php $this->start('body'); ?>
<h1 class="text-center">Kişilerim Sayfası</h1>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Telephone</th>
            <th scope="col">İşlemler</th>
        </tr>
    </thead>
    <?php foreach($this->contacts as $contact) : ?>
        <tr>
            <td><?= $contact->id ?></td>
            <td><a href="<?=SROOT?>contacts/details/<?= $contact->id ?>"><?= $contact->FullName(); ?></a></td>
            <td><?= $contact->telephone ?></td>
            <td><a href="<?=SROOT?>contacts/edit/<?= $contact->id ?>">Düzenle</a> | <a href="<?=SROOT?>contacts/delete/<?= $contact->id ?>">Sil</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php $this->end(); ?>