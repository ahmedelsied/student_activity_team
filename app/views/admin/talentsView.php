<h1 class='text-center  me_h1'>المشتركين</h1> 
<div class='container'>
    <div class='table-responsive'>  
        <table class='main-table text-center table table-bordered'>
            <tr>
                <td>#ID</td>
                <td>الاسم</td>
                <td>رقم الهاتف</td>
                <td>الموهبه</td>
            </tr>

<?php foreach($this->talents as $talent):?>
    <tr>
        <td> <?=$talent['id']?></td>
        <td><?=$talent['name']?></td>
        <td><?=$talent['phone']?></td>
        <td><?=$talent['cat_type']?></td>
    </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>