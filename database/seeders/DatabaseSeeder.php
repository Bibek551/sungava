<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $items = [
            ['site_main_logo', Null],
            ['site_footer_logo', Null],
            ['fav_icon', null],
            ['affiliated_image', null],
            ['coe_image', null],
            ['site_information', 'Sungava'],
            ['map', 'Sungava Map'],
            ['site_contact', '9800000000'],
            ['site_email', 'info@sungava.com'],
            ['site_location', 'Kathmandu, Nepal'],
            ['site_location_url', 'https://sungava.com'],
            ['site_copyright', '2024 All right Reserved'],
            ['why_book_with_us', null],

            ['homepage_country_section_description', 'Country Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['homepage_course_section_description', 'Course Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['homepage_blog_section_description', 'Blog Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['ourteam_section_description', 'Ourteam Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['service_section_description', 'Service Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['about_section_description', 'Service Ipsum is simply dummy text of the printing and typesetting industry.'],

            ['destination_title', ''],
            ['destination_slogan', ''],
            ['testimonial_title', ''],
            ['testimonial_slogan', ''],
            ['about_title', ''],
            ['team_title', ''],
            ['team_slogan', ''],
            ['package_title', ''],
            ['blog_title', ''],

            ['homepage_seo_title', 'Sungava'],
            ['homepage_seo_description', 'Sungava'],
            ['homepage_seo_keywords', 'Sungava'],
            ['banner_image', null],
            ['banner_title', 'Explore the world with Sungava'],
            ['banner_description', "Enjoy every step of the journey and record stories of the world's ost beautiful landscapes with us."],

            ['service_image', null],
            ['service_title', 'Our Servces'],
            ['service_description', "We Provide the best services at a reasonable price here at Sungava."],

            ['aboutpage_seo_title', 'Sungava'],
            ['aboutpage_seo_description', 'Sungava'],
            ['aboutpage_seo_keywords', 'Sungava'],
            ['about_page_image', null],

            ['contactpage_seo_title', 'Sungava'],
            ['contactpage_seo_description', 'Sungava'],
            ['contactpage_seo_keywords', 'Sungava'],
            ['contact_page_image', null],

            ['destinationpage_seo_title', 'Sungava'],
            ['destinationpage_seo_description', 'Sungava'],
            ['destinationpage_seo_keywords', 'Sungava'],
            ['destination_page_image', null],
        ];

        if (count($items)) {
            foreach ($items as $item) {
                \App\Models\Setting::create([
                    'key' => $item[0],
                    'value' => $item[1],
                ]);
            }
        }

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@sungava.com',
            'password' => Hash::make('password'),
        ]);
    }
}
