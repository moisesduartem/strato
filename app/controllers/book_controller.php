<?php
declare(strict_types=1);

namespace app\controllers\book_controller;
use function config\request\request;

function index()
{
    //... show all books
}

function create()
{
    //... show a form to create a new book
}

function store()
{
    //... insert book on database
}

function show($id)
{
    //... show book
}

function edit($id)
{
    //... show view with a form to edit book
    // return [];
}

function update($id)
{
    //... update book from database
}

function destroy($id)
{
    //... delete book from database
}