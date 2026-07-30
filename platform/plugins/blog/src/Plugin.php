<?php

namespace Obii\Blog;

use Obii\Blog\Models\Category;
use Obii\Blog\Models\Tag;
use Obii\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Obii\Menu\Repositories\Interfaces\MenuNodeInterface;
use Illuminate\Support\Facades\Schema;
use Obii\PluginManagement\Abstracts\PluginOperationAbstract;
use Obii\ACL\Models\User;
use Obii\Slug\Models\Slug;
use Illuminate\Support\Str;
use SlugHelper;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');

        app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_posts_recent']);

        app(MenuNodeInterface::class)->deleteBy(['reference_type' => Category::class]);
        app(MenuNodeInterface::class)->deleteBy(['reference_type' => Tag::class]);
    }
    public static function activate()
    {
        $categories = [
            [
                'name' => 'News',
                'is_default' => true,
            ],
            // [
            //     'name' => 'Announcements',
            // ],
            [
                'name' => 'Press Releases',
            ]
        ];
        foreach ($categories as $index => $item) {
            $item['description'] = 'This is a description for ' . $item['name'];
            $item['author_id'] = 1;
            $item['author_type'] = User::class;
            $item['is_featured'] = $index === 0 ? true : false;

            $exists = Category::where('name', $item['name'])->exists();
            if ($exists) {
                continue;
            }
            $category = Category::create($item);

            Slug::create([
                'reference_type' => Category::class,
                'reference_id'   => $category->id,
                'key'            => Str::slug($category->name),
                'prefix'         => SlugHelper::getPrefix(Category::class),
            ]);
        }
    }
}
