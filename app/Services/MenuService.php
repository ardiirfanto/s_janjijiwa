<?php

namespace App\Services;

class MenuService
{

    public static function get()
    {
        $menu = [
            [
                "menu" => "Halaman Utama",
                "icon" => "icon-home",
                "route" => "home",
                "index" => "home",
                "tipe" => "1"
            ],
            [
                "menu" => "Kelola Data",
                "icon" => "icon-graph",
                "tipe" => "2",
                "index" => "data",
                "sub" => [
                    [
                        "sub-menu" => "Data Training",
                        "sub-route" => "data.training"
                    ],
                    [
                        "sub-menu" => "Kata Dihilangkan",
                        "sub-route" => "data.stopwords"
                    ]
                ]
            ],
            [
                "menu" => "Uji Klasifikasi",
                "icon" => "icon-accelerator",
                "tipe" => "2",
                "index" => "uji",
                "sub" => [
                    [
                        "sub-menu" => "Tambah Pengujian",
                        "sub-route" => "uji.testing"
                    ],
                    [
                        "sub-menu" => "Proses Pengujian",
                        "sub-route" => "uji.proses"
                    ]
                ]
            ],
        ];

        // dd($menu[1]['sub']);

        return $menu;
    }
}
