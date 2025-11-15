<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="BanniereSuperieur">
    <br/>
    <?php if ( (isset($_SESSION['usercbs'])) ) : ?>
        <div id="div-bouttons-con" >
            <a href="<?=HOST; ?>deconnexionEtudiantCbs" ><button id="boutton-con">Déconnexion</button></a>
        </div>
    <?php endif; ?>

    <!-- <img src="<?php echo ASSETS_HOST.'icones/'; ?>menu.png" alt="icone menu" id="icone-menu" /> -->

    <!-- <button id="menu-toggle" class="menu-toggle">&#9776;</button> -->
    <!-- <img src="<?php echo ASSETS_HOST.'icones/'; ?>menuTelephone.png" alt="icone menu" id="icone-menuTelephone" /> -->

</header>


<?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <p class="alert alert-<?= $type ?>">
            <?= $message ?>
        </p>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif; ?>