<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');
    Route::resource('jenis-kelas','App\Http\Controllers\Admin\JenisKelasController');
    Route::resource('kelas','App\Http\Controllers\Admin\KelasController');
    Route::resource('mata-pelajaran','App\Http\Controllers\Admin\MataPelajaranController');
    Route::resource('tahun-akademik','App\Http\Controllers\Admin\TahunAkademikController');
    Route::resource('tipe-user','App\Http\Controllers\Admin\TipeUserController');
    Route::resource('user','App\Http\Controllers\Admin\UserController');
    Route::resource('guru','App\Http\Controllers\Admin\GuruController');
    Route::resource('lab','App\Http\Controllers\Admin\LaboratoriumController');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/', 'App\Http\Controllers\GuruController@dashboard')->name('dashboard');
    Route::resource('praktikum','App\Http\Controllers\Guru\PraktikumController');
    Route::resource('penjadwalan-ulang','App\Http\Controllers\Guru\PenjadwalanUlangController');
});

Route::prefix('pengelola')->name('pengelola.')->group(function () {
    Route::get('/', 'App\Http\Controllers\PengelolaController@dashboard')->name('dashboard');

    Route::resource('ruang-lab','App\Http\Controllers\Pengelola\RuangLaboratoriumController');
    Route::resource('lemari','App\Http\Controllers\Pengelola\LemariController');
    Route::resource('katalog-alat','App\Http\Controllers\Pengelola\KatalogAlatController');
    Route::resource('kategori-alat','App\Http\Controllers\Pengelola\KategoriAlatController');
    Route::resource('alat','App\Http\Controllers\Pengelola\AlatController');
    Route::resource('bahan-kimia','App\Http\Controllers\Pengelola\BahanKimiaController');
    Route::resource('bahan','App\Http\Controllers\Pengelola\BahanController');
    Route::resource('praktikum','App\Http\Controllers\Pengelola\PraktikumController');

    Route::get('jadwal-praktikum','App\Http\Controllers\Pengelola\JadwalPraktikumController@index');

    Route::get('penjadwalan-ulang','App\Http\Controllers\Pengelola\PenjadwalanUlangController@index');

    Route::get('peminjaman','App\Http\Controllers\Pengelola\PeminjamanController@index');

    Route::get('pengembalian','App\Http\Controllers\Pengelola\PengembalianController@index');

    Route::get('simulasi','App\Http\Controllers\Pengelola\SimulasiController@index');
    
    Route::get('cetak/kartu-stok','App\Http\Controllers\Pengelola\CetakController@kartuStok');
    Route::get('cetak/katalog-lemari','App\Http\Controllers\Pengelola\CetakController@katalogLemari');
    Route::get('cetak/barang-rusak','App\Http\Controllers\Pengelola\CetakController@barangRusak');

});

Route::get('cekusername/{username}', function($username){
    $hasil = User::where('username',$username)->exists() ? true : false;
    return response()->json($hasil);
});

// Route::get('/', 'AlatController@index');

Route::get('/', 'App\Http\Controllers\DavuradminController@dashboard_1');
Route::get('/index', 'App\Http\Controllers\DavuradminController@dashboard_1');
Route::get('/page-analytics', 'App\Http\Controllers\DavuradminController@analytics');
Route::get('/page-order', 'App\Http\Controllers\DavuradminController@order');
Route::get('/page-order-list', 'App\Http\Controllers\DavuradminController@order_list');
Route::get('/page-review', 'App\Http\Controllers\DavuradminController@review');
Route::get('/page-general-customers', 'App\Http\Controllers\DavuradminController@general_customers');
Route::get('/app-calender', 'App\Http\Controllers\DavuradminController@app_calender');
Route::get('/app-profile', 'App\Http\Controllers\DavuradminController@app_profile');
Route::get('/chart-chartist', 'App\Http\Controllers\DavuradminController@chart_chartist');
Route::get('/chart-chartjs', 'App\Http\Controllers\DavuradminController@chart_chartjs');
Route::get('/chart-flot', 'App\Http\Controllers\DavuradminController@chart_flot');
Route::get('/chart-morris', 'App\Http\Controllers\DavuradminController@chart_morris');
Route::get('/chart-peity', 'App\Http\Controllers\DavuradminController@chart_peity');
Route::get('/chart-sparkline', 'App\Http\Controllers\DavuradminController@chart_sparkline');
Route::get('/ecom-checkout', 'App\Http\Controllers\DavuradminController@ecom_checkout');
Route::get('/ecom-customers', 'App\Http\Controllers\DavuradminController@ecom_customers');
Route::get('/ecom-invoice', 'App\Http\Controllers\DavuradminController@ecom_invoice');
Route::get('/ecom-product-detail', 'App\Http\Controllers\DavuradminController@ecom_product_detail');
Route::get('/ecom-product-grid', 'App\Http\Controllers\DavuradminController@ecom_product_grid');
Route::get('/ecom-product-list', 'App\Http\Controllers\DavuradminController@ecom_product_list');
Route::get('/ecom-product-order', 'App\Http\Controllers\DavuradminController@ecom_product_order');
Route::get('/email-compose', 'App\Http\Controllers\DavuradminController@email_compose');
Route::get('/email-inbox', 'App\Http\Controllers\DavuradminController@email_inbox');
Route::get('/email-read', 'App\Http\Controllers\DavuradminController@email_read');
Route::get('/form-editor-summernote', 'App\Http\Controllers\DavuradminController@form_editor_summernote');
Route::get('/form-element', 'App\Http\Controllers\DavuradminController@form_element');
Route::get('/form-pickers', 'App\Http\Controllers\DavuradminController@form_pickers');
Route::get('/form-validation-jquery', 'App\Http\Controllers\DavuradminController@form_validation_jquery');
Route::get('/form-wizard', 'App\Http\Controllers\DavuradminController@form_wizard');
Route::get('/map-jqvmap', 'App\Http\Controllers\DavuradminController@map_jqvmap');
Route::get('/page-error-400', 'App\Http\Controllers\DavuradminController@page_error_400');
Route::get('/page-error-403', 'App\Http\Controllers\DavuradminController@page_error_403');
Route::get('/page-error-404', 'App\Http\Controllers\DavuradminController@page_error_404');
Route::get('/page-error-500', 'App\Http\Controllers\DavuradminController@page_error_500');
Route::get('/page-error-503', 'App\Http\Controllers\DavuradminController@page_error_503');
Route::get('/page-forgot-password', 'App\Http\Controllers\DavuradminController@page_forgot_password');
Route::get('/page-lock-screen', 'App\Http\Controllers\DavuradminController@page_lock_screen');
Route::get('/page-login', 'App\Http\Controllers\DavuradminController@page_login');
Route::get('/page-register', 'App\Http\Controllers\DavuradminController@page_register');
Route::get('/table-bootstrap-basic', 'App\Http\Controllers\DavuradminController@table_bootstrap_basic');
Route::get('/table-datatable-basic', 'App\Http\Controllers\DavuradminController@table_datatable_basic');
Route::get('/uc-nestable', 'App\Http\Controllers\DavuradminController@uc_nestable');
Route::get('/uc-noui-slider', 'App\Http\Controllers\DavuradminController@uc_noui_slider');
Route::get('/uc-select2', 'App\Http\Controllers\DavuradminController@uc_select2');
Route::get('/uc-sweetalert', 'App\Http\Controllers\DavuradminController@uc_sweetalert');
Route::get('/uc-toastr', 'App\Http\Controllers\DavuradminController@uc_toastr');
Route::get('/ui-accordion', 'App\Http\Controllers\DavuradminController@ui_accordion');
Route::get('/ui-alert', 'App\Http\Controllers\DavuradminController@ui_alert');
Route::get('/ui-badge', 'App\Http\Controllers\DavuradminController@ui_badge');
Route::get('/ui-button', 'App\Http\Controllers\DavuradminController@ui_button');
Route::get('/ui-button-group', 'App\Http\Controllers\DavuradminController@ui_button_group');
Route::get('/ui-card', 'App\Http\Controllers\DavuradminController@ui_card');
Route::get('/ui-carousel', 'App\Http\Controllers\DavuradminController@ui_carousel');
Route::get('/ui-dropdown', 'App\Http\Controllers\DavuradminController@ui_dropdown');
Route::get('/ui-grid', 'App\Http\Controllers\DavuradminController@ui_grid');
Route::get('/ui-list-group', 'App\Http\Controllers\DavuradminController@ui_list_group');
Route::get('/ui-media-object', 'App\Http\Controllers\DavuradminController@ui_media_object');
Route::get('/ui-modal', 'App\Http\Controllers\DavuradminController@ui_modal');
Route::get('/ui-pagination', 'App\Http\Controllers\DavuradminController@ui_pagination');
Route::get('/ui-popover', 'App\Http\Controllers\DavuradminController@ui_popover');
Route::get('/ui-progressbar', 'App\Http\Controllers\DavuradminController@ui_progressbar');
Route::get('/ui-tab', 'App\Http\Controllers\DavuradminController@ui_tab');
Route::get('/ui-typography', 'App\Http\Controllers\DavuradminController@ui_typography');
Route::get('/widget-basic', 'App\Http\Controllers\DavuradminController@widget_basic');