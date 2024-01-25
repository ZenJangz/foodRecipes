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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .IN-URL-IMG {
            width: 35rem;
        }

        .IMG-Position,
        .YT-Position {
            display: inline-block;
            vertical-align: top;
        }

        .IMG-Position {
            margin-right: 20px;
            /* ปรับระยะห่างตามความต้องการ */
        }

        .IN-URL-YT {
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .IMG-Input {
            margin: auto;
            padding: 3%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .IN-URL-IMG,
        #image-upload {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #player {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }
    </style>
</head>
<?php include('AdminHeader.php'); ?>

<body>
    <h1 class="text-center mt-5 pb-5">ระบบเพิ่มเมนู (ชั่วคราว) <?php if (!empty($_SESSION['Alert'])){echo $_SESSION['Alert'];}?></h1>
    <div class="container d-flex justify-content-center flex-wrap m-auto">
        <form action="Admin/Menu_upload_procress.php" method="POST" class="m-auto" enctype="multipart/form-data">
            <div class="row g-3 m-auto justify-content-center">
                <div class="col">
                    <label for="inputMenu1" class="form-label">ชื่อเมนู</label>
                    <input class="form-control pe-md-5" type="text" placeholder="ชื่อเมนู" required name="Menu_name" id="inputMenu1">
                </div>
                <div class="col">
                    <label for="Menu_Mat" class="form-label">ส่วนประกอบ</label>
                    <textarea class="form-control" id="Menu_Mat" placeholder="ส่วนประกอบ" name="Menu_Mat1" required></textarea>
                </div>
            </div>
            <div class="row g-3 m-auto justify-content-center">
                <div class="col">
                    <label for="Menu_Mat" class="form-label">วิธีทำ</label>
                    <textarea class="form-control" name="Menu_How1" placeholder="วิธีทำ" required></textarea>
                </div>
                <div class="col">
                    <label for="Menu_Mat" class="form-label">คำอธิบาย</label>
                    <textarea class="form-control" id="Menu_Description" placeholder="คำอธิบาย" name="Menu_EP" required></textarea>
                </div>
            </div>
            <div>
                <div class="row g-5 justify-content-center m-auto pt-4 col-11">
                    <div class="IMG-Input col m-3">
                        <label for="image-url-main" class="">ภาพปก</label>
                        <p class="text-danger">**ถ้าภาพไม่ขึ้นให้เปลี่ยนภาพ ถ้าลิงก์ไม่มี https ให้เปลี่ยนลิงก์ ถ้าลิงก์ขึ้นต้น data:image/ ให้เปลี่ยนลิงก์**</p>
                        <input class="form-control" type="text" name="Img_URL_Main" id="image-url-main" placeholder="Enter image URL" oninput="preview('main')">
                        <br>
                        <label for="image-upload-main">Upload Image:</label>
                        <!-- <input type="file" name="Img_Name_Main" id="image-upload-main" accept="image/gif, image/jpeg, image/jpg, image/png, image/webp" oninput="preview('main')"> -->
                        <button style="margin: 1rem 0 1rem 0;" type="button" onclick="clearFileInput('main')" class="btn bg-danger text-white">ลบภาพ</button>
                        <br>
                        <img src="" alt="Image Preview" id="image-preview-main" style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="IMG-Input col m-3">
                        <label for="image-url-sec1">ภาพประกอบ1</label>
                        <p class="text-danger">**ถ้าภาพไม่ขึ้นให้เปลี่ยนภาพ ถ้าลิงก์ไม่มี https ให้เปลี่ยนลิงก์ ถ้าลิงก์ขึ้นต้น data:image/ ให้เปลี่ยนลิงก์**</p>
                        <input class="form-control" type="text" name="Image_URL_Sec1" id="image-url-sec1" placeholder="Enter image URL" oninput="preview('sec1')">
                        <br>
                        <label for="image-upload-sec1">Upload Image:</label>
                        <!-- <input type="file" name="Image_Name_Sec1" id="image-upload-sec1" accept="image/gif, image/jpeg, image/jpg, image/png, image/webp" oninput="preview('sec1')"> -->
                        <button style="margin: 1rem 0 1rem 0;" type="button" onclick="clearFileInput('sec1')" class="btn bg-danger text-white">ลบภาพ</button>
                        <br>
                        <img src="" alt="Image Preview" id="image-preview-sec1" style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="IMG-Input col m-3">
                        <label for="image-url-sec2">ภาพประกอบ2</label>
                        <p class="text-danger">**ถ้าภาพไม่ขึ้นให้เปลี่ยนภาพ ถ้าลิงก์ไม่มี https ให้เปลี่ยนลิงก์ ถ้าลิงก์ขึ้นต้น data:image/ ให้เปลี่ยนลิงก์**</p>
                        <input class="form-control" type="text" name="Image_URL_Sec2" id="image-url-sec2" placeholder="Enter image URL" oninput="preview('sec2')">
                        <br>
                        <label for="image-upload-sec2">Upload Image:</label>
                        <!-- <input type="file" name="Image_Name_Sec2" id="image-upload-sec2" accept="image/gif, image/jpeg, image/jpg, image/png, image/webp" oninput="preview('sec2')"> -->
                        <button style="margin: 1rem 0 1rem 0;" type="button" onclick="clearFileInput('sec2')" class="btn bg-danger text-white">ลบภาพ</button>
                        <br>
                        <img src="" alt="Image Preview" id="image-preview-sec2" style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="IMG-Input col m-3">
                        <label for="image-url-sec3">ภาพประกอบ3</label>
                        <p class="text-danger">**ถ้าภาพไม่ขึ้นให้เปลี่ยนภาพ ถ้าลิงก์ไม่มี https ให้เปลี่ยนลิงก์ ถ้าลิงก์ขึ้นต้น data:image/ ให้เปลี่ยนลิงก์**</p>
                        <input class="form-control" type="text" name="Image_URL_Sec3" id="image-url-sec3" placeholder="Enter image URL" oninput="preview('sec3')">
                        <br>
                        <label for="image-upload-sec3">Upload Image:</label>
                        <!-- <input type="file" name="Image_Name_Sec3" id="image-upload-sec3" accept="image/gif, image/jpeg, image/jpg, image/png, image/webp" oninput="preview('sec3')"> -->
                        <button style="margin: 1rem 0 1rem 0;" type="button" onclick="clearFileInput('sec3')" class="btn bg-danger text-white">ลบภาพ</button>
                        <br>
                        <img src="" alt="Image Preview" id="image-preview-sec3" style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="YT-Position col">
                        <label for="youtube-url">ลิงก์อ้างอิง Youtube หรือ วิธีทำใน Youtube:</label>
                        <p class="text-danger">**ถ้าตัวเล่นวีดีโอไม่มาให้เปลี่ยนลิงก์**</p>
                        <input class="form-control" type="text" id="youtube-url" placeholder="Enter YouTube URL" required name="YT_URL">
                        <br>
                        <div class="YT-V-Size" id="player"></div>
                    </div>
                </div>
                <div class="d-grid gap-2 pt-5 pb-5">
                    <button class="btn btn-primary" type="submit" name="submit">บันทึกลงฐานข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <?php

    ?>
    <script>
        function preview(section) {
            const urlInput = document.getElementById(`image-url-${section}`);
            const fileInput = document.getElementById(`image-upload-${section}`);

            if (urlInput.value) {
                previewImage(urlInput.value, section);
            } else if (fileInput.files.length > 0) {
                previewFile(section);
            }
        }

        function previewImage(url, section) {
            document.getElementById(`image-preview-${section}`).src = url;
        }

        function previewFile(section) {
            const fileInput = document.getElementById(`image-upload-${section}`);
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`image-preview-${section}`).src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function clearFileInput(section) {
            var fileInput = document.getElementById(`image-upload-${section}`);
            var newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = `Img_Name_${section}`;
            newFileInput.id = `image-upload-${section}`;
            newFileInput.accept = 'image/gif, image/jpeg, image/jpg, image/png, image/webp';
            newFileInput.oninput = () => preview(section);

            fileInput.parentNode.replaceChild(newFileInput, fileInput);
            document.getElementById(`image-preview-${section}`).src = '';
        }
    </script>
    <script>
        var player;

        // Function to extract YouTube video ID from URL
        function getYoutubeVideoId(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return (match && match[7].length == 11) ? match[7] : false;
        }

        // Function to create the YouTube player and generate embed code
        function createYoutubePlayer(videoId) {
            // Destroy the existing player if it exists
            if (player) {
                player.destroy();
            }

            // Create the YouTube player
            player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: videoId,
            });

            // Generate embed code for the given video ID
            var embedCode = '<iframe width="640" height="360" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';

            // Display the embed code or use it as needed
            console.log("Embed Code:", embedCode);
        }


        // Event listener for input change
        document.getElementById('youtube-url').addEventListener('input', function() {
            // Get the YouTube URL from the input
            var youtubeUrl = this.value;

            // Extract the video ID from the URL
            var videoId = getYoutubeVideoId(youtubeUrl);

            // Check if a valid video ID is extracted
            if (videoId) {
                // Create the YouTube player and generate embed code
                createYoutubePlayer(videoId);
            } else {
                // If invalid video ID, clear the YouTube player
                clearYoutubePlayer();
            }
        });

        // Function to clear the YouTube player
        function clearYoutubePlayer() {
            // Destroy the player if it exists
            if (player) {
                player.destroy();
            }
        }

        // Event listener for clearing the YouTube player
        document.getElementById('clear-button').addEventListener('click', function() {
            // Clear the input field
            document.getElementById('youtube-url').value = '';

            // Clear the YouTube player
            clearYoutubePlayer();
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
if(!empty($_SESSION['Alert'])):?>
<script>
    Swal.fire({
        position: "top-end",
        icon: "<?=$_SESSION['SWA-ICO']?>",
        title: "เมนู <?=$_SESSION['Up_menuname']?> ได้รับการบันทึกแล้ว",
        showConfirmButton:false,
        timer: 3500
    });
</script>
<?php endif ?>
<?php unset($_SESSION['SWA-ICO']); unset($_SESSION['Alert']); unset($_SESSION['Up_menuname']); ?>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cefc293317.js" crossorigin="anonymous"></script>
</body>

</html>