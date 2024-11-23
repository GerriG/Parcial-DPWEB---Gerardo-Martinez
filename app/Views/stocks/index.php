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

// Consulta para obtener el stock
$query = "SELECT * FROM stock";
$stmt = $conn->prepare($query);
$stmt->execute();
$stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
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

        /* Botón Regresar al Menú - alineado a la izquierda */
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

        /* Botón Añadir nuevo stock - alineado a la derecha */
        .add-stock {
            text-align: right;
            margin-bottom: 20px;
        }

        .add-stock a {
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

        .add-stock a:hover {
            background-color: #218838;
        }

        /* Tabla de stocks */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        /* Mensaje cuando no hay stocks */
        .no-stocks {
            text-align: center;
            color: #888;
            font-size: 18px;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Diseño responsivo */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            .add-stock a, .back-to-menu a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Stocks</h1>
</header>

<div class="container">
    <!-- Botón "Regresar al Menú" alineado a la izquierda -->
    <div class="back-to-menu">
        <a href="../index/index.php">Regresar al Menú</a>
    </div>

    <!-- Botón para añadir nuevo stock alineado a la derecha -->
    <div class="add-stock">
        <a href="../../Controllers/StockController.php?action=create">+ Add New Stock</a>
    </div>

    <!-- Tabla de stocks -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Book ID</th>
                <th>Total Stock</th>
                <th>Notes</th>
                <th>Last Inventory</th>
                <th>Actions</th> <!-- Columna de acciones -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($stocks)): ?>
                <?php foreach ($stocks as $stock): ?>
                    <tr>
                        <td><?= htmlspecialchars($stock['ID_STOCK']) ?></td>
                        <td><?= htmlspecialchars($stock['ID_BOOK']) ?></td>
                        <td><?= htmlspecialchars($stock['TOTAL_STOCK']) ?></td>
                        <td><?= htmlspecialchars($stock['NOTES']) ?></td>
                        <td><?= htmlspecialchars($stock['LAST_INVENTORY']) ?></td>
                        <td>
                            <a href="../../Controllers/StockController.php?action=view&id=<?= $stock['ID_STOCK']; ?>">View</a> |
                            <a href="../../Controllers/StockController.php?action=update&id=<?= $stock['ID_STOCK']; ?>">Edit</a> |
                            <a href="../../Controllers/StockController.php?action=delete&id=<?= $stock['ID_STOCK']; ?>" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-stocks">No stocks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>


