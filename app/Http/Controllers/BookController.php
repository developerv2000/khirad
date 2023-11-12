<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    // used while generating route names in dashboard
    const MODEL_SHORTCUT = 'books';
    // used while uploading files
    const FILE_PATH = 'books';
    const IMAGE_PATH = 'img/books';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Ҳамаи китобҳо';
        $books = Book::latest()->paginate(30);
        $description = null;

        return view('categories.show', compact('title', 'books', 'description'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        return view('books.show', compact('book'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function read($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $book->views = $book->views + 1;
        $book->save();

        return view('books.read', compact('book'));
    }

        /**
     * Display a listing of the resource in dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        // for search & counting on index pages
        $allItems = Book::select('title', 'id')->orderBy('title')->get();

        // Default parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        // orderby Categories
        if ($orderBy == 'category_titles') {
            $items = Book::selectRaw('group_concat(categories.title order by categories.title asc) as category_titles, books.*')
                ->join('book_category', 'books.id', '=', 'book_category.book_id')
                ->join('categories', 'categories.id', '=', 'book_category.category_id')
                ->groupBy('book_id')
                ->orderBy($orderBy, $orderType)
                ->paginate(30, ['*'], 'page', $activePage)
                ->appends($request->except('page'));
        }

        // orderBy Author names
        else if ($orderBy == 'author_names') {
            $items = Book::selectRaw('group_concat(authors.name order by authors.name asc) as author_names, books.*')
                ->join('author_book', 'books.id', '=', 'author_book.book_id')
                ->join('authors', 'authors.id', '=', 'author_book.author_id')
                ->groupBy('book_id')
                ->orderBy($orderBy, $orderType)
                ->paginate(30, ['*'], 'page', $activePage)
                ->appends($request->except('page'));
        }

        else {
            $items = Book::orderBy($orderBy, $orderType)
                ->paginate(30, ['*'], 'page', $activePage)
                ->appends($request->except('page'));
        }

        return view('dashboard.books.index', compact('modelShortcut', 'allItems', 'items', 'orderBy', 'orderType', 'activePage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        $authors = Author::orderBy('name', 'asc')->select('name', 'id')->get();
        $categories = Category::orderBy('title', 'asc')->select('title', 'id')->get();

        return view('dashboard.books.create', compact('modelShortcut', 'authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $validationRules = [
            'title' => [
                'required',
                Rule::unique('books'),
            ],
        ];

        $validationMessages = [
            "title.unique" => "Книга с таким заголовком уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        // store item
        $book = new Book();
        $fields = ['title', 'description', 'price', 'publisher', 'publish_year', 'pages', 'most_readable'];
        Helper::fillModelColumns($book, $fields, $request);
        $book->slug = Helper::generateUniqueSlug($request->title, Book::class);

        // upload files
        Helper::uploadModelsFile($request, $book, 'image', $book->slug, self::IMAGE_PATH, 600);
        Helper::createThumbs(self::IMAGE_PATH, $book->image, 240, 336);
        Helper::uploadModelsFile($request, $book, 'filename', $book->slug, self::FILE_PATH);

        $book->save();

        $book->categories()->attach($request->categories);
        $book->authors()->attach($request->authors);

        return redirect()->route('dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        $item = Book::find($id);
        $authors = Author::orderBy('name', 'asc')->select('name', 'id')->get();
        $categories = Category::orderBy('title', 'asc')->select('title', 'id')->get();

        return view('dashboard.books.edit', compact('modelShortcut', 'item', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::find($request->id);

        // validate request
        $validationRules = [
            'title' => [
                'required',
                Rule::unique('books')->ignore($book->id),
            ],
        ];

        $validationMessages = [
            "title.unique" => "Книга с таким заголовком уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        $fields = ['title', 'description', 'price', 'publisher', 'publish_year', 'pages', 'most_readable'];
        Helper::fillModelColumns($book, $fields, $request);
        $book->slug = Helper::generateUniqueSlug($request->title, Book::class, $book->id);

        // upload files
        Helper::uploadModelsFile($request, $book, 'image', $book->slug, self::IMAGE_PATH, 600);
        if($request->file('image')) {
            Helper::createThumbs(self::IMAGE_PATH, $book->image, 240, 336);
        }
        Helper::uploadModelsFile($request, $book, 'filename', $book->slug, self::FILE_PATH);

        $book->save();

        // reattach manyToMany relations
        $book->categories()->detach();
        $book->categories()->attach($request->categories);

        $book->authors()->detach();
        $book->authors()->attach($request->authors);

        return redirect()->back();
    }

    /**
     * Request for deleting items by id may come in integer type (single item destroy form)
     * or in array type (multiple item destroy form)
     * That`s why we need to get them in array type and delete them by loop
     *
     * Checkout Model Boot methods deleting function
     * Models relations also deleted on deleting function of Models Boot method
     *
     * @param  int/array  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = (array) $request->id;

        foreach($ids as $id) {
            Book::find($id)->delete();
        }

        return redirect()->route('dashboard.index');
    }
}
