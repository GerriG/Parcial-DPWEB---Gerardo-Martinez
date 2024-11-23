<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .book-details {
            background-color: #ffffff;
            max-width: 600px;
            width: 100%;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .book-details h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .book-details p {
            margin: 10px 0;
            line-height: 1.6;
            color: #555;
        }

        .label {
            font-weight: bold;
            color: #007BFF;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .actions a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007BFF;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #0056b3;
        }

        .actions a.back {
            background-color: #6c757d;
        }

        .actions a.back:hover {
            background-color: #495057;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .book-details {
                padding: 20px;
            }

            .actions a {
                flex-grow: 1;
                text-align: center;
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="book-details">
            <h1>Detalles del Libro</h1>
            <?php if (isset($book)) : ?>
                <p><span class="label">Título:</span> <?= htmlspecialchars($book['TITLE']) ?></p>
                <p><span class="label">Descripción:</span> <?= htmlspecialchars($book['DESCRIPTION']) ?></p>
                <p><span class="label">Año de Publicación:</span> <?= htmlspecialchars($book['YEAR_PUBLICATION']) ?></p>
                <p><span class="label">Autor:</span> <?= htmlspecialchars($book['AUTHOR']) ?></p>
                <p><span class="label">Género:</span> <?= htmlspecialchars($book['GENRE']) ?></p>
            <?php else : ?>
                <p>No se encontraron detalles para este libro.</p>
            <?php endif; ?>

            <div class="actions">
                <a href="../Views/books" class="back">Volver a la lista</a>
                <a href="./../Controllers/BookController.php?action=update&id=<?= $book['ID_BOOK']; ?>">Editar Libro</a>
            </div>
        </div>
    </div>
</body>
</html>

