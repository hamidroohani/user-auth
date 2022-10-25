<form action="/login" method="post">
    <input type="text" name="username">
    <?php show_errors("username"); ?>
    <input type="password" name="password">
    <?php show_errors( "password"); ?>
    <input type="submit">
</form>