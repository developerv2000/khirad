<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    // used while generating route names in dashboard
    const MODEL_SHORTCUT = 'authors';
    // used while uploading files
    const IMAGE_PATH = 'img/authors';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // used in search & filter by letter
        $allAuthors = Author::orderBy('name')->select('name', 'slug', 'popular')->get();
        if($request->popular) {
            $allAuthors = $allAuthors->where('popular', true);
        }

        // filter by letter
        $filterLetters = [];

        // get all letters
        foreach($allAuthors as $author) {
            array_push($filterLetters, mb_substr($author->name, 0, 1));
        }

        // remove duplicates letters
        $filterLetters = array_unique($filterLetters);

        // paginate authors due to request
        $authors = Author::orderBy('foreign')->orderBy('name');

        // filter popular
        $popular = $request->popular;
        if($popular) {
            $authors = $authors->where('popular', true);
        }

        // filter by letter
        $activeLetter = $request->letter;
        if($activeLetter) {
            $authors = $authors->where('name', 'LIKE', $activeLetter . '%');
        }

        $authors = $authors->paginate(30)->appends($request->except('page'));

        // generate page title
        $title = $popular ? 'Муаллифони машҳур' : 'Муаллифон';

        return view('authors.index', compact('allAuthors', 'authors', 'filterLetters', 'activeLetter', 'popular', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();

        return view('authors.show', compact('author'));
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
        $allItems = Author::select('name as title', 'id')->orderBy('title')->get();

        // Default parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'name';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $items = Author::orderBy($orderBy, $orderType)
                ->withCount('books')
                ->paginate(30, ['*'], 'page', $activePage)
                ->appends($request->except('page'));

        return view('dashboard.authors.index', compact('modelShortcut', 'allItems', 'items', 'orderBy', 'orderType', 'activePage'));
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

        return view('dashboard.authors.create', compact('modelShortcut'));
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
            'name' => [
                'required',
                Rule::unique('authors'),
            ],
        ];

        $validationMessages = [
            "name.unique" => "Автор с таким названием уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        // store
        $author = new Author();
        $fields = ['name', 'biography', 'popular', 'foreign'];
        Helper::fillModelColumns($author, $fields, $request);
        $author->slug = Helper::generateUniqueSlug($request->name, Author::class);

        Helper::uploadModelsFile($request, $author, 'image', $author->slug, self::IMAGE_PATH, 600);
        Helper::createThumbs(self::IMAGE_PATH, $author->image, 240, 282);

        $author->save();

        return redirect()->route('authors.dashboard.index');
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

        $item = Author::find($id);

        return view('dashboard.authors.edit', compact('modelShortcut', 'item'));
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
        $author = Author::find($request->id);

        // validate request
        $validationRules = [
            'name' => [
                'required',
                Rule::unique('authors')->ignore($author->id),
            ],
        ];

        $validationMessages = [
            "name.unique" => "Автор с таким названием уже существует !",
        ];

        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        // update
        $fields = ['name', 'biography', 'popular', 'foreign'];
        Helper::fillModelColumns($author, $fields, $request);
        $author->slug = Helper::generateUniqueSlug($request->name, Author::class, $author->id);

        Helper::uploadModelsFile($request, $author, 'image', $author->slug, self::IMAGE_PATH, 600);
        if($request->file('image')) {
            Helper::createThumbs(self::IMAGE_PATH, $author->image, 240, 282);
        }

        $author->save();

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
            Author::find($id)->delete();
        }
        
        return redirect()->route('authors.dashboard.index');
    }
}
