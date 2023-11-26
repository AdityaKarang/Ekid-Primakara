<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use Illuminate\Http\Request;

class DiagramPenelitianController extends Controller
{
    public function countPenelitian(Request $request){
        $dataIFAll = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataIFMining = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataIFTechnopreneur = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataIFIoT = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();
        
        $dataSIAll = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataSIMining = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataSITechnopreneur = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataSIIoT = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataSIAAll = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataSIAMining = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataSIATechnopreneur = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataSIAIoT = Penelitian::join('users', 'penelitians.user_id', '=', 'users.id')
        ->select('penelitians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataPengabdianIFAll = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataPengabdianIFMining = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataPengabdianIFTechnopreneur = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();

        $dataPengabdianIFIoT = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Teknik Informatika')
        ->count();
        
        $dataPengabdianSIAll = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataPengabdianSIMining = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataPengabdianSITechnopreneur = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataPengabdianSIIoT = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi')
        ->count();

        $dataPengabdianSIAAll = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataPengabdianSIAMining = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Data Mining")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataPengabdianSIATechnopreneur = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "Technopreneur")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $dataPengabdianSIAIoT = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', "IOT")
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', 'Sistem Informasi Akuntansi')
        ->count();

        $bidangFokusIF = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataIFTechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataIFIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataIFMining
            ],
        ];
        $bidangFokusSI = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataSITechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataSIIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataSIMining
            ],
        ];
        $bidangFokusSIA = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataSIATechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataSIAIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataSIAMining
            ],
        ];

        $penelitian = [
            [
                "type" => "IF",
                "prodi" => "Teknik Informatika",
                "data" => $dataIFAll,
                "bidangFokus" => $bidangFokusIF
            ],
            [
                "type" => "SI",
                "prodi" => "Sistem Informasi",
                "data" => $dataSIAll,
                "bidangFokus" => $bidangFokusSI
            ],
            [
                "type" => "SIA",
                "prodi" => "Sistem Informasi Akutansi",
                "data" => $dataSIAAll,
                "bidangFokus" => $bidangFokusSIA
            ]
        ];

        $bidangFokusPengabdianIF = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataPengabdianIFTechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataPengabdianIFIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataPengabdianIFMining
            ],
        ];
        $bidangFokusPengabdianSI = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataPengabdianSITechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataPengabdianSIIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataPengabdianSIMining
            ],
        ];
        $bidangFokusPengabdianSIA = [
            [
                "fokus" => "Technopreneur",
                "data" => $dataPengabdianSIATechnopreneur
            ],
            [
                "fokus" => "IOT",
                "data" => $dataPengabdianSIAIoT
            ],
            [
                "fokus" => "Data Mining",
                "data" => $dataPengabdianSIAMining
            ],
        ];

        $pengabdian = [
            [
                "type" => "IF",
                "prodi" => "Teknik Informatika",
                "data" => $dataPengabdianIFAll,
                "bidangFokus" => $bidangFokusPengabdianIF
            ],
            [
                "type" => "SI",
                "prodi" => "Sistem Informasi",
                "data" => $dataPengabdianSIAll,
                "bidangFokus" => $bidangFokusPengabdianSI
            ],
            [
                "type" => "SIA",
                "prodi" => "Sistem Informasi Akutansi",
                "data" => $dataPengabdianSIAAll,
                "bidangFokus" => $bidangFokusPengabdianSIA
            ]
        ];

        $response = [
            "tahunAkademik" => $request->tahun_akademik . "-" . $request->semester,
            "penelitian" => $penelitian,
            "pengabdian" => $pengabdian
        ];

        return response()->json($response);
    }
}
