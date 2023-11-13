<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;

class DaftarAkunPasienController extends Controller
{
    public function index()
    {
        return view(
            'dashboard.daftarpasien.index',
            [
                'users' => User::where('is_admin', '=', 0)->latest()->get()
            ]
        );
    }

    public function search(Request $request)
    {
        $output = "";
        $query = $request->input('query');
        $results = User::where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('NIK', 'like', '%' . $query . '%');
        })
            ->where('is_admin', '=', 0)
            ->latest()
            ->get();
        foreach ($results as $key => $result) {
            $output .= '
        <tr>
            <td>' . ($key + 1) . '</td>
            <td>' . $result->NIK . '</td>
            <td>' . $result->name . '</td>
            <td>
            <div class="d-flex">
            <a class="badge m-1 bg-primary border-0" href="/dashboard/tambahacategoryobat/edit/' . $result->id . '"><span data-feather="edit"></span></a> 
            <a href="#" class="badge m-1 bg-danger border-0" onclick="if(confirm("Are you sure you want to delete this data?")) { deleteData({{ ' . $result->id . ' }}, {{' . ($key + 1) . '}}); }"><span data-feather="trash"></span></a>
        </div>
            </td>
        </tr>';
        }

        return response($output);
    }

    public function create()
    {
        return view("dashboard.daftarpasien.create", [
            'title' => 'Tambah User'
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
            'bpjs' => ($request->input('opsibpjs') === 'YA') ? 'required' : 'nullable',
            'username' => 'required|Min:3|Max:255|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'tgllahir' => 'required|date'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        // $validateData['password'] = Hash::make($validateData['password']); //fitur enskripsi laravel

        // Hitung umur dari tanggal lahir
        $tgllahir = new DateTime($validateData['tgllahir']);
        $today = new DateTime('today');
        $age = $tgllahir->diff($today)->y;



        // Tambahkan umur ke data yang akan disimpan ke database
        $validateData['age'] = $age;

        $user = User::create($validateData);


        // cek apakah dia is_admin = 2 (dokter)
        if ($validateData['is_admin'] == 2) {
            $dataDokter = [
                'name' => $user['name'],
                'userid' => $user['id']
            ];
            Dokter::create($dataDokter);
        }

        // dd('Registrasi Berhasil'); //ngecek data udah masuk apa blom
        return redirect('/dashboard/daftarpasien')->with('status', 'Akun Berhasil di Buat, Silahkan Login');
    }

    public function showUser($nik)
    {
        $query = User::where('nik', $nik)->firstOrFail();
        $output = "";

        $output .= '
        <div class="modal-body" style="display: flex; flex-direction:column">
            <div class="info-pair">
                <p class="title"><strong>Name:</strong></p>
                <p class="value">' . $query->name . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>NIK:</strong></p>
                <p class="value">' . $query->NIK . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>Alamat:</strong></p>
                <p class="value">' . $query->alamat . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>Kepala Keluarga:</strong></p>
                <p class="value">' . $query->kepalakeluarga . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>Opsi BPJS:</strong></p>
                <p class="value">' . $query->opsibpjs . '</p>';
        $output .= '</div>';
        if ($query->bpjs) {
            $output .= '<div class="info-pair">
                <p class="title"><strong>BPJS:</strong></p>
                <p class="value">' . $query->bpjs . '</p>
                </div>';
        }
        $output .= '<div class="info-pair">
                <p class="title"><strong>Username:</strong></p>
                <p class="value">' . $query->username . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>Email:</strong></p>
                <p class="value">' . $query->email . '</p>
            </div>
            <div class="info-pair">
                <p class="title"><strong>Tanggal Lahir:</strong></p>
                <p class="value">' . $query->tgllahir . '</p>
            </div>
        </div>
        
        <style>
        .info-pair {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
          }
          
          .title {
            margin-right: 10px;
          }
        </style>';

        return response($output);
    }
}
