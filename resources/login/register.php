<form action="/register" method="post">
    <input type="text" name="name">
    <?php show_errors("name"); ?>
    <input type="email" name="email">
    <?php show_errors("email"); ?>
    <input type="password" name="password">
    <?php show_errors( "password"); ?>
    <input type="password" name="confirm">
    <?php show_errors( "confirm"); ?>
    <input type="submit">
</form>