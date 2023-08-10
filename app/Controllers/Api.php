<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AduanModel;
use App\Models\UserModel;
use App\Entities\User as EntitiesUser;

class Api extends BaseController
{
    protected $am;
    protected $um;
    protected $ac;
    protected $uc;

    protected $config;

    // -----------
    protected $attLogin;

    public function __construct()
    {
        $this->am = new AduanModel();
        $this->um = new UserModel();
        $this->ac = new \App\Controllers\Aduan();
        $this->uc = new \App\Controllers\User();

        $this->config = config('Auth');
    }

    public function index()
    {
        return redirect()->to('/');
    }

    public function aduan()
    {
        return $this->response->setJSON([
            'code' => 500,
            'success' => false,
            'message' => 'Terjadi kesalahan, silahkan coba lagi.',
        ]);
    }

    public function login()
    {
        $auth   = service('authentication');

        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->attLogin = false;

        if ($auth->attempt([$type => $login, 'password' => $password])) {
            $this->attLogin = true;
        }

        if ($this->attLogin) {
            $user = $this->um->where($type, $login)->first();
            $role = $this->um->getRole($user->id);

            if ($user->active) {
                return $this->response->setJSON([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Login berhasil',
                    'data' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'nama' => $user->nama,
                        'role' => $role->name,
                        'active' => $user->active,
                    ],
                ]);
            } else {
                return $this->response->setJSON([
                    'code' => 406,
                    'success' => false,
                    'message' => 'Akun anda belum aktif, silahkan hubungi admin.',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'code' => 401,
                'success' => false,
                'message' => 'Login gagal, nampaknya ada yang salah.',
            ]);
        }
    }

    public function register()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),

            'password' => date('dmY', strtotime($this->request->getPost('tanggal_lahir'))),
            'active' => 1
        ];

        $tanggal_lahir = strtotime($data['tanggal_lahir']);
        $tanggal_lahir = date('Y-m-d', $tanggal_lahir);

        $data['tanggal_lahir'] = $tanggal_lahir;

        $checkEmail = $this->um->where('email', $data['email'])->first();
        $checkUsername = $this->um->where('username', $data['username'])->first();

        if ($checkEmail) {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Email sudah terdaftar, silahkan gunakan email lain.',
            ]);
        } elseif ($checkUsername) {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Username sudah terdaftar, silahkan gunakan username lain.',
            ]);
        } else {
            $user = new EntitiesUser($data);
            $this->um->withGroup($this->config->defaultUserGroup)->insert($user);

            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Pendaftaran berhasil, silahkan login.',
            ]);
        }
    }

    public function reset_password()
    {
        $email = $this->request->getPost('email');
        $user = $this->um->where('email', $email)->first();

        if ($user) {
            $tanggal_lahir = strtotime($user->tanggal_lahir);
            $tanggal_lahir = date('dmY', $tanggal_lahir);

            $data = new EntitiesUser([
                'id' => $user->id,
                'password' => $tanggal_lahir,
            ]);

            if ($this->um->save($data)) {
                return $this->response->setJSON([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Password berhasil direset sesuai dengan format yang ditentukan.',
                ]);
            } else {
                return $this->response->setJSON([
                    'code' => 406,
                    'success' => false,
                    'message' => 'Password gagal direset, nampaknya ada yang salah.',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Email tidak terdaftar.',
            ]);
        }
    }

    public function repass()
    {
        $p = new \Myth\Auth\Password();
        
        $email = $this->request->getPost('email');
        $pass_lama = $this->request->getPost('pass_lama');
        $pass_baru = $this->request->getPost('pass_baru');

        $user = $this->um->where([
            'email' => $email,
        ])->first();

        if ($user) {
            if ($pass_baru !== '' | !empty($pass_baru) || $pass_baru !== null) {
                if($p->verify($pass_lama, $user->password_hash)) {
                    $data = new EntitiesUser([
                        'id' => $user->id,
                        'password' => $pass_baru,
                    ]);
    
                    if ($this->um->save($data)) {
                        return $this->response->setJSON([
                            'code' => 200,
                            'success' => true,
                            'message' => 'Password berhasil direset.',
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'code' => 406,
                            'success' => false,
                            'message' => 'Password gagal direset, nampaknya ada yang salah.',
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'code' => 406,
                        'success' => false,
                        'message' => 'Password lama tidak sesuai.',
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'code' => 406,
                    'success' => false,
                    'message' => 'Password baru tidak boleh kosong.',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Informasi yang anda masukkan salah, Pastikan email dan password lama anda benar',
            ]);
        }
    }

    public function aduan_create()
    {
        $bukti = $this->request->getFile('foto_aduan');
        $bukti_file_name = $bukti->getRandomName();

        $data = [
            'user_id' => $this->request->getPost('users'),
            'nomor' => rand(10000000, 99999999),
            'status' => 1,
            'tanggal' => $this->request->getPost('tanggal_kejadian'),
            'jenis' => $this->request->getPost('jenis_aduan'),
            'judul' => $this->request->getPost('judul'),
            'lokasi' => $this->request->getPost('lokasi'),
            'keterangan' => $this->request->getPost('keterangan'),
            'foto' => $bukti_file_name,
        ];

        if ($this->am->save($data)) {
            $bukti->move('foto_kejadian', $bukti_file_name);
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Aduan berhasil ditambahkan',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Aduan gagal ditambahkan, nampaknya ada yang salah.',
            ]);
        }
    }

    public function getAllAduanByUserId($user_id)
    {
        $aduan = $this->am->where('user_id', $user_id)->findAll();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getall($uid)
    {
        $aduan = $this->am->where('user_id', $uid)->findAll();
        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getlatest($uid)
    {
        $aduan = $this->am->where('user_id', $uid)->first();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbynomor($nomor)
    {
        $aduan = $this->ac->getByNum($nomor);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbyjenis($uid, $jenis)
    {
        $aduan = $this->am->where('user_id', $uid)->where('jenis', $jenis)->findAll();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getbystatus($uid, $status)
    {
        $aduan = $this->am->where('user_id', $uid)->where('status', $status)->findAll();
        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_getByYear($uid, $year)
    {
        $aduan = $this->am->where('user_id', $uid)->where('YEAR(tanggal)', $year)->orderBy('tanggal', 'DESC')->findAll();

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function aduan_chartYearly($year)
    {
        $aduan = $this->ac->chartYearly($year);

        return $this->response->setJSON([
            'code' => 200,
            'success' => true,
            'data' => $aduan,
        ]);
    }

    public function Aduan_update()
    {
        $data = $this->request->getPost();
        $aduan = $this->am->where('nomor', $data['nomor_aduan'])->first();

        $ready = [
            'id' => $aduan->id,
            'user_id' => $data['user_id'],
            'nomor' => $data['nomor_aduan'],
            'status' => $data['status'],
            'tanggal' => $data['tanggal_kejadian'],
            'jenis' => $data['jenis_aduan'],
            'judul' => $data['judul'],
            'lokasi' => $data['lokasi'],
            'keterangan' => $data['keterangan'],
        ];

        if ($this->am->save($ready)) {
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Aduan berhasil diubah',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Aduan gagal diubah',
            ]);
        }
    }

    public function aduan_updatestts()
    {
        $data = $this->request->getJSON();
        $aduan = $this->am->where('nomor', $data->nomor)->first();

        if ($this->am->save([
            'id' => $aduan->id,
            'status' => $data->status,
        ])) {
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Status aduan berhasil diubah',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Status aduan gagal diubah',
            ]);
        }
    }

    public function aduan_delete($nomor)
    {
        $aduan = $this->am->where('nomor', $nomor)->first();

        if ($this->am->delete($aduan->id)) {
            return $this->response->setJSON([
                'code' => 200,
                'success' => true,
                'message' => 'Aduan berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'code' => 406,
                'success' => false,
                'message' => 'Aduan gagal dihapus',
            ]);
        }
    }
}
