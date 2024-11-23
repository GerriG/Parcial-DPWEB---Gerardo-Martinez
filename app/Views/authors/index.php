<?php
// Conexión a la base de datos
$host = 'localhost';
$db_name = 'biblioteca';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
    exit;
}

// Consulta para obtener los autores
$query = "SELECT * FROM author";
$stmt = $conn->prepare($query);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
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

        /* Add New Author button - aligned to the left */
        .add-author {
            text-align: right;
            margin-bottom: 20px;
        }

        .add-author a {
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

        .add-author a:hover {
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

        /* Styling for no authors found message */
        .no-authors {
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

            .add-author a, .back-to-menu a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Autores</h1>
</header>

<div class="container">
    <!-- "Regresar al Menú" button to be displayed on the right side -->
    <div class="back-to-menu">
        <a href="../index/index.php">Regresar al Menú</a>
    </div>

    <div class="add-author">
        <a href="../../Controllers/AuthorController.php?action=create">+ Agregar Autor</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de nacimiento</th>
                <th>Fecha de muerte</th>
                <th>Acciones</th> <!-- Added Actions Column -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($authors)): ?>
                <?php foreach ($authors as $author): ?>
                    <tr>
                        <td><?= htmlspecialchars($author['ID_AUTHOR']) ?></td>
                        <td><?= htmlspecialchars($author['FULL_NAME']) ?></td>
                        <td><?= htmlspecialchars($author['DATE_OF_BIRTH']) ?></td>
                        <td><?= htmlspecialchars($author['DATE_OF_DEATH']) ?></td>
                        <td>
                            <a href="../../public/index.php?controller=Author&method=view&id=1">View</a>                       |
                            <a href="../../Controllers/AuthorController.php?action=update&id=<?= $author['ID_AUTHOR']; ?>">Edit</a> |
                            <a href="../../Controllers/AuthorController.php?action=delete&id=<?= $author['ID_AUTHOR']; ?>" onclick="return confirm('Are you sure you want to delete this author?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="no-authors">No se encontraron autores en la BD.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
