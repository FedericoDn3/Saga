<style>

.profile-head {
    transform: translateY(5rem)
}

.cover {
    background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
    background-size: cover;
    background-repeat: no-repeat
}

body {

    min-height: 100vh;
    overflow-x: hidden
}
</style>








<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
                     <!-- Si esta log -->
        <?php if(isset($_SESSION["autor_data"])) : ?>
                <?php foreach($viewmodel as $item) : ?>
                    <div class="row py-5 px-4">
    <div class="col-md-5 mx-auto">
        <hr>
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgAut']).'" alt="..." width="130" class="rounded mb-2 img-thumbnail"/>'; ?></div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo $item['NomAut'];?><?php echo "&nbsp;";?><?php echo $item['ApellidoAut'];?></h4>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>Uruguay</p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
            </div>
            <div class="px-4 py-3">
                <h5 class="mb-0"><small><?php echo $item['NicknameAut']; ?></small></h5>
                <small><?php echo $item['SexoAut']; ?></small>
                <div class="p-4 rounded shadow-sm bg-light">
                    <p class="font-italic mb-0"><small><?php echo $item['BiografiaAut']; ?></small> </p>

                </div>
            </div>
        </div>
    </div>
</div>
<hr>
                <?php endforeach; ?> 
        <?php elseif(isset($_SESSION["cliente_data"])) : ?>
            <?php foreach($viewmodel as $item) : ?>
                <div class="row py-5 px-4">
    <div class="col-md-5 mx-auto">
        <hr>

        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgCli']).'" alt="..." width="130" class="rounded mb-2 img-thumbnail"/>'; ?><a href="<?php echo ROOT_URL; ?>users/listaFav" class="btn btn-outline-dark btn-sm btn-block">Mis Favoritos</a></div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo $item['NomCli']; ?><?php echo "&nbsp;"; ?><?php echo $item['ApellidoCli']; ?></h4>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>Uruguay</p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
            </div>
            <div class="px-4 py-3">
                <h5 class="mb-0"><small><?php echo $item['NicknameCli']; ?></small></h5>
                <small><?php echo $item['SexoCli']; ?></small>
            </div>
        </div>
    </div>
</div>
<hr>
                <?php endforeach; ?>
        <?php endif; ?>                                                 
    <?php else : ?>
                <!-- Si no esta log -->
                <h1><?php echo "Porfavor iniciar sesion.<br>"; ?></h1>
                <h5><?php echo "Si aun no cuentas con una"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>users/register">
                <button type="button" class="btn btn-outline-info"  >Registrate</button>
                  
    <?php endif; ?>
 
 

</div>