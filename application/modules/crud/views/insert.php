<html>
<header>
</header>

<body>

<?php echo validation_errors('<div class="error">', '</div>'); ?>
<form method="post" action="insert">
    <?php if (isset($msg)) {
        echo $msg;
    } ?>
    insert to DB : title<input type="text" name="title" value="<?= $this->session->flashdata('title'); ?>">
    <br>
    content:<input type="text" name="content" value="<?= $this->session->flashdata('content'); ?>">
    <br>
    tags:<textarea name="tags" value="<?= $this->session->flashdata('tags'); ?>"></textarea>
    <br> <input type="submit" name="insert">
</form>
</body>

</html>