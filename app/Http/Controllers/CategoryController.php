<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // used while generating route names in dashboard
    const MODEL_SHORTCUT = 'categories';

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $title = $category->title;
        $books = $category->books()->paginate(30);
        $description = $category->description;

        return view('categories.show', compact('title', 'books', 'description'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function worldMostReadable()
    {
        $title = 'Серхондатарин китобҳои ҷаҳон';
        $books = Book::where('most_readable', true)->paginate(30);
        $description = null;

        return view('categories.show', compact('title', 'books', 'description'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function topBooks()
    {
        $title = 'Серхондатарин китобҳои сомона';
        $books = Book::orderBy('views', 'desc')->paginate(30);
        $description = null;

        return view('categories.show', compact('title', 'books', 'description'));
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
        $allItems = Category::select('title', 'id')->orderBy('title')->get();

        // Default parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $items = Category::orderBy($orderBy, $orderType)
            ->withCount('books')
            ->paginate(30, ['*'], 'page', $activePage)
            ->appends($request->except('page'));

        return view('dashboard.categories.index', compact('modelShortcut', 'allItems', 'items', 'orderBy', 'orderType', 'activePage'));
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

        return view('dashboard.categories.create', compact('modelShortcut'));
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
                Rule::unique('categories'),
            ],
        ];

        $validationMessages = [
            "title.unique" => "Категория с таким заголовком уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        // store
        $category = new Category();
        $fields = ['title', 'description'];
        Helper::fillModelColumns($category, $fields, $request);
        $category->slug = Helper::generateUniqueSlug($request->title, Category::class);

        $category->save();

        return redirect()->route('categories.dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        $item = Category::find($id);

        return view('dashboard.categories.edit', compact('modelShortcut', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);

        // validate request
        $validationRules = [
            'title' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ],
        ];

        $validationMessages = [
            "title.unique" => "Категория с таким заголовком уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        // update 
        $fields = ['title', 'description'];
        Helper::fillModelColumns($category, $fields, $request);
        $category->slug = Helper::generateUniqueSlug($request->title, Category::class, $category->id);

        $category->save();

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

        foreach ($ids as $id) {
            Category::find($id)->delete();
        }

        return redirect()->route('categories.dashboard.index');
    }
}
