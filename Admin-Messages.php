<?php
session_start();
if ($_SESSION['Position'] == 0) {
    echo '
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
  
    <div class="container-fluid">
  
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="/food_web/index.php">&larr; Back to Dashboard</a>
    </div>';
    exit;
}
include 'connect.php';
$sql = "SELECT * FROM wh_contact ORDER BY date DESC";
$contact = mysqli_query($connect, $sql);

$data = mysqli_fetch_array($contact);
$uid = $data['id_Contact'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List-Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
</head>
<?php include('AdminHeader.php'); ?>

<body>
    <div class="container mt-5">
        <h2 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600 text-center">Messages From Users</h2>
        <?php if (!empty($_SESSION['Alert'])) { ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?= $_SESSION['Alert'] ?>",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    <?php } ?>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Massages</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php
                // ดึงข้อมูลผู้ใช้งานจากฐานข้อมูล (ในกรณีนี้จะให้คุณแก้ไขการดึงข้อมูลตามฐานข้อมูลที่คุณใช้)

                foreach ($contact as $contacts):?>
                    <tr>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['id_Contact']?></td>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['name']?></td>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['lastname']?></td>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['email']?></td>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['message']?></td>
                        <td id="<?=$contacts['id_Contact']?>"><?=$contacts['date']?></td>
                        <td id="<?=$contacts['id_Contact']?>">
                            <a href='' class="delete-user-link" user-id="<?=$contacts['id_Contact'];?>" user-name="<?= $contacts['name']; ?>">
                                <button class='btn btn-danger'>Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
            document.addEventListener("DOMContentLoaded", function() {
                var deleteMenuLinks = document.querySelectorAll('.delete-user-link');
                deleteMenuLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var userId = this.getAttribute('user-id');
                        var userName = this.getAttribute('user-name');

                        // แสดง SweetAlert สำหรับการยืนยันการลบ
                        Swal.fire({
                            title: "ต้องการลบ User: " + userName + " ออกจากระบบ??",
                            text: "คำเตือนไม่สามารถกู้คืนรายการที่ถูกลบได้",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "ใช่ลบ User " + userName + " !!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // ลิงค์ไปยังหน้า Admin-MenuDelete.php พร้อมส่งค่า id_menu
                                window.location.href = "Admin-Messages-Delete-Pro.php?id=" + userId;
                            }
                        });
                    });
                });
            });
        </script>
<?php unset($_SESSION['Alert']);
        unset($_SESSION['Menu-Name']) ?>

    <!-- <script>
  function confirmDelete(event) {
    event.preventDefault();
    var url = event.target.getAttribute('href');
    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();

    var confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.addEventListener('click', function() {
      window.location.href = url;
    });
  }
</script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>


</body>

</html>