<!DOCTYPE html>
<html>
<head>
    <title>Editar Autor</title>
</head>
<body>
    <h1>Editar Autor</h1>
    <form method="POST" action="/?controller=Author&method=update">
        <input type="hidden" name="id" value="<?= $author['ID_AUTHOR'] ?>">
        
        <label>Nombre completo:</label><br>
        <input type="text" name="name" value="<?= $author['FULL_NAME'] ?>" required><br><br>
        
        <label>Fecha de nacimiento:</label><br>
        <input type="date" name="birth_date" value="<?= $author['DATE_OF_BIRTH'] ?>" required><br><br>
        
        <label>Fecha de muerte (opcional):</label><br>
        <input type="date" name="death_date" value="<?= $author['DATE_OF_DEATH'] ?>"><br><br>
        
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
