<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareHome;

class CareHomeSeeder extends Seeder
{
    public function run(): void
    {
        $careHomes = [
            [
                'title' => 'Care Home | Negombo',
                'subtitle' => 'Pinnacle 365',
                'location' => 'Negombo',
                'description' => 'Our Luxury Care Home featuring Individual Rooms On-site with 24/7 medical support and personalized care.',
                'image_path' => 'carehome_20260120060144_0CQPkmwH.jpg',
                'contact_no' => '+94776604040',
                'badge_text' => 'Care Home',
                'is_public' => true,
            ],
            [
                'title' => 'Care Home | Colombo',
                'subtitle' => 'Admission Open',
                'location' => 'Colombo',
                'description' => 'We currently operate from our Thalawathugoda, Hokandara branch with state-of-the-art facilities for senior living.',
                'image_path' => 'carehome_20260120060307_0KQGeU2r.jpg',
                'contact_no' => '+94776604040',
                'badge_text' => 'Admission Open',
                'is_public' => true,
            ],
            [
                'title' => 'Care Home | Kandy',
                'subtitle' => 'Constructions in Progress',
                'location' => 'Kandy',
                'description' => 'Exciting times are ahead as Care365 prepares to open our Kandy branch with modern facilities and premium care.',
                'image_path' => 'carehome_20260120060400_PcE8q9tN.jpg',
                'contact_no' => '+94776604040',
                'badge_text' => 'Constructions in Progress',
                'is_public' => true,
            ],
        ];

        foreach ($careHomes as $home) {
            CareHome::create($home);
        }
    }
}
