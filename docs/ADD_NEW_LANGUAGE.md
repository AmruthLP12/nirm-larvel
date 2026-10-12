# Guide: Adding and Managing Languages in NIRM CMS

This guide explains how to add new languages (such as **Telugu**, **Tamil**, **Kannada**, or any other language) in the CMS Admin panel and what happens next.

---

## 1. Why Kannada, Telugu and Tamil Were Missing Previously

The language dropdown in `/cmsadmin/settings/languages` populates its presets from `platform/core/base/src/Supports/Language.php`. Previously, only a limited set of global locales existed in that list (for example, Sri Lankan Tamil `ta_LK` was present, but Indian Tamil `ta_IN` and Telugu `te_IN` were not).

We have now added predefined presets for:

- **Kannada (India):** `kn_IN` (code: `kn`, Flag: `in`, Direction: `ltr`)
- **Telugu (India):** `te_IN` (code: `te`, Flag: `in`, Direction: `ltr`)
- **Tamil (India):** `ta_IN` (code: `ta`, Flag: `in`, Direction: `ltr`)

---

## 2. Step-by-Step: How to Add a New Language

### Step 1: Open the Language Settings Page

1. Log into your CMS Admin panel (`/cmsadmin`).
2. In the left navigation menu, go to **Settings** &rarr; **Languages** (`/cmsadmin/settings/languages`).

### Step 2: Select or Fill the Language Form

Under the **"Choose language"** dropdown on the left side of the page:

1. **Choose from Preset:**
    - Select **తెలుగు (Telugu) - te_IN** or **தமிழ் (Tamil) - ta_IN** from the dropdown.
    - The form fields will automatically auto-fill:
        - **Language name:** `తెలుగు (Telugu)` or `தமிழ் (Tamil)`
        - **Locale:** `te_IN` or `ta_IN`
        - **Language code:** `te` or `ta`
        - **Text direction:** `Left to right`
        - **Flag:** Select India (`in`)
2. **Or Add Any Custom Language:**
    - You can also type custom values manually into any field without using the preset dropdown.
3. Click the **"Add new language"** button.

---

## 3. What Happens After Adding a Language?

Once you click **"Add new language"**, the language is immediately saved in the database:

### A. Automatic Google Translation Support (Immediate)

- If **Translation Mode** in the **Settings** tab is set to **"Both"** or **"Google Translate"**, the new language is instantly available on the public website.
- In the public language dropdown, users will see the language with an **`Auto`** badge.
- Clicking that language will automatically translate the active page using Google Translate without requiring any manual translation work from editors.

### B. Creating Official CMS Translations (Manual Translation)

If you want editors to write and publish human translations for pages, posts, or sliders:

1. **For Pages:**
    - Go to **Pages** (`/cmsadmin/pages`).
    - In the Pages table, you will see language flag columns or a `+` icon for the newly added language.
    - Click the **`+`** icon next to any page (e.g., "About Us") in the new language's column.
    - This creates a **linked translation draft** connected to the original page.
    - Fill in the translated title and content, set the status to **"Published"**, and save.

2. **For News / Posts:**
    - Go to **Blog** &rarr; **Posts**.
    - Open any post or click the `+` under the new language column to author the translated article.
    - Publish the post.

3. **Frontend Dynamic Detection:**
    - When a visitor visits a page that has an official manual translation published in that language:
        - The language selector dynamically updates the badge from **`Auto`** to **`Official`**.
        - Clicking the language switches directly to the clean CMS URL (e.g. `/te/about` or `/ta/about`).
    - If the page does **not** have an official manual translation yet, the visitor can still read it translated via the **`Auto`** button.

---

## 4. Configuring Translation Behavior

In `/cmsadmin/settings/languages`, switch to the **"Settings"** tab to configure:

1. **Translation Strategy / Mode:**
    - **Google Translate + CMS Manual Translations (Recommended):** Gives users the best experience — official human translations when available, and automatic Google Translate for everything else.
    - **CMS Manual Translations Only:** Only shows human-translated content.
    - **Google Translate Only:** Relies solely on client-side automatic translation.
2. **When Manual Translation is Unavailable:**
    - Choose whether to show the default English version or hide the language link for that page.
3. **Show Machine-Translation Label:**
    - When enabled, shows a clear notice banner at the top of the page when Google Translate is actively translating the content, including a button to restore the original English version.
4. **Google Translate Per-Language Activation:**
    - Checkboxes allow you to selectively enable or disable Google Translate for individual languages.
