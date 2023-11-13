<?php


use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AmbilObatController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AntrianDashboardController;
use App\Http\Controllers\CekAkunController;
use App\Http\Controllers\DaftarAkunPasienController;
use App\Http\Controllers\ListObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SuratRujukanController;
use App\Http\Controllers\TambahObatCategoryController;
use App\Http\Controllers\TambahObatController;
use App\Models\ObatCategory;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/home');

Route::get('/link', [LoginController::class, 'link']);

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        'active' => 'about',
        "name" => "Roro Jonggrang",
        "About" => "Dongeng Rakyat Indonesia",
        "image" => "roro.jpg"
    ]);
});;

Route::get("/search/post", [PostController::class, 'search'])->name('searchPost');

Route::get('/home', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Kategori',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); //user yang belum login dapat akses
Route::get("/verifEmail/{token}", [RegisterController::class, "verifEmail"]);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// antrian
Route::get("/antrian", [AntrianController::class, "showAntrians"]);
Route::post("/antrian", [AntrianController::class, "store"]);
Route::get('/get-antrian-status', [AntrianController::class, 'getAntrianStatus']);


// Middleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->cek == 0) {
            return redirect("/dashboard/profile")->with('error', 'Kamu harus Perbaiki dan Cek Lagi Nomer BPJS Kamu, Jika Masalah berlanjut silahkan Hubungi Petugas!');
        }
        return view('dashboard.index');
    })->middleware('auth');

    // PDF
    Route::get('/dashboard/pdf/suratRujukan/{suratRujukan}', [SuratRujukanController::class, 'generatePDF']);
    Route::get('/dashboard/pdf/notaPembayaran/{notaPembayaran}', [PembayaranController::class, 'generatePDF']);
    Route::get('/dashboard/pdf/resepObat/{resepObat}', [ResepObatController::class, 'generatePDF']);
    Route::get('/dashboard/pdf/rekamMedis/{rekamMedis}', [RekamMedisController::class, 'generatePDF']);

    // logging
    Route::get("/dashboard/log/rekammedis", [RekamMedisController::class, 'getRekamMedis']);
    Route::get("/dashboard/log/resepobat", [ResepObatController::class, 'getResepObat']);
    Route::get("/dashboard/log/suratrujukan", [SuratRujukanController::class, 'getSuratRujukan']);
    Route::get("/dashboard/log/transaksi", [PembayaranController::class, 'getTransaksi']);

    // profile
    Route::resource('/dashboard/profile', ProfileEditController::class)->middleware('auth');

    //admin
    Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('admin');

    Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('admin');

    Route::resource('/dashboard/post/categories', AdminCategoryController::class)->except('show')->middleware('admin');

    Route::get('/dashboard/verifikasi', [CekAkunController::class, 'index'])->middleware('admin');

    Route::put('/dashboard/verifikasi/{user}', [CekAkunController::class, 'update'])->name('verifikasi.update');

    Route::resource("/dashboard/poli", PoliController::class)->middleware("admin");

    Route::resource("/dashboard/ruangan", RuanganController::class)->except("show")->middleware("admin");

    // ===> users feature admin
    Route::get('/dashboard/daftarpasien', [DaftarAkunPasienController::class, 'index'])->middleware('admin');
    Route::get("/search/user", [DaftarAkunPasienController::class, 'search'])->name('listUser')->middleware('admin');
    Route::get("/dashboard/daftarpasien/create", [DaftarAkunPasienController::class, 'create'])->middleware('admin');
    Route::post('/dashboard/daftarpasien', [DaftarAkunPasienController::class, 'store'])->middleware('admin');
    Route::get('/dashboard/daftarpasien/{user:nik}', [DaftarAkunPasienController::class, 'showUser'])->middleware('admin');
    Route::put('/dashboard/poli/status/{kodePoli}', [PoliController::class, 'changeStatusPoli'])->middleware('admin');

    //administrasi
    Route::get('/dashboard/pembayaran/list', [PembayaranController::class, 'listAntrianPembayaran'])->middleware('administrasi');
    Route::get('/dashboard/pembayaran/form/{kode_rekammedis}', [PembayaranController::class, 'createPembayaran'])->middleware('administrasi');
    Route::post('/dashboard/pembayaran/notapembayaran', [PembayaranController::class, 'storeNotaPembayaran'])->middleware('administrasi');
    Route::get('/dashboard/transaksi', [PembayaranController::class, 'listTransaksi'])->middleware('administrasi');
    Route::put('/dashboard/transaksi/{kodeInvoice}', [PembayaranController::class, 'successTransaction'])->middleware('administrasi');
    Route::get('/dashboard/transaksi/{kodeNotaPembayaran}', [PembayaranController::class, 'getTransaction'])->middleware('administrasi');


    //dokter
    Route::get('/dashboard/listobat', [ListObatController::class, 'index'])->middleware('dokter');
    Route::get('/dashboard/listpasien', [RekamMedisController::class, 'showPasien'])->middleware('dokter');
    Route::get('/dashboard/rekammedis/{kodeAntrian}', [RekamMedisController::class, 'getRekamMedisByKode']);
    Route::get('/dashboard/listpasien/rekammedis/form/{kode}', [RekamMedisController::class, 'createRekamMedis'])->middleware('dokter');
    Route::post("/dashboard/rekammedis", [RekamMedisController::class, "storeRekamMedis"])->middleware('dokter');
    Route::get("/dashboard/listpasien/rekammedis/{kodeRekammedis}", [RekamMedisController::class, "edit"])->middleware('dokter');
    Route::put("/dashboard/listpasien/rekammedis/{kodeRekammedis}", [RekamMedisController::class, "update"])->middleware('dokter');
    // surat rujukan
    Route::get("/dashboard/suratrujukan/form/{kodeRekamMedis}", [SuratRujukanController::class, "createSuratRujukan"])->middleware('dokter');
    Route::get('/dashboard/suratrujukan', [SuratRujukanController::class, "index"])->middleware('dokter');
    Route::get('/dashboard/suratrujukan/{kodeRujukan}', [SuratRujukanController::class, "show"]);
    Route::post("/dashboard/suratrujukan/{kode}", [SuratRujukanController::class, "storeSuratRujukan"])->middleware('dokter');
    // resep obat
    Route::get('/dashboard/resepobat/form/{kodeRekamMedis}', [ResepObatController::class, 'createResepObat'])->middleware("dokter");
    Route::get('/dashboard/resepobat', [ResepObatController::class, 'index'])->middleware('dokter');
    Route::get('/dashboard/resepobat/{kodeResepObat}', [ResepObatController::class, 'show']);
    Route::post("/dashboard/resepobat", [ResepObatController::class, 'storeResepObat'])->middleware("dokter");
    // pelayanan
    Route::get('/dashboard/pelayanan/form/{kodeRekammedis}', [PelayananController::class, 'createPelayanan'])->middleware('dokter');
    Route::post('/dashboard/pelayanan', [PelayananController::class, 'storePelayanan'])->middleware('dokter');


    //farmasi
    // add obat
    Route::resource('/dashboard/tambahobat', TambahObatController::class)->middleware('farmasi');
    // add category
    Route::get("/dashboard/tambahobatcategory", [TambahObatCategoryController::class, 'index'])->middleware('farmasi');
    Route::get('/dashboard/tambahobatcategory/create', [TambahObatCategoryController::class, 'create'])->middleware('farmasi');
    Route::post('/dashboard/tambahobatcategory', [TambahObatCategoryController::class, 'store'])->middleware('farmasi');
    Route::get('/dashboard/tambahobatcategory/edit/{obatCategory}', [TambahObatCategoryController::class, 'edit'])->middleware('farmasi');
    Route::put('/dashboard/tambahobatcategory/edit/{obatCategory}', [TambahObatCategoryController::class, 'update'])->middleware('farmasi');
    Route::delete('/dashboard/tambahobatcategory/delete/{obatCategory}', [TambahObatCategoryController::class, 'destroy'])->middleware('farmasi');
    Route::get("/dashboard/pasienObat", [AmbilObatController::class, 'pasienAmbilObat'])->middleware('farmasi');
    Route::get('/dashboard/ambilObat/{kodeResepObat}', [AmbilObatController::class, 'listObatPasien'])->middleware("farmasi");
    Route::put('/dashboard/ambilobat/s/{resepObat}', [AmbilObatController::class, 'changeStatus'])->middleware('farmasi');

    Route::get('/search/categoryobat', function (Request $request) {
        $output = "";
        $query = $request->input('query');
        $results = ObatCategory::where('name', 'like', '%' . $query . '%')->latest()->get();
        $output = '';
        foreach ($results as $key => $result) {
            $output .= '
            <tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $result->name . '</td>
                <td>' . $result->slug . '</td>
                <td>
                    <img style="width: 12rem" src="' . asset('storage/' . $result->image) . '" alt="...">
                </td>
                <td>
                <div class="d-flex">
                <a class="badge bg-primary border-0" href="/dashboard/tambahacategoryobat/edit/' . $result->id . '"><span data-feather="edit"></span></a> 
                <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm("Are you sure you want to delete this data?")) { deleteData({{ ' . $result->id . ' }}, {{' . ($key + 1) . '}}); }"><span data-feather="trash"></span></a>
            </div>
                </td>
            </tr>';
        }
        return response($output);
    })->name('search')->middleware('farmasi');

    // pasien dashboard
    Route::resource("/dashboard/antrian", AntrianDashboardController::class);
    Route::get("/dashboard/tiket", [PasienController::class, "getTIket"]);
    Route::delete('/dashboard/tiket/{kodeAntrian}', [PasienController::class, 'cancelAntrian']);
    Route::get('/check_tiket_status', [PasienController::class, "checkTiketStatus"])->name('check_tiket_status');
});
