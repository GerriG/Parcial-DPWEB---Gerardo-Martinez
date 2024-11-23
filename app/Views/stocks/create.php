<!DOCTYPE html>
<html>
<head>
    <title>Create Stock</title>
</head>
<body>
    <h1>Create Stock</h1>
    <form method="POST" action="/?controller=Stock&method=store">
        <label>Book ID:</label><br>
        <input type="number" name="book_id" required><br><br>
        
        <label>Total Stock:</label><br>
        <input type="number" name="total_stock" required><br><br>
        
        <label>Notes:</label><br>
        <textarea name="notes"></textarea><br><br>
        
        <button type="submit">Save</button>
    </form>
</body>
</html>
