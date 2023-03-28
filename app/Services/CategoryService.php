<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Application;

class CategoryService
{
    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @todo
     */
    public function get(?string $language, int $limit = 20)
    {
        // todo add to middleware
        if (!$language) {
            $language = $this->application->getLocale();
        }
        return Category::query()->limit($limit)->with([
            'parent',
            'parent.translation' => function (MorphOne $query) use ($language) {
                $query->where('language', $language);
            },
            'translation' => function (MorphOne $query) use ($language) {
                $query->where('language', $language);
            }
        ])->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @todo
     */
    public function getById(?string $language, int $id)
    {
        return Category::query()->where('id', $id)->with([
            'parent',
            'parent.translation' => function (MorphOne $query) use ($language) {
                $query->where('language', $language);
            },
            'translation' => function (MorphOne $query) use ($language) {
                $query->where('language', $language);
            }
        ])->first();
    }

    public function update(?string $language, int $id, string $name)
    {
        // todo add to middleware
        if (!$language) {
            $language = $this->application->getLocale();
        }
        $category = $this->getById($language, $id);
        if (!$category) {
            throw new \Exception('Category not found');
        }

        $translation = $category->translation;
        if (!$translation) {
            $translation = new Translation();
            $translation->language = $language;
        }

        $translation->content = $name;

        return $category->translation()->save($translation);
    }
}
