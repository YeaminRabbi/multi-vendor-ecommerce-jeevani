<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $timestamp = now();
        
        // Social Links
        $socialLinks = [
            ['group' => 'social_links', 'name' => 'facebook', 'payload' => '"https://www.facebook.com/"'],
            ['group' => 'social_links', 'name' => 'instagram', 'payload' => '"https://www.instagram.com/"'],
            ['group' => 'social_links', 'name' => 'twitter', 'payload' => '"https://twitter.com/"'],
            ['group' => 'social_links', 'name' => 'linkedin', 'payload' => '"https://www.linkedin.com/"'],
            ['group' => 'social_links', 'name' => 'youtube', 'payload' => '"https://www.youtube.com/"'],
            ['group' => 'social_links', 'name' => 'pinterest', 'payload' => '"https://www.pinterest.com/"'],
        ];

        // Footer Basic Information
        $footerInfo = [
            ['group' => 'footer', 'name' => 'footer_email', 'payload' => '"example@gmail.com"'],
            ['group' => 'footer', 'name' => 'footer_address', 'payload' => '"Dhaka, Bangladesh"'],
            ['group' => 'footer', 'name' => 'footer_phone', 'payload' => '"017******"'],
            ['group' => 'footer', 'name' => 'footer_about', 'payload' => '"Your eCommerce site description goes here."'],

        ];

        // Important Links
        $importantLinks = [
            ['group' => 'important_links', 'name' => 'category_page', 'payload' => '"https://example.com/categories"'],
            ['group' => 'important_links', 'name' => 'contact_page', 'payload' => '"https://example.com/contact"'],
            ['group' => 'important_links', 'name' => 'about_us', 'payload' => '"https://example.com/about"'],
            ['group' => 'important_links', 'name' => 'faq_page', 'payload' => '"https://example.com/faq"'],
            ['group' => 'important_links', 'name' => 'return_policy', 'payload' => '"https://example.com/return-policy"'],
            ['group' => 'important_links', 'name' => 'customer_support', 'payload' => '"https://example.com/support"'],
            ['group' => 'important_links', 'name' => 'newsletter_signup', 'payload' => '"https://example.com/newsletter-signup"'],
            ['group' => 'important_links', 'name' => 'store_locations', 'payload' => '"https://example.com/stores"'],
            ['group' => 'important_links', 'name' => 'cookie_policy', 'payload' => '"https://example.com/cookie-policy"'],
            ['group' => 'important_links', 'name' => 'feedback_form', 'payload' => '"https://example.com/feedback"'],
            ['group' => 'important_links', 'name' => 'footer_terms_conditions', 'payload' => '"https://example.com/terms"'],
            ['group' => 'important_links', 'name' => 'footer_privacy_policy', 'payload' => '"https://example.com/privacy"'],
        ];

        // Insert Data into the Database
       $this->insertWithTimestamps($socialLinks, $timestamp);
       $this->insertWithTimestamps($footerInfo, $timestamp);
       $this->insertWithTimestamps($importantLinks, $timestamp);
    }

    protected function insertWithTimestamps(array $data, $timestamp)
    {
        foreach ($data as &$item) {
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
        }

        DB::table('settings')->insert($data);
    }

}
