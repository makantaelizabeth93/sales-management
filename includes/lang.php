<?php
// Language helper for the Sales Management system
// This file provides translation support for English and Swahili.

// Start the session if it has not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Supported languages for the application
$availableLanguages = ['en', 'sw'];

// Use query parameter if present, otherwise fall back to saved session language or English
$selectedLang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'en';
if (!in_array($selectedLang, $availableLanguages, true)) {
    $selectedLang = 'en';
}
$_SESSION['lang'] = $selectedLang;

// Translation dictionary for all visible labels, messages, and UI text
$translations = [
    'en' => [
        'app_title' => 'Sales Management System',
        'login_title' => 'Login to Sales System',
        'username' => 'Username',
        'password' => 'Password',
        'sign_in' => 'Sign In',
        'fill_all_fields' => 'Please fill in all fields.',
        'incorrect_credentials' => 'Incorrect username or password.',
        'dashboard' => 'Dashboard',
        'products' => 'Products',
        'sales' => 'Sales',
        'reports' => 'Reports',
        'logout' => 'Logout',
        'logged_in_as' => 'Logged in as',
        'toggle_menu' => 'Toggle Menu',
        'language' => 'Language',
        'english' => 'English',
        'swahili' => 'Kiswahili',
        'product_list' => 'Product List',
        'product_overview' => 'List of products in the system',
        'add_product' => 'Add Product',
        'edit_product' => 'Edit',
        'delete' => 'Delete',
        'name' => 'Name',
        'description' => 'Description',
        'cost_price' => 'Cost Price',
        'sale_price' => 'Sale Price',
        'stock' => 'Stock',
        'actions' => 'Actions',
        'add_new_product' => 'Add New Product',
        'save_product' => 'Save Product',
        'save_changes' => 'Save Changes',
        'back' => 'Back',
        'product_name' => 'Product Name',
        'product_notes' => 'Use this form to add a new product to inventory.',
        'edit_product_title' => 'Edit Product',
        'product_not_found' => 'Product not found.',
        'product_added' => 'Product added successfully.',
        'product_updated' => 'Product updated successfully.',
        'product_deleted' => 'Product deleted successfully.',
        'sale_saved' => 'Sale saved successfully.',
        'select_product_invalid' => 'Please select a valid product and quantity.',
        'out_of_stock' => 'Not enough stock is available for this product.',
        'sale_save_error' => 'An error occurred while saving the sale.',
        'all_fields_required' => 'Please complete all required fields.',
        'numeric_values_required' => 'Price and stock must be numeric values.',
        'dashboard_title' => 'Dashboard',
        'total_products' => 'Total Products',
        'today_sales' => 'Today Sales',
        'today_revenue' => 'Today Revenue',
        'stock_remaining' => 'Stock Remaining',
        'business_summary' => 'Business performance overview. Use the sidebar to manage products, record sales, and view reports.',
        'sales_title' => 'Sales',
        'sales_description' => 'Make new sales and review recent transactions.',
        'choose_product' => 'Choose Product',
        'price' => 'Price',
        'quantity' => 'Quantity',
        'total' => 'Total',
        'profit' => 'Profit',
        'save_sale' => 'Save Sale',
        'recent_sales' => 'Recent Sales',
        'date' => 'Date',
        'profit' => 'Profit',
        'report_title' => 'Sales Reports',
        'today_report' => 'Today’s sales report',
        'month_report' => 'Month sales report',
        'today_profit' => 'Today Profit',
        'month_sales' => 'Month Sales',
        'month_revenue' => 'Month Revenue',
        'month_profit' => 'Month Profit',
        'total_revenue' => 'Total Revenue',
        'total_profit' => 'Total Profit',
        'product' => 'Product',
        'confirm_delete' => 'Are you sure you want to delete this item?',
        'datatable_search' => 'Search:',
        'datatable_lengthMenu' => 'Show _MENU_ entries',
        'datatable_info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
        'datatable_previous' => 'Previous',
        'datatable_next' => 'Next',
    ],
    'sw' => [
        'app_title' => 'Mfumo wa Usimamizi wa Mauzo',
        'login_title' => 'Ingia kwenye Mfumo wa Mauzo',
        'username' => 'Jina la mtumiaji',
        'password' => 'Nenosiri',
        'sign_in' => 'Ingia',
        'fill_all_fields' => 'Tafadhali jaza sehemu zote.',
        'incorrect_credentials' => 'Jina la mtumiaji au nenosiri si sahihi.',
        'dashboard' => 'Dashboard',
        'products' => 'Bidhaa',
        'sales' => 'Mauzo',
        'reports' => 'Ripoti',
        'logout' => 'Toka',
        'logged_in_as' => 'Imeingia kama',
        'toggle_menu' => 'Badilisha Menu',
        'language' => 'Lugha',
        'english' => 'Kiingereza',
        'swahili' => 'Kiswahili',
        'product_list' => 'Orodha ya Bidhaa',
        'product_overview' => 'Orodha ya bidhaa zilizopo',
        'add_product' => 'Ongeza Bidhaa',
        'edit_product' => 'Hariri',
        'delete' => 'Futa',
        'name' => 'Jina',
        'description' => 'Maelezo',
        'cost_price' => 'Bei Gharama',
        'sale_price' => 'Bei Mauzo',
        'stock' => 'Stock',
        'actions' => 'Kazi',
        'add_new_product' => 'Ongeza Bidhaa Mpya',
        'save_product' => 'Hifadhi Bidhaa',
        'save_changes' => 'Hifadhi Mabadiliko',
        'back' => 'Rudi',
        'product_name' => 'Jina la Bidhaa',
        'product_notes' => 'Tumia fomu hii kuongeza bidhaa mpya kwenye hesabu.',
        'edit_product_title' => 'Hariri Bidhaa',
        'product_not_found' => 'Bidhaa haipatikani.',
        'product_added' => 'Bidhaa imeongezwa kwa mafanikio.',
        'product_updated' => 'Bidhaa imehaririwa kwa mafanikio.',
        'product_deleted' => 'Bidhaa imefutwa kwa mafanikio.',
        'sale_saved' => 'Mauzo yamehifadhiwa kwa mafanikio.',
        'select_product_invalid' => 'Tafadhali chagua bidhaa na idadi inayofaa.',
        'out_of_stock' => 'Hakuna stock ya kutosha kwa bidhaa hii.',
        'sale_save_error' => 'Kosa limetokea wakati wa kuhifadhi mauzo.',
        'all_fields_required' => 'Tafadhali jaza sehemu zote muhimu.',
        'numeric_values_required' => 'Bei na stock lazima ziwe nambari.',
        'dashboard_title' => 'Dashboard',
        'total_products' => 'Bidhaa Zote',
        'today_sales' => 'Mauzo ya Leo',
        'today_revenue' => 'Mapato ya Leo',
        'stock_remaining' => 'Bidhaa Zilizobaki',
        'business_summary' => 'Muhtasari wa utendaji wa biashara. Tumia menyu kushoto kusimamia bidhaa, kuandika mauzo, na kuona ripoti.',
        'sales_title' => 'Mauzo',
        'sales_description' => 'Fanya mauzo mapya na angalia miamala ya hivi karibuni.',
        'choose_product' => 'Chagua Bidhaa',
        'price' => 'Bei',
        'quantity' => 'Kiasi',
        'total' => 'Jumla',
        'profit' => 'Faida',
        'save_sale' => 'Hifadhi Mauzo',
        'recent_sales' => 'Mauzo ya Karibuni',
        'date' => 'Tarehe',
        'report_title' => 'Ripoti za Mauzo',
        'today_report' => 'Ripoti ya Mauzo ya Leo',
        'month_report' => 'Ripoti ya Mauzo ya Mwezi',
        'today_profit' => 'Faida ya Leo',
        'month_sales' => 'Mauzo ya Mwezi',
        'month_revenue' => 'Mapato ya Mwezi',
        'month_profit' => 'Faida ya Mwezi',
        'total_revenue' => 'Jumla ya Mapato',
        'total_profit' => 'Jumla ya Faida',
        'product' => 'Bidhaa',
        'confirm_delete' => 'Una uhakika unataka kufuta hii?',
        'datatable_search' => 'Tafuta:',
        'datatable_lengthMenu' => 'Onyesha _MENU_ rekodi',
        'datatable_info' => 'Inaonyesha _START_ hadi _END_ ya _TOTAL_ rekodi',
        'datatable_previous' => 'Nyuma',
        'datatable_next' => 'Mbele',
    ],
];

// Return translated text for a given key, defaulting to the English value if missing
function t(string $key): string
{
    global $translations, $selectedLang;
    if (isset($translations[$selectedLang][$key])) {
        return $translations[$selectedLang][$key];
    }
    return $translations['en'][$key] ?? $key;
}

// Return the currently selected language code
function current_lang(): string
{
    global $selectedLang;
    return $selectedLang;
}

// Build a URL for switching language while keeping the same page and query parameters
function language_switch_url(string $langCode): string
{
    $url = $_SERVER['REQUEST_URI'] ?? '/';
    $parts = parse_url($url);
    $query = [];
    if (!empty($parts['query'])) {
        parse_str($parts['query'], $query);
    }
    $query['lang'] = $langCode;
    $path = $parts['path'] ?? '/';
    return $path . '?' . http_build_query($query);
}
