<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\books;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = books::with('author')
        ->latest()
        ->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $author = Author::orderBy('name')->get();

        return view('books.index', compact('author'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'author_id'=> 'required|exists:author,id',
            'title'=>'required|strig|max:255',
            'publication_date'=> 'required|string|max:255',
        ]);

        books::create($datos);

        return redirect()->route('books.index')->with('success','libro registrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(books $books)
    {
        return redirect()->route('books.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(books $books)
    {
        $authors = Author::orderBy('name')->get();
        return view('books.form', compact('books','authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, books $books)
    {
        $datos = $request->validate([
            'author_id'=>'required|exists:authors,id',
            'title'=> 'required|string|max:255',
            'pueblication_date'=>'required|date',
        ]);

        $books->update($datos);

        return redirect()->route('books.index')->with('success','actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(books $books)
    {
        $books->delete();

        return redirect()->route('books.index')->with('Success','libro eliminado');
    }

    public function byAuthor(Author $author)
    {
        $books = $author->books()
        ->orderByDesc('publication_date')
        ->get();
    }
}
