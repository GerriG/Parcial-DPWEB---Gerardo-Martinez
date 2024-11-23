<!DOCTYPE html>
<html>
<head>
    <title>Crear Autor</title>
</head>
<body>
    <h1>Crear Autor</h1>
    <form method="POST" action="/?controller=Author&method=store">
        <label>Nombre completo:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Fecha de nacimiento:</label><br>
        <input type="date" name="birth_date" required><br><br>
        
        <label>Fecha de muerte (opcional):</label><br>
        <input type="date" name="death_date"><br><br>
        
        <button type="submit">Save</button>
    </form>
</body>
</html>
