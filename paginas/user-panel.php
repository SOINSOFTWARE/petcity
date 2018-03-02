<div class="user-panel">
    <div class="pull-left image">
        <?php
        if ($company_photo !== NULL && $company_photo !== '') {
            echo '<img src="';
            echo $company_photo;
            echo '" class="img-circle" alt="User Image" />';
        }
        ?>
    </div>
    <div class="pull-left info">
        <p><b><?php echo $company; ?></b></p>
    </div>
</div>