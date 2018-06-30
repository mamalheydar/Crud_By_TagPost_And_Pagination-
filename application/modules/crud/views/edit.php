<html>
<header>
</header>
<body>
<?php echo validation_errors('<div class="error">', '</div>'); ?>
<form method="post" action="edit">

    <input type="hidden" name="id" value="<?=$id;?>">
    Update DB :<br><br>title:<input type="text" name="title" value="<?= set_value('title', $databaseData[0]->title); ?>">
    <br>
    content:<input type="text" name="content" value="<?= set_value('content', $databaseData[0]->content); ?>">
    <br>
    tags:<input rows="20"  name="tags" value="<?= set_value('tags',$databaseData[0]->tags); ?>">
    <br>
    <input type="submit" name="update">
</form>
<?= var_dump($databaseData); ?>
</body>
</html>