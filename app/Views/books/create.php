<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Libro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .form-container h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555555;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007BFF;
            color: #ffffff;
            font-size: 16px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            margin-top: 15px;
            display: inline-block;
            color: #007BFF;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            input, textarea, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Crear Libro</h1>
        <form method="POST" action="../public/index.php?controller=Book&method=create">
            <label for="title">Titulo:</label>
            <input type="text" name="title" id="title" placeholder="Enter book title" required>

            <label for="description">Descripcion:</label>
            <textarea name="description" id="description" placeholder="Enter book description" required></textarea>

            <label for="year_publication">Año de publicacion:</label>
            <input type="number" name="year_publication" id="year_publication" min="1000" max="9999" placeholder="Enter year" required>

            <label for="id_author">ID Autor:</label>
            <input type="number" name="id_author" id="id_author" placeholder="Enter author ID" required>

            <label for="id_genre">ID Genero:</label>
            <input type="number" name="id_genre" id="id_genre" placeholder="Enter genre ID" required>

            <button type="submit">Save</button>
        </form>
        <a href="../Views/books/index.php" class="back-link">Regresar a Libros</a>
    </div>
</body>
</html>



