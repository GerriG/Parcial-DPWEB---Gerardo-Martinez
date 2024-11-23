<?php
require_once "app/Models/Genre.php";

class GenreController {
    public function index() {
        $genreModel = new Genre();
        $genres = $genreModel->getAllGenres();
        require "app/Views/genres/index.php";
    }

    public function create() {
        require "app/Views/genres/create.php";
    }

    public function store($request) {
        $genreModel = new Genre();
        $genreModel->createGenre($request);
        header("Location: /?controller=Genre&method=index");
    }

    public function edit($id) {
        $genreModel = new Genre();
        $genre = $genreModel->findGenreById($id);
        require "app/Views/genres/edit.php";
    }

    public function update($request) {
        $genreModel = new Genre();
        $genreModel->updateGenre($request);
        header("Location: /?controller=Genre&method=index");
    }

    public function delete($id) {
        $genreModel = new Genre();
        $genreModel->deleteGenre($id);
        header("Location: /?controller=Genre&method=index");
    }
}
