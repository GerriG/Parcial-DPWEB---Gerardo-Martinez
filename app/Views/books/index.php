<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de libros</title>

    <!-- ESTILOS -->
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #007BFF;
        padding: 20px;
        color: #fff;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    header h1 {
        margin: 0;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    /* Regresar al Menú button - aligned to the right */
    .back-to-menu {
        text-align: left;
        margin-bottom: -50px;        
    }

    .back-to-menu a {
        display: inline-block;
        padding: 14px 20px;
        background-color: #007BFF;
        color: white;
        text-decoration: none;
        font-size: 18px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .back-to-menu a:hover {
        background-color: #0056b3;
    }

    /* Add New Book button - aligned to the left */
    .add-book {
        text-align: right;
        margin-bottom: 20px;
    }

    .add-book a {
        display: inline-block;
        padding: 14px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
    }

    .add-book a:hover {
        background-color: #218838;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td a {
        color: #007BFF;
        text-decoration: none;
        font-weight: bold;
    }

    td a:hover {
        color: #0056b3;
    }

    /* Styling for no books found message */
    .no-books {
        text-align: center;
        color: #888;
        font-size: 18px;
        padding: 20px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        th, td {
            padding: 8px;
        }

        .add-book a, .back-to-menu a {
            font-size: 14px;
            padding: 8px 16px;
        }
    }

    </style>
</head>

<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$db_name = 'biblioteca';
$username = 'root';
$password = '';

// Crear la conexión
try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
    exit;
}

// Consultar los libros desde la base de datos
$query = "SELECT b.ID_BOOK, b.TITLE, b.DESCRIPTION, b.YEAR_PUBLICATION, 
                 a.FULL_NAME AS AUTHOR, g.NAME AS GENRE
          FROM book b
          INNER JOIN author a ON b.ID_AUTHOR = a.ID_AUTHOR
          INNER JOIN genre g ON b.ID_GENRE = g.ID_GENRE
          ORDER BY b.ID_BOOK ASC";

// Ejecutar la consulta y obtener los resultados
$stmt = $conn->prepare($query);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <header>
        <h1>Lista de Libros</h1>
    </header>
    <div class="container">
        <!-- "Regresar al Menú" button to be displayed on the right side -->
        <div class="back-to-menu">
            <a href="../index/index.php">Regresar al Menú</a>
        </div>

        <div class="add-book">
            <a href="../../Controllers/BookController.php?action=create">+ Agregar Libro</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Año</th>
                    <th>Autor</th>
                    <th>Genero</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['ID_BOOK']); ?></td>
                            <td><?= htmlspecialchars($book['TITLE']); ?></td>
                            <td><?= htmlspecialchars($book['DESCRIPTION']); ?></td>
                            <td><?= htmlspecialchars($book['YEAR_PUBLICATION']); ?></td>
                            <td><?= htmlspecialchars($book['AUTHOR']); ?></td>
                            <td><?= htmlspecialchars($book['GENRE']); ?></td>
                            <td>
                                <a href="../../Controllers/BookController.php?action=view&id=<?= $book['ID_BOOK']; ?>">Ver</a> |
                                <a href="../../Controllers/BookController.php?action=update&id=<?= $book['ID_BOOK']; ?>">Editar</a> |
                                <a href="../../Controllers/BookController.php?action=delete&id=<?= $book['ID_BOOK']; ?>" onclick="return confirm('Are you sure you want to delete this book?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="no-books">No se encontraron libros en la BD.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>









