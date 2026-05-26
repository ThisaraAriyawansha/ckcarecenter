<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: disable foreign key checks (usually not needed unless you have dependencies)
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing records
        Service::truncate();

        // Re-enable if you disabled above
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $services = [
            [
                'title'       => 'Medical Care',
                'description' => 'Embrace a world of comprehensive medical support tailored to your unique needs, with a team of dedicated professionals committed to delivering compassionate care and promoting your overall well-being.',
                'image_path'  => 'service_20260204153418_SFrSlEyO.jpg',
                'title_slug'  => 'medical-care',
                'is_public'   => true,
            ],
            [
                'title'       => 'Housekeeping/Laundry Services',
                'description' => 'Relax and enjoy a hassle-free lifestyle, with our attentive housekeeping and laundry services taking care of the daily tasks, allowing you to focus on what truly matters.',
                'image_path'  => 'service_20260204153617_lmhbb7Ub.jpg',
                'title_slug'  => 'housekeepinglaundry-services',
                'is_public'   => true,
            ],
            [
                'title'       => 'Nutritious Meals',
                'description' => 'Nourish your body and soul with our meticulously crafted meals, where every bite is a celebration of wholesome ingredients and culinary excellence, fueling your journey towards optimal health.',
                'image_path'  => 'service_20260204153648_0edCCC56.jpg',
                'title_slug'  => 'nutritious-meals',
                'is_public'   => true,
            ],
            [
                'title'       => 'Physical Therapy and Rehabilitation',
                'description' => 'Unlock your potential with our state-of-the-art physical therapy and rehabilitation services, expertly designed to help you regain strength, mobility, and independence.',
                'image_path'  => 'service_20260204153857_7LyfyIsN.jpg',
                'title_slug'  => 'physical-therapy-and-rehabilitation',
                'is_public'   => true,
            ],
            [
                'title'       => 'Social/Recreational Activities',
                'description' => 'Discover a vibrant tapestry of engaging social and recreational programs designed to ignite your passions, foster meaningful connections, and enrich your life with laughter, creativity, and personal growth.',
                'image_path'  => 'service_20260204154055_es8QYBKT.jpg',
                'title_slug'  => 'socialrecreational-activities',
                'is_public'   => true,
            ],
            [
                'title'       => 'Video Conferencing Facility',
                'description' => 'Stay connected with loved ones near and far through our cutting-edge video conferencing facilities, bridging distances and fostering meaningful connections.',
                'image_path'  => 'service_20260204154159_AEi0iL4B.jpg',
                'title_slug'  => 'video-conferencing-facility',
                'is_public'   => true,
            ],
            [
                'title'       => 'Transportation',
                'description' => 'Embark on seamless adventures beyond our doors with our reliable transportation services, ensuring your mobility needs are met with convenience and care.',
                'image_path'  => 'service_20260204154252_fk6A5yrL.jpg',
                'title_slug'  => 'transportation',
                'is_public'   => true,
            ],
            [
                'title'       => 'Music, Art Activities/Library Facilities',
                'description' => 'Ignite your creativity and expand your horizons with our vibrant array of music, art activities, and well-stocked library facilities, offering endless opportunities for personal growth and enrichment.',
                'image_path'  => 'service_20260204154340_c5Jsi6aZ.jpg',
                'title_slug'  => 'music-art-activitieslibrary-facilities',
                'is_public'   => true,
            ],
            [
                'title'       => '24-hour Staff Availability',
                'description' => 'Rest assured that your well-being is our top priority, with a dedicated team of professionals available around the clock to provide attentive care and unwavering support whenever you need it.',
                'image_path'  => 'service_20260204154426_T2cV4RZt.jpg',
                'title_slug'  => '24-hour-staff-availability',
                'is_public'   => true,
            ],
            [
                'title'       => 'Affordable Packages',
                'description' => 'Experience exceptional care without compromising affordability, with our thoughtfully designed packages that balance quality and cost-effectiveness.',
                'image_path'  => 'service_20260204154526_2W5jcDQq.jpg',
                'title_slug'  => 'affordable-packages',
                'is_public'   => true,
            ],
            [
                'title'       => 'Religious and Spiritual Support',
                'description' => 'Find solace in our nurturing environment that embraces diversity and provides a sanctuary for spiritual growth, where your beliefs are honored and celebrated.',
                'image_path'  => 'service_20260204154656_ZbRRNAoF.jpg',
                'title_slug'  => 'religious-and-spiritual-support',
                'is_public'   => true,
            ],
            [
                'title'       => 'Paralysis Care',
                'description' => 'Rediscover independence and empowerment with our compassionate paralysis care services, designed to support your unique needs and foster a life filled with dignity and quality.',
                'image_path'  => 'service_20260204154803_mr9BhUQU.jpg',
                'title_slug'  => 'paralysis-care',
                'is_public'   => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }

        $this->command->info('✅ Services seeded successfully! (' . count($services) . ' records)');
    }
}