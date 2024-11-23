<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 40px;
            font-size: 2rem;
        }

        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #444;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 14px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            width: 48%;
            transition: background-color 0.3s ease;
        }

                /* Updated button styles to make both buttons the same size */
        button, .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 14px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            width: 48%; /* This makes them equal in size */
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        button:hover, .back-button:hover {
            background-color: #45a049;
        }

        /* Specific styles for the back button to change its background */
        .back-button {
            background-color: #007BFF;
        }

        .back-button:hover {
            background-color: #0056b3;
        }


        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .error-message {
            color: #d9534f;
            background-color: #f2dede;
            padding: 15px;
            border: 1px solid #ebccd1;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Responsiveness for smaller screens */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .button-container {
                flex-direction: column;
                align-items: center;
            }

            button, .back-button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Editar Libro</h1>
    <div class="form-container">
        <?php if (isset($errorMessage)) { ?>
            <div class="error-message"><?= $errorMessage; ?></div>
        <?php } ?>
        <form method="POST" action="../public/index.php?controller=Book&method=update&id=<?php echo $book['ID_BOOK']; ?>">
            <input type="hidden" name="id" value="<?php echo $book['ID_BOOK']; ?>" />
            
            <label for="title">Titulo:</label>
            <input type="text" id="title" name="title" value="<?= $book['TITLE'] ?>" required>
            
            <label for="description">Descripcion:</label>
            <textarea id="description" name="description" required><?= $book['DESCRIPTION'] ?></textarea>
            
            <label for="year_publication">Año de publicacion:</label>
            <input type="number" id="year_publication" name="year_publication" value="<?= $book['YEAR_PUBLICATION'] ?>" required>
            
            <label for="id_author">ID Autor:</label>
            <input type="number" id="id_author" name="id_author" value="<?= $book['ID_AUTHOR'] ?>" required>
            
            <label for="id_genre">ID Genero:</label>
            <input type="number" id="id_genre" name="id_genre" value="<?= $book['ID_GENRE'] ?>" required>
            
            <div class="button-container">
                <button type="submit">Actualizar</button>
                <a href="../Views/books/index.php" class="back-button">Regresar a Libros</a>
            </div>
        </form>
    </div>    
</body>
</html>




