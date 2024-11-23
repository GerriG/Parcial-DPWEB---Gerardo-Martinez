<!DOCTYPE html>
<html>
<head>
    <title>Create Genre</title>
</head>
<body>
    <h1>Create Genre</h1>
    <form method="POST" action="/?controller=Genre&method=store">
        <label>Genre Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <button type="submit">Save</button>
    </form>
</body>
</html>
