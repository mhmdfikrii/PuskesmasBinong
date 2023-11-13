<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Mailjet\Client;
use \Mailjet\Resources;
// use Illuminate\Support\Facades\Hash; //fitur enskripsi laravel

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|Min:3|Max:255',
            'NIK' => 'required|unique:users|Min:16|Max:255',
            'alamat' => 'required|Min:3|Max:255',
            'kepalakeluarga' => 'required|Min:3|Max:255',
            'opsibpjs' => 'required',
            'is_admin' => 'required',
            'cek' => 'required',
            'bpjs' => ($request->input('opsibpjs') === 'YA') ? 'required|unique:users,bpjs|Min:8|Max:20' : 'nullable',
            'username' => 'required|Min:3|Max:255|unique:users',
            'email' => 'required|unique:users',
            'password' => 'nullable|min:6|required_with:confirm_password|same:confirm_password',
            'tgllahir' => 'required|date'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        // $validateData['password'] = Hash::make($validateData['password']); //fitur enskripsi laravel
        // check dia punya bpjs atau tidak
        $validateData['cek'] = 3;

        // Hitung umur dari tanggal lahir
        $tgllahir = new DateTime($validateData['tgllahir']);
        $today = new DateTime('today');
        $age = $tgllahir->diff($today)->y;

        // Tambahkan umur ke data yang akan disimpan ke database
        $validateData['age'] = $age;

        // ddd($validateData);

        // kirim email 
        $user = User::create($validateData);
        $this->sendEmail($user->id, $user->email);


        // dd('Registrasi Berhasil'); //ngecek data udah masuk apa blom
        return redirect('/login')->with('status', 'Akun Anda Berhasil di Buat, Silahkan verifikasi email anda');
    }

    function sendEmail($userId, $userEmail)
    {
        $tokenVerif = $userId . "-" . time();
        $mj = new Client('177a3a51988d43f5512cf71bff810623', '0ae5670198a5119bb03593478a4affd7');
        $body = [
            'FromEmail' => "gozza15bdg@gmail.com",
            'FromName' => "Admin Puskesmas",
            'Subject' => "Verification Email",
            'Text-part' => "kepaada Pasien Puskesmas Binont, Selamat Datang silahkan klik link berikut untuk verifikasi akun anda!",
            'Html-part' => "<h3>Link Verifikasi <a href=\"http://127.0.0.1:8000/verifEmail/" . $tokenVerif . "\">Mailjet</a>!<br />May the delivery force be with you!",
            'Recipients' => [
                [
                    'Email' => $userEmail
                ]
            ]
        ];

        $data = [
            'user_id' => $userId,
            'token_verif' => $tokenVerif,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::insert('insert into account_verif values(?, ?, ?, ?, ? ,?)', [null, $data['user_id'], $data['token_verif'],  '0', $data['created_at'], $data['updated_at']]);
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }

    public function verifEmail($token)
    {
        $user = DB::table('account_verif')->where('token_verif', $token)->first();
        $getUser = User::where('id', $user->user_id)->first();
        if ($user) {
            if ($getUser->bpjs != null) {
                User::where('id', $user->user_id)->update(['cek' => 2]);
            } else {
                User::where('id', $user->user_id)->update(['cek' => 1]);
            }
            DB::table('account_verif')->where('token_verif', $token)->delete();
            return redirect('/login')->with('status', 'Akun Anda Berhasil di Verifikasi, Silahkan Login');
        } else {
            return redirect('/login')->with('status', 'Akun Anda Gagal di Verifikasi, Silahkan Register Ulang');
        }
    }
}
