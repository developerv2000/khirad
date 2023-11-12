<?php

/**
 * Custom Helper class
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

namespace App\Helpers;

use Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Helper
{
    /**
     * remove tags, replace many spaces by one, remove first whitespace
     * cut string if length givven
     * and return clean text
     * used while sharing in socials/messangers
     * 
     * @param string $string
     * @param integer $length
     * @return string
     */
    public static function cleanText($string, $length = null)
    {
        $cleaned = preg_replace('#<[^>]+>#', ' ', $string); //remove tags
        $cleaned = str_replace('&nbsp;', ' ', $cleaned); //decode space
        if ($length) {
            $cleaned = mb_strlen($cleaned) < $length ? $cleaned : mb_substr($cleaned, 0, ($length - 4)) . '...'; //cut length
        }
        $cleaned = preg_replace('!\s+!', ' ', $cleaned); //many spaces into one
        $cleaned = trim($cleaned); //remove whitespaces

        return $cleaned;
    }

    /**
     * remove tags, slice body, replace many spaces by one, remove first whitespace
     * and return clean text
     * used while sharing in socials/messangers
     * 
     * @param string $string
     * @return string
     */
    public static function generateShareText($string)
    {
        $cleaned = preg_replace('#<[^>]+>#', ' ', $string); //remove tags
        $cleaned = str_replace('&nbsp;', ' ', $cleaned); //decode space
        $cleaned = mb_strlen($cleaned) < 170 ? $cleaned : mb_substr($cleaned, 0, 166) . '...'; //cut length
        $cleaned = preg_replace('!\s+!', ' ', $cleaned); //many spaces into one
        $cleaned = trim($cleaned); //remove whitespaces

        return $cleaned;
    }

    /**
     * Generate unique slug for given model
     *
     * @param string $string Generates slug from this string
     * @param string $model Full namespace of model
     * @param integer $ignoreId ignore slug of a model with a given id (used while updating model)
     * @return string
     */
    public static function generateUniqueSlug($string, $model, $ignoreId = null)
    {
        $cyrilic = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', ' ',
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ',
            '/', '\\', '|', '!', '?', '«', '»', '“', '”', ':'
        ];

        $latin = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shb', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shb', 'a', 'i', 'y', 'e', 'yu', 'ya', '-',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j',
            '', '', '', '', '', '', '', '', '', ''
        ];

        $transilation = str_replace($cyrilic, $latin, $string);
        $slug = strtolower($transilation);

        while ($model::where('slug', $slug)->where('id', '!=', $ignoreId)->first()) {
            $slug = $slug . '-1';
        }

        return $slug;
    }

    /**
     * Upload models file & update models column. Images can be resized after upload 
     * 
     * Resizing (Only Images) works only if width or height is given
     * Image will be croped from the center, If both width and height are given (fit)
     * Else if one of the parameters is given (width or height), another will be calculated auto (aspectRatio)
     *
     * @param \Http\Request $request
     * @param \Eloquent\Model\ $model
     * @param string $column Requested file input name and Models column name
     * @param string $name Name for newly creating file
     * @param string $path Path to store
     * @param integer $width Width for resize
     * @param integer $height Height for resize
     * 
     * @return void
     */
    public static function uploadModelsFile($request, $model, $column, $name, $path, $width = null, $height = null)
    {
        // Any file input maybe nullable on model update
        $file = $request->file($column);
        if ($file) {
            $filename = $name . '.' . $file->getClientOriginalExtension();
            $filename = Helper::renameIfFileAlreadyExists($path, $filename);

            $fullPath = public_path($path);

            $file->move($fullPath, $filename);
            $model[$column] = $filename;

            //resize image
            if ($width || $height) {
                $image = Image::make($fullPath . '/' . $filename);

                // fit
                if ($width && $height) {
                    $image->fit($width, $height, function ($constraint) {
                        $constraint->upsize();
                    }, 'center');

                // aspect ratio
                } else {
                    $image->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                $image->save($fullPath . '/' . $filename);
            }
        }
    }

    /**
     * Make thumb from original and store it in thumbs folder
     * Image will be croped from the center, If both width and height are given (fit)
     * Else if one of the parameters is given (width or height), another will be calculated auto (aspectRatio)
     * Thumbs will be saved in original-path/thumbs folder
     * 
     * Warning
     * To escape errors, thumbs folder must exists in original-path
     *
     * @param string $path Path of original image
     * @param string $filename Name of original image 
     * @param integer $width Width of thumb in pixels
     * @param integer $height Height of thumb in pixels
     * @return void
     */
    public static function createThumbs($path, $filename, $width = 400, $height = null)
    {
        $fullPath = public_path($path);
        $thumb = Image::make($fullPath . '/' . $filename);

        // fit
        if ($width && $height) {
            $thumb->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            }, 'center');

        // aspect ration
        } else {
            $thumb->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $thumb->save($fullPath . '/thumbs//' . $filename);

        return true;
    }

    /**
     * Fill Eloquent Model Items fields from request by loop. Used while storing & updating Eloquent Model item
     * 
     * @param \Http\Request $request
     * @param \Eloquent\Model $model
     * @param array $fields
     * @return void
     */
    public static function fillModelColumns($model, $fields, $request,)
    {
        foreach ($fields as $field) {
            $model[$field] = $request[$field];
        }
    }

    /**
     * Rename file if file with the given name is already exists on the given folder
     * Renaming type => oldName + (1)
     * 
     * @param string $path
     * @param string $filename
     * @return string
     */
    public static function renameIfFileAlreadyExists($path, $filename)
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $fullPath = public_path($path) . '/';

        while (file_exists($fullPath . $filename)) {
            $name = $name . '(1)';
            $filename = $name . '.' . $extension;
        }

        return $filename;
    }

    /**
     * Get all keywords in text and surround them by span with a highlighted class 
     */
    public static function highlightKeyword($keyword, $text)
    {
        return preg_replace("/" . $keyword . "/iu", "<span class='highlighted'>" . $keyword .  "</span>", $text);
    }

    /**
     * Get all keywords in text and surround them by span with a highlighted class 
     */
    public static function reverseOrderType($orderType)
    {
        return $orderType == 'asc' ? 'desc' : 'asc';
    }

    /**
     * Get previous route name
     *
     * @return string Route name
     */
    public static function getPreviousRouteName()
    {
        $previousRequest = app('request')->create(app('url')->previous());

        try {
            $routeName = app('router')->getRoutes()->match($previousRequest)->getName();
        } catch (NotFoundHttpException $exception) {
            return null;
        }

        return $routeName;
    }

    private function fillDBfromOldDB() {
        // copying categories
        Jategories::all()->each(function ($j) {
            $c = new Category();
            $c->id = $j->id;
            $c->title = $j->name;
            if($j->id == 26 || $j->id == 27 || $j->id == 28 || $j->id == 29) {
                $c->description = null;
            } else {
                $c->description = $j->description;
            }
            $c->slug = Helper::generateUniqueSlug($j->name, Category::class);
            $c->save();
        });


        // copying Authors
        Jauthor::where('trashed', false)->orderBy('id')->each(function ($old) {
            $new = new Author();
            $new->id = $old->id;
            $new->name = $old->name;
            $new->slug = Helper::generateUniqueSlug($new->name, Author::class);

            $extension = pathinfo($old->photo, PATHINFO_EXTENSION);
            $newImageName = $new->slug  . '.' . $extension;
            rename(public_path('img/jauthors/' . $old->photo), public_path('img/authors/' . $newImageName));

            $new->image = $newImageName;
            $new->biography = $old->biography;
            $new->foreign = $old->foreign;
            $new->popular = $old->popular;

            $new->save();
        });

        // copying books
        Jook::where('trashed', false)->orderBy('id')->each(function ($old) {
            $new = new Book();
            $new->id = $old->id;
            $new->title = $old->name;
            $new->slug = Helper::generateUniqueSlug($new->title, Book::class);

            $extension = pathinfo($old->filename, PATHINFO_EXTENSION);
            $newFileName = $new->slug  . '.' . $extension;
            copy(public_path('jooks/' . $old->filename), public_path('books/' . $newFileName));

            $new->filename = $newFileName;

            $extension = pathinfo($old->photo, PATHINFO_EXTENSION);
            $newImageName = $new->slug  . '.' . $extension;
            copy(public_path('img/jooks/' . $old->photo), public_path('img/books/' . $newImageName));

            $new->image = $newImageName;
            if($old->free || $old->price < 1) {
                $new->price = 0;
            } else {
                $new->price = intval($old->price);
            }
            $new->description = $old->description;
            $new->publisher = $old->publisher;
            $new->publish_year = $old->year;
            $new->pages = $old->pages;
            $new->views = $old->number_of_readings;
            $new->most_readable = $old->most_readable;

            $new->save();
        });

        // orders
        Jorder::orderBy('id')->each(function ($old) {
            $new = new Order();
            $new->name = $old->name;
            $new->email = 'Электронная почта';
            $new->phone = $old->phone;
            $new->address = 'Адрес';
            $new->book_id = $old->book_id;
            $new->new = $old->new;
            $new->save();
        });


        // deleting removed items relations
        DB::table('author_book')->get()->each(function ($item) {
            $author = Author::find($item->author_id);
            $book = Book::find($item->book_id);

            if(!$author) {
                DB::table('author_book')->where('author_id', $item->author_id)->delete();
            }

            if(!$book) {
                DB::table('author_book')->where('book_id', $item->book_id)->delete();
            }
        });

        DB::table('book_category')->get()->each(function ($item) {
            $book = Book::find($item->book_id);
            $category = Category::find($item->category_id);

            if(!$category) {
                DB::table('book_category')->where('category_id', $item->category_id)->delete();
            }

            if(!$book) {
                DB::table('book_category')->where('book_id', $item->book_id)->delete();
            }
        });
    }
}





