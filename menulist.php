<style>
.Search-System {
    display: flex;
    justify-content: center;
    align-items: center;
    
}

.Search-Form {
    text-align: center;
    transition: .3s ease;
}

.Search-Label {
    margin-right: 10px;
}

.Search-input {
    padding: .3rem;
    padding-right: 35rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: .3s ease;
}
.Search-Form:hover{
    transform: scale(1.035);
    transition: .3s ease;
}

.Search-Submit {
    padding: 5px 10px;
    background-color: rgb(255, 174, 0);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: .3s ease;
}

.Search-Submit:hover {
    background-color: rgb(218, 149, 3);
    padding: 10px 20px;
    transition: .3s ease;
    font-size: 1rem;
}
.menu-list{

    }
    .menu-list ul{

    }
</style>
<div class="Search-System">
    <form method="GET" action="" class="Search-Form " id="searchForm">
        <label for="search" class="Search-Label">ค้นหาเมนู: </label>
        <input type="text" name="search" id="search" class="Search-input">
        <input type="submit" value="รีเซ็ต" class="Search-Submit">
    </form>
</div>
<div id="searchResult"></div>

<div class="menu-list">
    <?php 
        include 'MenuOnlyList.php';
    ?>
</div>
<!-- เพิ่ม input event listener เพื่อตรวจสอบการพิมพ์ -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    // เมื่อมีการพิมพ์ใน input id="search"
    $('#search').on('input', function () {
        // ดึงค่าจาก input
        var searchValue = $(this).val();

        // ตรวจสอบว่ามีค่าใน id "search" หรือไม่
        if (searchValue) {
            // ถ้ามีค่า ให้ซ่อนหรือลบ div ที่มี class="menu-list"
            $('.menu-list').hide(); // หรือใช้ .remove() ถ้าต้องการลบทันที
        } else {
            // ถ้าไม่มีค่า ให้แสดง div ที่มี class="menu-list"
            $('.menu-list').show();
        }

        // แสดงผล Realtime ที่ div id="searchResult"
        $('#searchResult').load('SearchMenu.php?search=' + searchValue);
        // เมื่อโหลดเสร็จแล้ว ลบรายการเมนูที่เก่าออกไป
        $('.menu-list ul').empty();
    });
});

</script>
