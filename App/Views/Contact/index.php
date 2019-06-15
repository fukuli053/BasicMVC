<?php $this->setSiteTitle("Kişilerim"); ?>


<?php $this->start('body'); ?>
<h1 class="text-center">Kişilerim Sayfası</h1>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Telephone</th>
        </tr>
    </thead>
    <?php foreach($this->contacts as $contact) : ?>
        <tr>
            <td><?= $contact->id ?></td>
            <td><?= $contact->FullName(); ?></td>
            <td><?= $contact->telephone ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php $this->end(); ?>