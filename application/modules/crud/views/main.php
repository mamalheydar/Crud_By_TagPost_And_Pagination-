<html>
<header>
    <style>
    </style>
</header>
<body>
<form method="get" action="">
    <table style="width:100%;text-align:left;border:2px #3cff2a solid">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>tags</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>

        <?php foreach ($q as $row) {
            ?>
            <tr>
                <td><?= $row->id; ?> </td>
                <td><?= $row->title; ?> </td>
                <td><?= $row->content; ?></td>
                <td><?= $row->tg_name; ?> </td>
                <td><a href="delete?id=<?= $row->id; ?>">Delete</a></td>
                <td><a href="edit?id=<?= $row->id; ?>">Update</a></td>
                <td></td>
            </tr>
            <?php
        }
        ?>
    </table>
</form>
<a href="insert">Insert</a>
<br>
<?= $pagination; ?>
<br>
<br>
<br>
<br>
<b>All of count equal by:<?= $table_count_row; ?> </b>
</body>
</html>