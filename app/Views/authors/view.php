<?php
// Asegurarnos de que la variable $author esté definida
if (isset($author)): ?>
    <div class="container">
        <h1>Detalles del Autor: <?= htmlspecialchars($author['name']) ?></h1>
        
        <!-- Mostrar los detalles del autor -->
        <table>
            <tr>
                <th>Nombre</th>
                <td><?= htmlspecialchars($author['name']) ?></td>
            </tr>
            <tr>
                <th>Biografía</th>
                <td><?= nl2br(htmlspecialchars($author['biography'])) ?></td>
            </tr>
        </table>
        
        <!-- Enlaces para editar o eliminar -->
        <div class="actions">
            <a href="/?controller=Author&method=edit&id=<?= htmlspecialchars($author['id']) ?>" class="btn-edit">Editar</a>
            <a href="/?controller=Author&method=delete&id=<?= htmlspecialchars($author['id']) ?>" class="btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este autor?')">Eliminar</a>
            <a href="/?controller=Author&method=index" class="btn-back">Volver a la lista de autores</a>
        </div>
    </div>

<?php else: ?>
    <p>El autor solicitado no existe o no se pudo recuperar.</p>
<?php endif; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
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
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 900px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    .actions {
        margin-top: 20px;
        text-align: center;
    }

    .actions a {
        display: inline-block;
        margin: 5px;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        color: white;
        font-weight: bold;
    }

    .btn-edit {
        background-color: #28a745;
    }

    .btn-edit:hover {
        background-color: #218838;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-back {
        background-color: #007bff;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }
</style>
