<?php 
    $menu = Router::getMenu('menu_acl');
    $currentPage = currentPage();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php foreach($menu as $key => $value) :
        $active = ''; ?>
        <?php if(is_array($value)): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $key ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach ($value as $k => $v):
              $active = ($v == $currentPage) ? 'active' : null ;?>
              <?php if($k == "separator") : ?>
                <div class="dropdown-divider"></div>
              <?php else:?>
                <a class="dropdown-item <?= $active ?>" href="<?= $v ?>"><?= $k ?></a>
              <?php endif;?>
            <?php endforeach; ?>
          </div>
        </li>
        <?php else : ?>
        <li class="nav-item">
          <?php $active = ($value == $currentPage) ? 'active' : null ;?>
          <a class="nav-link <?= $active ?>" href="<?= $value ?>"><?= $key ?></a>
        </li>
        <?php endif; ?>
      <?php endforeach ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?php if(currentUser()) :?>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Hoşgeldin, <?= currentUser()->fname ?></button>
      <?php endif; ?>
    </form>
  </div>
</nav>