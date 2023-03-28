<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoriesController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(string $language = null)
    {
        $categories = $this->categoryService->get($language);

        // TODO Don't use App
        return view('categories.index', [
            'language' => $language ?? App::getLocale(),
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, string $language = null)
    {
        $items = $request->input('categories');
        foreach ($items as $id => $name) {
            if ($name !== null) {
                $this->categoryService->update($language, $id, $name);
            }
        }

        return redirect(route('categories.index', ['language' => $language]));
    }
}
