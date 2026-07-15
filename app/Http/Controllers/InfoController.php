<?php

namespace App\Http\Controllers;

class InfoController extends Controller
{
    /**
     * Static content for the informational footer pages.
     * Keyed by slug used in the route (e.g. /info/tentang-kami).
     */
    protected function pages(): array
    {
        return [
            'tentang-kami' => [
                'title' => 'Tentang Kami',
                'paragraphs' => [
                    'BengTix adalah platform tiket event yang membantu kamu menemukan dan memesan tiket konser, seminar, workshop, dan berbagai acara lainnya dengan mudah dan cepat.',
                    'Kami berkomitmen menghadirkan pengalaman pembelian tiket yang aman, transparan, dan bebas ribet — baik untuk penonton maupun untuk penyelenggara event.',
                    'Dari event kecil komunitas hingga konser besar, BengTix hadir untuk mendekatkan kamu dengan momen-momen yang layak dirayakan.',
                ],
            ],
            'syarat-ketentuan' => [
                'title' => 'Syarat dan Ketentuan',
                'paragraphs' => [
                    'Dengan menggunakan layanan BengTix, kamu setuju untuk memberikan data pemesanan yang benar dan bertanggung jawab atas keamanan akunmu sendiri.',
                    'Tiket yang sudah dibeli tunduk pada kebijakan masing-masing penyelenggara event, termasuk terkait pembatalan, penukaran, dan refund.',
                    'BengTix berhak menonaktifkan akun yang terindikasi melakukan penyalahgunaan sistem, termasuk namun tidak terbatas pada percobaan penipuan atau manipulasi harga tiket.',
                    'Ketentuan ini dapat diperbarui sewaktu-waktu; penggunaan layanan setelah pembaruan dianggap sebagai persetujuan atas ketentuan terbaru.',
                ],
            ],
            'kebijakan-privasi' => [
                'title' => 'Kebijakan Privasi',
                'paragraphs' => [
                    'BengTix mengumpulkan data pribadi seperti nama, email, dan nomor HP hanya untuk keperluan proses pemesanan tiket dan komunikasi terkait akunmu.',
                    'Kami tidak menjual data pribadi pengguna kepada pihak ketiga. Data hanya dibagikan kepada penyelenggara event sebatas yang diperlukan untuk validasi tiket di lokasi acara.',
                    'Kamu dapat meminta penghapusan akun dan data pribadimu kapan saja melalui halaman Profile atau dengan menghubungi tim kami.',
                ],
            ],
        ];
    }

    public function show(string $slug)
    {
        $pages = $this->pages();

        abort_unless(array_key_exists($slug, $pages), 404);

        return view('pages.info', $pages[$slug]);
    }
}
