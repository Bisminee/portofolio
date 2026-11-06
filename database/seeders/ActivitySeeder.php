<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        if (Activity::query()->exists()) {
            $this->command?->info('Activities already exist — skipping seed to preserve studio edits.');

            return;
        }

        $evidence = 'https://drive.google.com/drive/folders/1n2fDB7SzVXx_C0fcIGOA8__Puf13-U7U?usp=sharing';

        $activities = [
            [
                'slug' => 'robosarema-software-division',
                'name' => 'Robosarema — Search and Rescue Robotics Team',
                'type' => 'community',
                'organization' => 'Robosarema — Robotics Community',
                'role_en' => 'Software Division Member',
                'role_id' => 'Anggota Divisi Software',
                'start_date' => '2024-12-01',
                'end_date' => null,
                'is_ongoing' => true,
                'description_en' => 'Part of Robosarema, a robotics community developing a Search and Rescue (SAR) robot under the KRSRI competition guidelines. Worked in the Software Division with two other members on kinematics, object detection, inter-module communication, and the testing and refinement of search algorithms. Development used C, C++, and Python in a collaborative team process.',
                'description_id' => 'Menjadi bagian dari Robosarema, komunitas robotika yang berfokus pada pengembangan robot Search and Rescue (SAR) berdasarkan pedoman kompetisi KRSRI. Sebagai anggota Divisi Software bersama dua anggota lainnya, saya terlibat dalam pengembangan sistem perangkat lunak robot yang mencakup implementasi kinematika, Object Detection, komunikasi antar-modul, serta pengujian dan penyempurnaan algoritma pencarian. Proses pengembangan dilakukan menggunakan bahasa pemrograman C, C++, dan Python dengan pendekatan kolaboratif antara anggota tim.',
                'highlights_en' => [
                    'Contributed to the SAR robot software alongside the software team.',
                    'Worked on kinematics, object detection, and inter-module communication.',
                    'Tested and refined search algorithms through iterative trials.',
                ],
                'highlights_id' => [
                    'Berkontribusi pada perangkat lunak robot SAR bersama tim software.',
                    'Terlibat dalam pengembangan kinematika, Object Detection, dan komunikasi antar-modul.',
                    'Menguji dan menyempurnakan algoritma pencarian melalui iterasi pengujian.',
                ],
                'technologies' => ['C', 'C++', 'Python', 'Robotics / Kinematics', 'Object Detection', 'Inter-module Communication'],
                'team_type' => 'team',
                'evidence_url' => $evidence,
                'image_path' => 'robosarema-logo.webp',
                'gallery' => ['robosarema-arena.webp', 'robosarema-work.webp'],
                'image_alt_en' => 'Robosarema Search and Rescue Robot team logo.',
                'image_alt_id' => 'Logo tim Search and Rescue Robot Robosarema.',
                'related_slug' => 'robotic-unlimited-2026',
                'priority' => 1,
            ],
            [
                'slug' => 'plfm-manager-off-air',
                'name' => 'Steering Committee — Manager Off Air',
                'type' => 'organization',
                'organization' => 'PL FM — Campus Radio Organization',
                'role_en' => 'Steering Committee — Manager Off Air',
                'role_id' => 'Steering Committee — Manager Off Air',
                'start_date' => '2026-03-01',
                'end_date' => null,
                'is_ongoing' => true,
                'description_en' => "Served as Manager Off Air on PL FM's Steering Committee, directing and coordinating three sub-divisions: Marketing, Public Relations, and Creative Media. The role covered work-programme alignment, monitoring divisional delivery, and cross-division coordination with other managers so that organizational activities and needs ran as one integrated system.",
                'description_id' => 'Mengemban amanah sebagai Manager Off Air dalam struktur Steering Committee PL FM dengan tanggung jawab mengarahkan dan mengoordinasikan tiga sub-divisi, yaitu Marketing, Humas, dan Creative Media. Peran ini juga mencakup penyelarasan program kerja, pemantauan pelaksanaan tugas divisi, serta koordinasi lintas divisi bersama para manager lainnya guna memastikan setiap kegiatan dan kebutuhan organisasi dapat berjalan secara terintegrasi.',
                'highlights_en' => [
                    'Coordinated the Marketing, Public Relations, and Creative Media sub-divisions.',
                    'Directed internal Off Air tasks and divisional needs.',
                    'Maintained cross-division coordination with other managers.',
                ],
                'highlights_id' => [
                    'Mengoordinasikan tiga sub-divisi: Marketing, Humas, dan Creative Media.',
                    'Mengarahkan pelaksanaan tugas dan kebutuhan internal Divisi Off Air.',
                    'Menjalin koordinasi lintas divisi bersama manager lainnya.',
                ],
                'technologies' => null,
                'team_type' => 'leadership',
                'evidence_url' => $evidence,
                'image_path' => 'plfm-logo.webp',
                'gallery' => ['plfm-off-air-meeting.webp', 'plfm-off-air-meeting-2.webp'],
                'image_alt_en' => 'PL FM campus radio logo.',
                'image_alt_id' => 'Logo Radio Kampus PL FM.',
                'related_slug' => null,
                'priority' => 2,
            ],
            [
                'slug' => 'robotic-unlimited-2026',
                'name' => 'ROBOTIC UNLIMITED 2026',
                'type' => 'competition',
                'organization' => 'Universitas Diponegoro (UNDIP) — ROBOTIC UNLIMITED 2026',
                'role_en' => 'Competition Participant — Robosarema Software Division',
                'role_id' => 'Peserta Kompetisi — Divisi Software Robosarema',
                'start_date' => '2026-09-18',
                'end_date' => '2026-09-18',
                'is_ongoing' => false,
                'description_en' => "Participated in ROBOTIC UNLIMITED 2026, organized by Universitas Diponegoro (UNDIP), on 18 September 2026 as part of the Robosarema team. The event brought the team's SAR robot development into a competitive setting and required close collaboration across the team.",
                'description_id' => 'Mengikuti kompetisi ROBOTIC UNLIMITED 2026 yang diselenggarakan oleh Universitas Diponegoro (UNDIP) pada 18 September 2026 sebagai bagian dari tim Robosarema. Keikutsertaan ini menjadi kesempatan untuk membawa pengalaman pengembangan robot SAR ke dalam lingkungan kompetisi serta berkolaborasi bersama tim dalam menghadapi tantangan di bidang robotika.',
                'highlights_en' => [
                    'Participated in ROBOTIC UNLIMITED 2026 as a member of the Robosarema team.',
                    'Brought SAR robot software development experience into a competitive setting.',
                    'Collaborated with team members throughout the competition.',
                ],
                'highlights_id' => [
                    'Berpartisipasi dalam ROBOTIC UNLIMITED 2026 sebagai anggota tim Robosarema.',
                    'Membawa pengalaman pengembangan perangkat lunak robot SAR ke ajang kompetisi robotika.',
                    'Berkolaborasi dengan anggota tim dalam kegiatan kompetisi.',
                ],
                'technologies' => null,
                'team_type' => 'team',
                'evidence_url' => $evidence,
                'image_path' => 'unlimited-2026-team.webp',
                'gallery' => null,
                'image_alt_en' => 'The Robosarema team at the ROBOTIC UNLIMITED 2026 competition.',
                'image_alt_id' => 'Tim Robosarema di kompetisi ROBOTIC UNLIMITED 2026.',
                'related_slug' => 'robosarema-software-division',
                'priority' => 3,
            ],
            [
                'slug' => 'polinema-mengajar',
                'name' => 'Polinema Mengajar',
                'type' => 'community',
                'organization' => 'Polinema Mengajar — Social and Educational Community',
                'role_en' => 'Graphic Design Staff — Media Information Division (Medinfo)',
                'role_id' => 'Staff Desain Grafis — Divisi Media Informasi (Medinfo)',
                'start_date' => '2025-12-01',
                'end_date' => '2026-11-30',
                'is_ongoing' => false,
                'description_en' => 'Contributed to Polinema Mengajar, a community focused on social and educational initiatives. As part of the Media Information (Medinfo) division, produced non-video visual assets for publications and information delivery. Also took part directly in teaching activities with children at Rumah Belajar JKJT.',
                'description_id' => 'Berkontribusi dalam komunitas Polinema Mengajar yang berfokus pada kegiatan sosial dan pemberdayaan masyarakat melalui bidang pendidikan. Sebagai bagian dari Divisi Media Informasi (Medinfo), saya bertanggung jawab dalam mengolah kebutuhan visual non-video untuk mendukung publikasi dan penyampaian informasi komunitas. Selain berkontribusi melalui bidang desain grafis, saya juga memperoleh kesempatan untuk terlibat langsung dalam kegiatan pengajaran bersama anak-anak di Rumah Belajar JKJT.',
                'highlights_en' => [
                    'Produced non-video visual assets for community information and publications.',
                    'Took part directly in teaching activities at Rumah Belajar JKJT.',
                    'Contributed to social activities oriented toward community education.',
                ],
                'highlights_id' => [
                    'Menghasilkan materi visual non-video untuk kebutuhan informasi dan publikasi komunitas.',
                    'Berpartisipasi secara langsung dalam kegiatan pengajaran di Rumah Belajar JKJT.',
                    'Berkontribusi dalam kegiatan sosial yang berorientasi pada pendidikan masyarakat.',
                ],
                'technologies' => null,
                'team_type' => 'team',
                'evidence_url' => $evidence,
                'image_path' => 'polinema-logo.webp',
                'gallery' => ['polinema-mengajar-wellness.webp', 'polinema-mengajar-oday.webp'],
                'image_alt_en' => 'Polinema Mengajar logo.',
                'image_alt_id' => 'Logo Polinema Mengajar.',
                'related_slug' => null,
                'priority' => 4,
            ],
            [
                'slug' => 'plfm-creative-media',
                'name' => 'Staff Creative Media — PL FM',
                'type' => 'organization',
                'organization' => 'PL FM — Campus Radio Organization',
                'role_en' => 'Creative Media Staff — Spotify & Social Media Content',
                'role_id' => 'Staff Creative Media — Konten Spotify & Media Sosial',
                'start_date' => '2025-03-01',
                'end_date' => '2026-01-31',
                'is_ongoing' => false,
                'description_en' => "Worked in PL FM's Creative Media division, managing visual and social media content with a focus on the organization's Spotify channel. Produced and edited Memorial Day material, podcast covers, TikTok content, and visual assets for What's Going On, a programme presenting information and news.",
                'description_id' => 'Menjadi bagian dari divisi Creative Media PL FM yang berfokus pada pengelolaan kebutuhan visual dan konten media sosial organisasi, khususnya pada kanal Spotify. Selama masa kepengurusan, saya terlibat dalam proses pengolahan dan penyuntingan berbagai materi kreatif, mulai dari konten Memorial Day dan cover podcast hingga konten TikTok serta materi visual program What’s Going On yang menyajikan informasi dan berita.',
                'highlights_en' => [
                    'Produced visual material for Memorial Day content.',
                    'Designed podcast covers for Spotify publication.',
                    'Edited TikTok content and visual assets for What’s Going On.',
                ],
                'highlights_id' => [
                    'Mengolah materi visual untuk konten Memorial Day.',
                    'Membuat cover podcast untuk kebutuhan publikasi Spotify.',
                    'Mengedit konten TikTok dan materi visual program What’s Going On.',
                ],
                'technologies' => null,
                'team_type' => 'team',
                'evidence_url' => $evidence,
                'image_path' => 'plfm-logo.webp',
                'gallery' => ['plfm-creative-mday.webp', 'plfm-creative-waisak.webp'],
                'image_alt_en' => 'PL FM campus radio logo.',
                'image_alt_id' => 'Logo Radio Kampus PL FM.',
                'related_slug' => null,
                'priority' => 5,
            ],
            [
                'slug' => 'kangdjoe-keju-artisan',
                'name' => 'Product Marketing Team — Kangdjoe (now Keju Artisan)',
                'type' => 'organization',
                'organization' => 'Kangdjoe (now Keju Artisan)',
                'role_en' => 'Marketing Team Member',
                'role_id' => 'Anggota Tim Marketing',
                'start_date' => '2025-06-01',
                'end_date' => '2025-10-31',
                'is_ongoing' => false,
                'description_en' => 'Worked with the Kangdjoe marketing team, now known as Keju Artisan, supporting digital marketing and product promotion. Produced visual content for the Instagram feed, promotional TikTok content, and product photography for publication and marketing materials.',
                'description_id' => 'Terlibat sebagai bagian dari tim Marketing Kangdjoe, yang kini dikenal sebagai Keju Artisan, dengan fokus mendukung aktivitas pemasaran dan promosi produk melalui media digital. Kontribusi saya mencakup perancangan konten visual untuk feed Instagram, produksi konten promosi TikTok, serta pemotretan produk sebagai materi pendukung kebutuhan publikasi dan pemasaran.',
                'highlights_en' => [
                    'Designed visual content for the Instagram product feed.',
                    'Produced promotional content for TikTok.',
                    'Photographed products for marketing materials.',
                ],
                'highlights_id' => [
                    'Merancang konten visual feed Instagram untuk promosi produk.',
                    'Membuat konten promosi melalui platform TikTok.',
                    'Melakukan photoshoot produk untuk kebutuhan materi pemasaran.',
                ],
                'technologies' => null,
                'team_type' => 'team',
                'evidence_url' => $evidence,
                'image_path' => 'keju-artisan-cheese-pull.webp',
                'gallery' => ['keju-artisan-halloumi.webp'],
                'image_alt_en' => 'Product photography for Keju Artisan, showing a cheese pull from a fried cheese portion.',
                'image_alt_id' => 'Foto produk Keju Artisan yang memperlihatkan keju meleleh dari potongan gorengan.',
                'related_slug' => null,
                'priority' => 6,
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create([
                ...$activity,
                'permission_status' => 'approved_by_owner',
                'is_published' => true,
                'location' => null,
                'work_format' => null,
            ]);
        }
    }
}
