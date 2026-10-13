# 🗄️ Database Migrations & Language Plugin Guide for NIRM.in

This guide explains how database migrations work in NIRM CMS, why plugin migrations show "No" or fail with `Base table or view already exists`, and the exact commands to run or mark them as completed safely.

---

## 📌 1. Why `migrate:status` Shows `No` for Language Migration

When you run:
```bash
php artisan migrate:status --path=platform/plugins/language/database/migrations
```
and see:
```text
+------+------------------------------------------+-------+
| Ran? | Migration                                | Batch |
+------+------------------------------------------+-------+
| No   | 2016_10_03_032336_create_languages_table |       |
+------+------------------------------------------+-------+
```

### The Cause:
Laravel tracks executed migrations inside the `migrations` table in the database.
If you cloned the repo and imported an existing database dump (e.g., `db_backup.sql`), one of two scenarios happened:
1. **The tables already exist:** The database dump already created `languages` and `language_meta` tables, but the `migrations` table record (`2016_10_03_032336_create_languages_table`) is missing from the `migrations` table.
   - If you run `php artisan migrate`, it will throw:
     ```text
     SQLSTATE[42S01]: Base table or view already exists: 1050 Table 'languages' already exists
     ```
2. **The tables do NOT exist yet:** You need to execute the migration to create the tables.

---

## 🚀 2. How to Handle This Migration (Choose Scenario A or B)

### Scenario A: The Tables Already Exist in the Database (Most Common)

If the `languages` and `language_meta` tables already exist in your database, simply **record the migration in the `migrations` table** without trying to re-create the tables:

#### Single Command (Run on Server or Local Terminal):
```bash
php -r '
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$migrationName = "2016_10_03_032336_create_languages_table";
$exists = DB::table("migrations")->where("migration", $migrationName)->exists();

if (!$exists) {
    $lastBatch = DB::table("migrations")->max("batch") ?: 1;
    DB::table("migrations")->insert([
        "migration" => $migrationName,
        "batch" => $lastBatch + 1
    ]);
    echo "Successfully marked $migrationName as executed in migrations table!\n";
} else {
    echo "Migration $migrationName is already recorded.\n";
}
'
```

---

### Scenario B: The Tables Do NOT Exist in the Database

If the `languages` table does not exist in your database, run the migration directly using the path:

```bash
php artisan migrate --path=platform/plugins/language/database/migrations
```

Or for production with force flag:
```bash
php artisan migrate --path=platform/plugins/language/database/migrations --force
```

---

## 🌐 3. Post-Migration Step: Seed Default Languages & Assign Content

Once the tables exist, ensure the default languages (`English`, `हिन्दी`, `ಕನ್ನಡ`) exist and all content is linked to English. Run this script:

```bash
php -r '
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Ensure English is default language
$en = DB::table("languages")->where("lang_code", "en_US")->first();
if (!$en) {
    DB::table("languages")->insert([
        "lang_name" => "English",
        "lang_locale" => "en",
        "lang_code" => "en_US",
        "lang_flag" => "us",
        "lang_is_default" => 1,
        "lang_order" => 0,
        "lang_is_rtl" => 0,
    ]);
    echo "Created English language.\n";
}

// 2. Ensure Hindi exists
if (!DB::table("languages")->where("lang_code", "hi_IN")->exists()) {
    DB::table("languages")->insert([
        "lang_name" => "हिन्दी",
        "lang_locale" => "hi",
        "lang_code" => "hi_IN",
        "lang_flag" => "in",
        "lang_is_default" => 0,
        "lang_order" => 1,
        "lang_is_rtl" => 0,
    ]);
    echo "Created Hindi language.\n";
}

// 3. Ensure Kannada exists
if (!DB::table("languages")->where("lang_code", "kn_IN")->exists()) {
    DB::table("languages")->insert([
        "lang_name" => "ಕನ್ನಡ",
        "lang_locale" => "kn",
        "lang_code" => "kn_IN",
        "lang_flag" => "in",
        "lang_is_default" => 0,
        "lang_order" => 2,
        "lang_is_rtl" => 0,
    ]);
    echo "Created Kannada language.\n";
}

// 4. Assign default language (en_US) to existing pages, categories, and posts in language_meta
$models = [
    "pages" => Obii\Page\Models\Page::class,
    "posts" => Obii\Blog\Models\Post::class,
    "categories" => Obii\Blog\Models\Category::class,
    "menus" => Obii\Menu\Models\Menu::class,
    "blocks" => Obii\Block\Models\Block::class,
    "widgets" => Obii\Widget\Models\Widget::class,
];

$assigned = 0;
foreach ($models as $table => $modelClass) {
    if (!Schema::hasTable($table)) continue;
    $items = DB::table($table)->get();
    foreach ($items as $item) {
        $meta = DB::table("language_meta")
            ->where("reference_type", $modelClass)
            ->where("reference_id", $item->id)
            ->first();
        if (!$meta) {
            DB::table("language_meta")->insert([
                "lang_meta_code" => "en_US",
                "lang_meta_origin" => md5(uniqid($modelClass . $item->id, true)),
                "reference_id" => $item->id,
                "reference_type" => $modelClass,
            ]);
            $assigned++;
        }
    }
}

cache()->flush();
echo "Language setup complete. Assigned $assigned content items to English!\n";
'
```

---

## 🛠️ 4. Updating the DB and Migration if Using an Old DB (Fix Missing Permissions & Menus)

When restoring or migrating from an older database dump:
1. The `languages` migration may show `Ran: Yes`, but the **Language option is missing** from the admin sidebar, Settings, or the Roles & Permissions checklist.
2. Roles created prior to activating the plugin do not have the language permissions (`languages.*`) stored in their JSON config.
3. The plugin might not be listed in `activated_plugins` inside the `settings` table.
4. Old admin accounts might lack the `super_user = 1` flag.

### The All-In-One Fix Script for Old Databases:

Run this command inside the project root on your server or local terminal:

```bash
php -r '
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Ensure "language" plugin is activated in the settings table
$active = json_decode(DB::table("settings")->where("key", "activated_plugins")->value("value") ?: "[]", true);
if (!in_array("language", $active)) {
    $active[] = "language";
    DB::table("settings")->updateOrInsert(
        ["key" => "activated_plugins"],
        ["value" => json_encode(array_values(array_unique($active)))]
    );
    echo "✔ Added language to activated_plugins setting.\n";
} else {
    echo "✔ Language is already active in settings.\n";
}

// 2. Grant language permissions to all existing roles in roles table
$roles = DB::table("roles")->get();
foreach ($roles as $role) {
    $perms = json_decode($role->permissions ?: "{}", true) ?: [];
    $perms["languages.index"] = true;
    $perms["languages.create"] = true;
    $perms["languages.edit"] = true;
    $perms["languages.destroy"] = true;
    $perms["languages.theme-translations"] = true;
    DB::table("roles")->where("id", $role->id)->update([
        "permissions" => json_encode($perms)
    ]);
    echo "✔ Added language permissions to role: " . $role->name . "\n";
}

// 3. Ensure existing administrators have super_user privileges
DB::table("users")->update(["super_user" => 1, "manage_supers" => 1]);
echo "✔ Updated admin users to super_user = 1.\n";

// 4. Flush cache so permissions and plugin providers take effect immediately
cache()->flush();
echo "✔ Cache flushed successfully.\n";
'
```

After running the script, clear the compiled framework cache:
```bash
php artisan optimize:clear
```

> **Note:** Log out from the Admin Panel (`/cmsadmin`) and log back in to refresh your active session and permissions tree!

---

## 🔍 5. Verification

After running the steps above:

1. Check migration status:
   ```bash
   php artisan migrate:status --path=platform/plugins/language/database/migrations
   ```
   Output will now display:
   ```text
   +------+------------------------------------------+-------+
   | Ran? | Migration                                | Batch |
   +------+------------------------------------------+-------+
   | Yes  | 2016_10_03_032336_create_languages_table | ...   |
   +------+------------------------------------------+-------+
   ```

2. Clear application caches:
   ```bash
   php artisan optimize:clear
   ```

3. Visit your Admin Panel:
   - Navigate to `/cmsadmin/settings/languages` (or `/admin/settings/languages`).
   - The language settings and flags will load properly.
   - Navigate to **Administration > Roles** -> click **Edit** on your role: all language permissions will be present in the tree.
