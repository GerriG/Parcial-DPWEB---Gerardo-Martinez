<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de la BD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        h1 {
            color: #007BFF;
            font-size: 2em;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        footer {
            margin-top: 40px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bienvenido al CRUD de la Base de Datos</h1>
    <ul>
        <li><a href="../books">Ver libros</a></li>
        <li><a href="../authors">Ver autores</a></li>
        <li><a href="../genres">Ver géneros</a></li>
        <li><a href="../stocks">Ver stock</a></li>
    </ul>
    <footer>
        <p>&copy; 2024 CRUD de Base de Datos. Todos los derechos reservados.</p>
    </footer>
</div>

</body>
</html>
