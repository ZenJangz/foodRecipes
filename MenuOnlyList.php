<style>
    .ImgHover{
        border-radius: 0px;
        transition: .3s ease;
        object-fit: cover;
    }
    .ImgHover:hover{
        transform: scaleY(1.09);
        transition: .3s ease;
    }
    .HoverThis{
        transition: .3s ease;
    }
    .HoverThis:hover{
        /* margin-left: 5%;
        margin-right: 5%; */
        transition: .3s ease;
        transform: scale(1.05);
    }
    
</style>
<?php if(!empty($_SESSION['Alert'])){?>
    <h3 class="text-center mt-5"><i class="fa-solid fa-plus me-1"></i>เมนู <?=$_SESSION['Alert'];?> ถูกบันทึกลงรายการที่ชอบแล้ว</h3>
    <?php unset($_SESSION['Alert'])?>
<?php }?>
<div class="container d-flex flex-wrap m-auto justify-content-center" style="max-width: 100%;">
    <?php foreach ($query_Menu as $data) : ?>
    <a href="Menu-detail-B1.php?Menu-ID=<?=$data['id_menu']?>">
        <section class="HoverThis mt-5" style="max-width: 20%;">
            <div class="card mx-2">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="<?php echo getImageUrl($data); ?>" alt="Menu Image" class="img-fluid w-100 ImgHover" style="max-height: 20vh; object-fit:cover;">
                    
                </div>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><a><?= $data['Menu_name']; ?></a></h5>
                    <p class="mb-2"><i class="fa-solid fa-bowl-food me-1"></i> • อาหาร </p>
                    <p class="card-text"><?= $data['Menu_EP']; ?></p>
                    </a>
                    <hr class="my-4" />
                    <p class="lead text-center"><strong>บันทึกลงรายการที่ชอบ</strong></p>
                    <a id="<?= $data['id_menu']; ?>" href="Heart-NL.php?id=<?= $data['id_menu']; ?>" class="btn btn-danger p-md-1 mb-0 w-100"><i class="fa-solid fa-heart me-1"></i>บันทึก</a>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</div>
<?php
function getImageUrl($data)
{
    if (!empty($data['Img_Name_Main'])) {
        return 'Admin/Image_Uploaded/' . $data['Img_Name_Main'];
    } elseif (!empty($data['Img_URL_Main'])) {
        return $data['Img_URL_Main'];
    } elseif (!empty($data['Image_URL_Sec1'])) {
        return $data['Image_URL_Sec1'];
    } elseif (!empty($data['Image_Name_Sec1'])) {
        return $data['Image_Name_Sec1'];
    } elseif (!empty($data['Image_URL_Sec2'])) {
        return $data['Image_URL_Sec2'];
    } elseif (!empty($data['Image_Name_Sec2'])) {
        return $data['Image_Name_Sec2'];
    } elseif (!empty($data['Image_URL_Sec3'])) {
        return $data['Image_URL_Sec3'];
    } elseif (!empty($data['Image_Name_Sec3'])) {
        return $data['Image_Name_Sec3'];
    } else {
        return 'Admin/Image_Uploaded/NO-IMG.png';
    }
}
?>