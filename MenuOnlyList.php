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
    .btn-custom{
        background-color: rgb(255,174,0);
    }
    
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
<?php if (!empty($_SESSION['Alert'])) { ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?= $_SESSION['Alert'] ?>",
                Text: "เพิ่มลงในเมนูที่ชอบแล้ว",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    <?php } ?>
    <?php if(!empty($_SESSION['Alert'])){unset($_SESSION['Alert']);}?>
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
                    <a id="<?= $data['id_menu']; ?>" href="Heart-NL.php?id=<?= $data['id_menu']; ?>" data-menu-id="<?= $data['id_menu']; ?>" data-menu-name="<?= $data['Menu_name']; ?>" class="delete-menu-link btn btn-custom text-white shadow p-md-1 mb-0 w-100"><i class="fa-solid fa-heart me-1"></i>บันทึก</a>
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
<script>
            document.addEventListener("DOMContentLoaded", function() {
                var deleteMenuLinks = document.querySelectorAll('.delete-menu-link');
                deleteMenuLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var menuId = this.getAttribute('data-menu-id');
                        var menuName = this.getAttribute('data-menu-name'); // เพิ่มตัวแปรนี้

                        // แสดง SweetAlert สำหรับการยืนยันการลบ
                        Swal.fire({
                            title: "เพิ่มเมนู: " + menuName + " ลงในรายการที่ชอบ??",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "ใช่เพิ่มเมนู " + menuName,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // ลิงค์ไปยังหน้า Admin-MenuDelete.php พร้อมส่งค่า id_menu
                                window.location.href = "Heart-NL.php?id=" + menuId;
                            }
                        });
                    });
                });
            });
        </script>
        <?php if(!empty($_SESSION['Alert'])){unset($_SESSION['Alert']);}?>