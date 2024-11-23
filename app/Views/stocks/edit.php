<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock</title>
</head>
<body>
    <h1>Edit Stock</h1>
    <form method="POST" action="/?controller=Stock&method=update">
        <input type="hidden" name="id" value="<?= $stock['ID_STOCK'] ?>">
        
        <label>Book ID:</label><br>
        <input type="number" name="book_id" value="<?= $stock['ID_BOOK'] ?>" required><br><br>
        
        <label>Total Stock:</label><br>
        <input type="number" name="total_stock" value="<?= $stock['TOTAL_STOCK'] ?>" required><br><br>
        
        <label>Notes:</label><br>
        <textarea name="notes"><?= $stock['NOTES'] ?></textarea><br><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
