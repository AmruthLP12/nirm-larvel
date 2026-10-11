# 📦 Asset Compilation

NIRM CMS uses **Laravel Mix 6** (Webpack wrapper) to compile JavaScript, SASS/CSS, and other frontend assets.

---

## Overview

The build system compiles assets from:
- **Theme assets**: `platform/themes/nirm/assets/`
- **Plugin assets**: `platform/plugins/*/assets/`
- **Package assets**: `platform/packages/*/assets/`

Each module has its own `webpack.mix.js` that is automatically discovered and included.

---

## Frontend Stack

| Technology | Version | Purpose |
|---|---|---|
| **Vue.js** | 2.6 | Reactive UI components |
| **Bootstrap** | 4.6 | CSS framework |
| **Bootstrap-Vue** | 2.21 | Vue components for Bootstrap |
| **jQuery** | 3.5 | DOM manipulation |
| **SASS** | 1.39 | CSS preprocessor |
| **Axios** | 0.21 | HTTP client |
| **Lodash** | 4.17 | Utility library |
| **Moment.js** | 2.29 | Date/time handling |
| **Sanitize HTML** | 2.3 | XSS protection for user content |
| **Epic Spinners** | 1.1 | Loading spinner components |
| **PurgeCSS** | 4.0 | Remove unused CSS in production |

---

## NPM Scripts

| Command | Description |
|---|---|
| `npm run dev` | Compile assets for development (unminified, with source maps) |
| `npm run watch` | Watch files and recompile on change |
| `npm run watch-poll` | Watch with polling (use if regular watch doesn't detect changes) |
| `npm run hot` | Hot Module Replacement (live reload) |
| `npm run prod` | Compile and minify for production |

---

## How It Works

The root `webpack.mix.js` auto-discovers all `webpack.mix.js` files in the platform:

```javascript
// Root webpack.mix.js
let glob = require('glob');

// Discover and run all webpack.mix.js files in the platform
glob.sync('./platform/**/**/webpack.mix.js').forEach(item => require(item));
```

### Compile Specific Assets

To compile only specific assets, edit `webpack.mix.js`:

```javascript
// Only compile a specific package:
require('./platform/packages/menu/webpack.mix.js');

// Only compile a specific plugin:
require('./platform/plugins/blog/webpack.mix.js');

// Only compile themes:
glob.sync('./platform/themes/**/webpack.mix.js').forEach(item => require(item));
```

---

## Build Workflow

### Development

```bash
# Install dependencies (first time or after package.json changes)
npm install

# Compile assets
npm run dev

# Watch for changes during development
npm run watch
```

### Production

```bash
# Build minified assets
npm run prod

# Publish compiled assets to public/
php artisan cms:publish:assets
```

---

## Mix Options

The root `webpack.mix.js` configures:

```javascript
mix.options({
    processCssUrls: false,    // Don't rewrite CSS url() paths
    clearConsole: true,       // Clear console on rebuild
    terser: {
        extractComments: false,  // Don't create LICENSE.txt files
    }
});
```

---

## Published Assets

After compilation and `cms:publish:assets`, assets are available at:

```
public/
├── assets/          # Core CMS assets (admin panel CSS/JS)
└── themes/          # Theme-specific compiled assets
    └── nirm/        # NIRM theme public assets
```

---

## Troubleshooting

| Issue | Solution |
|---|---|
| `npm run dev` fails with memory error | `NODE_OPTIONS=--max_old_space_size=4096 npm run dev` |
| SASS compilation errors | `npm rebuild node-sass` or delete `node_modules` and reinstall |
| Assets not updating on site | Run `php artisan cms:publish:assets` after compiling |
| Vue components not rendering | Check that `vue-loader` and `vue-template-compiler` versions match Vue 2 |
| PurgeCSS removing needed styles | Add safelist in PostCSS config |
