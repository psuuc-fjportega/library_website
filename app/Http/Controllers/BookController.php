<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Book::class);

        $books = Book::query()
            ->with('category')
            ->when($request->filled('title'), fn ($q) => $q->where('title', 'like', '%'.$request->string('title')->toString().'%'))
            ->when($request->filled('author'), fn ($q) => $q->where('author', 'like', '%'.$request->string('author')->toString().'%'))
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->integer('category_id')))
            ->when($request->string('availability')->toString() === 'available', fn ($q) => $q->where('available_quantity', '>', 0))
            ->orderBy('title')
            ->paginate(15)
            ->withQueryString();

        return view('books.index', [
            'books' => $books,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Book::class);

        return view('books.create', [
            'book' => new Book(['total_quantity' => 1, 'available_quantity' => 1]),
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['available_quantity'] = $data['total_quantity'];
        Book::create($data);

        return redirect()->route('books.index')
            ->with('status', __('Book added successfully.'));
    }

    public function show(Book $book): View
    {
        $this->authorize('view', $book);
        $book->load('category');

        return view('books.show', ['book' => $book]);
    }

    public function edit(Book $book): View
    {
        $this->authorize('update', $book);

        return view('books.edit', [
            'book' => $book,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('books.index')
            ->with('status', __('Book updated successfully.'));
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index')
            ->with('status', __('Book deleted successfully.'));
    }
}
