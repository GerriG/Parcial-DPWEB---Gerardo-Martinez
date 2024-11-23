<!DOCTYPE html>
<html>
<head>
    <title>Edit Genre</title>
</head>
<body>
    <h1>Edit Genre</h1>
    <form method="POST" action="/?controller=Genre&method=update">
        <input type="hidden" name="id" value="<?= $genre['ID_GENRE'] ?>">
        
        <label>Genre Name:</label><br>
        <input type="text" name="name" value="<?= $genre['NAME'] ?>" required><br><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
