<?php

namespace Obii\Slug\Services;

use Obii\Slug\Repositories\Interfaces\SlugInterface;
use Illuminate\Support\Str;
use SlugHelper;

class SlugService
{
    /**
     * @var SlugInterface
     */
    protected $slugRepository;

    /**
     * SlugService constructor.
     * @param SlugInterface $slugRepository
     */
    public function __construct(SlugInterface $slugRepository)
    {
        $this->slugRepository = $slugRepository;
    }

    /**
     * @param string $name
     * @param int $slugId
     * @return int|string
     */
    public function create($name, $slugId = 0, $model = null)
    {
        $slug = Str::slug($name, '-', !SlugHelper::turnOffAutomaticUrlTranslationIntoLatin() ? 'en' : false);

        $index = 1;
        $baseSlug = $slug;

        $prefix = null;
        if (!empty($model)) {
            $prefix = SlugHelper::getPrefix($model);
        }

        while ($this->checkIfExistedSlug($slug, $slugId, $prefix, $model)) {
            $slug = apply_filters(FILTER_SLUG_EXISTED_STRING, $baseSlug . '-' . $index++, $baseSlug, $index, $model);
        }

        if (empty($slug)) {
            $slug = time();
        }

        return apply_filters(FILTER_SLUG_STRING, $slug, $model);
    }

    /**
     * @param string $slug
     * @param string $slugId
     * @param string $prefix
     * @param string|null $model
     * @return bool
     */
    protected function checkIfExistedSlug($slug, $slugId, $prefix, $model = null)
    {
        $existing = $this->slugRepository
                ->getModel()
                ->where([
                    'key'    => $slug,
                    'prefix' => $prefix,
                ])
                ->where('id', '!=', (int)$slugId)
                ->first();

        if (!$existing) {
            return false;
        }

        // Allow identical slugs across different languages (e.g. /about vs /kn/about)
        if (is_plugin_active('language') && $existing->reference_type && $existing->reference_id) {
            $existingMeta = \Obii\Language\Models\LanguageMeta::where([
                'reference_type' => $existing->reference_type,
                'reference_id'   => $existing->reference_id,
            ])->first();

            $currentAdminLang = class_exists('\Language') ? \Language::getCurrentAdminLocale() : null;

            if ($existingMeta && $currentAdminLang && $existingMeta->lang_meta_code !== $currentAdminLang) {
                return false;
            }
        }

        return true;
    }
}
