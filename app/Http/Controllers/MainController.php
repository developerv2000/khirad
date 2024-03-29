<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $mostReadableBooks = Book::where('most_readable', true)->inRandomOrder()->get();
        $recommendedBooks = Book::where('most_readable', false)->inRandomOrder()->take(7)->get();
        $topBooks = Book::orderBy('views', 'desc')->take(5)->get();
        $latestBooks = Book::latest()->take(15)->get();

        return view('home.index', compact('mostReadableBooks', 'latestBooks', 'recommendedBooks', 'topBooks'));
    }

    public function contacts()
    {
        return view('contacts.index');
    }

    public function faq()
    {
        return view('faq.index');
    }

    public function search(Request $request)
    {
        $books = Book::query();

        // filter by keyword
        $keyword = $request->keyword;
        if ($keyword && $keyword != '') {
            $books = $books->whereHas('authors', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })

                ->orWhere(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhere('publisher', 'LIKE', "%{$keyword}%");
                });
        }

        // filter by category
        $category_id = $request->category_id;
        if ($category_id && $category_id != 'all') {
            $books = $books->whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        // filter by publish year
        $publishYear = $request->publish_year;
        if ($publishYear && $publishYear != 'all') {
            $books = $books->where('publish_year', $publishYear);
        }

        $booksCount = $books->count();
        $books = $books->paginate(30);

        return view('search.index', compact('books', 'booksCount', 'keyword'));
    }

    public function feedback(Request $request)
    {
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $remoteIp = $request->ip();

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $remoteIp,
        ]);

        $responseData = $response->json();

        if ($responseData['success'] && $responseData['score'] >= 0.5) {
            Mail::to('info@khirad.tj')->send(new Feedback($request));
        }

        return redirect()->back();
    }

    public function successPayment(Request $request)
    {
        return view('success-payment.index');
    }

    public function appPrivacyPolicy()
    {
        return view('app.privacy-policy');
    }

    public function appPrivacyPolicyFile()
    {
        $filePath = public_path('app/Политика конфиденциальности.docx');

        return response()->download($filePath);
    }
}
