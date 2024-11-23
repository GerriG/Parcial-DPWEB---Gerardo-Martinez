<?php
require_once "../models/Author.php"; // Incluir el modelo de Author

class AuthorController {
    private $author;

    public function __construct() {
        $this->author = new Author(); // Instanciamos el modelo de Author
    }

    // Método para mostrar la lista de autores
    public function index() {
        $authors = $this->author->getAllAuthors(); // Obtener todos los autores
        require_once "../Views/authors/index.php"; // Pasar la lista de autores a la vista
    }

    // Método para mostrar el formulario de creación de un autor
    public function create() {
        require_once "../Views/authors/create.php"; // Mostrar formulario de creación
    }

    // Método para guardar un nuevo autor en la base de datos
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar que todos los campos requeridos estén presentes
            if (isset($_POST['name'], $_POST['biography'])) {
                $name = trim($_POST['name']);
                $biography = trim($_POST['biography']);
    
                // Validación simple de los campos
                if (empty($name) || empty($biography)) {
                    echo "Todos los campos son obligatorios.";
                    return;
                }
    
                // Crear el autor en la base de datos
                if ($this->author->createAuthor($name, $biography)) {
                    // Redirigir a la lista de autores
                    header("Location: /?controller=Author&method=index");
                    exit();
                } else {
                    echo "Error creating the author. Please try again.";
                }
            } else {
                echo "Faltan datos necesarios. Por favor, complete todos los campos.";
            }
        } else {
            require_once "../Views/authors/create.php"; // Mostrar formulario de creación
        }
    }

    // Método para ver los detalles de un autor
    public function view($id) {
        // Depuración: Verifica el valor de $_GET['id']
        var_dump($_GET); // Esto te mostrará todos los parámetros GET recibidos
        var_dump($id); // Verifica el valor de $id como parámetro de la función
    
        // Verifica si 'id' está presente y es válido
        if (empty($id) || !is_numeric($id)) {
            echo "ID inválido.";
            return;
        }
    
        // Llamar al método de la base de datos para obtener el autor
        $author = $this->author->getAuthorById($id); 
    
        if ($author) {
            require_once "../Views/authors/view.php"; // Mostrar detalles del autor
        } else {
            echo "El autor con ID $id no existe o no se pudo recuperar.";
        }
    }
    
    

    // Método para mostrar el formulario de edición de un autor
    public function edit($id) {
        $author = $this->author->getAuthorById($id); // Obtener autor por ID
        if ($author) {
            require_once "../Views/authors/edit.php"; // Mostrar formulario de edición
        } else {
            echo "El autor con ID $id no existe o no se pudo recuperar.";
        }
    }

    // Método para actualizar un autor existente
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $name = trim($_POST['name']);
            $biography = trim($_POST['biography']);
    
            // Validación de los campos
            if (empty($name) || empty($biography)) {
                echo "Todos los campos son obligatorios.";
                return;
            }
    
            // Actualizar el autor en la base de datos
            if ($this->author->updateAuthor($id, $name, $biography)) {
                // Redirigir a la lista de autores después de la actualización
                header("Location: /?controller=Author&method=index");
                exit(); // Detener la ejecución
            } else {
                echo "Error updating the author. Please try again.";
            }
        } else {
            // Obtener el autor para editar
            $author = $this->author->getAuthorById($id);
            require_once "../Views/authors/edit.php"; // Mostrar formulario de edición
        }
    }

    // Método para eliminar un autor
    public function delete($id) {
        try {
            if ($this->author->deleteAuthor($id)) {
                // Redirigir a la lista de autores
                header("Location: /?controller=Author&method=index");
                exit();
            } else {
                echo "Error deleting the author. Please try again.";
            }
        } catch (PDOException $e) {
            // Si el error es por la clave foránea, mostrar un mensaje amigable
            if ($e->getCode() == 23000) {
                // Error por restricción de clave foránea (foreign key constraint)
                echo "<div class='error-message'>No se puede eliminar este autor porque está siendo utilizado en otras tablas.</div>";
            } else {
                // Otros tipos de error
                echo "<div class='error-message'>Error al eliminar el autor: " . $e->getMessage() . "</div>";
            }
        }
    }
}

?>


