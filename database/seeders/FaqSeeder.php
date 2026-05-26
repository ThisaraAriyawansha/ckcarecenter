<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Faq::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faqs = [

            // ── New Care365-specific FAQs (added) ──
            [
                'question' => 'What type of care does Care365 provide?',
                'answer' => 'Care365 provides residential elder care with 24/7 caregiver and nursing support. Our services include medical supervision, daily personal assistance, medication management, meals, housekeeping, and recreational activities.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Are nurses and caregivers available at all times?',
                'answer' => 'Yes. Trained caregivers are available around the clock, with qualified nurses overseeing medical needs and emergency response at all times.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How do admissions work?',
                'answer' => 'Admissions begin with a discussion with our care advisors to understand the resident’s needs. Once suitability is confirmed, we guide you through documentation, care planning, and room allocation in a clear and supportive manner.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Can families visit residents?',
                'answer' => 'Yes. Family visits are encouraged during designated visiting hours, ensuring residents maintain strong emotional connections while preserving a calm living environment.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Do you accept residents with medical conditions?',
                'answer' => 'We accommodate residents with varying medical needs, subject to assessment. This allows us to ensure we can safely and appropriately meet each resident’s care requirements.',
                'visibility' => 'public',
            ],
            [
                'question' => 'What meals are provided?',
                'answer' => 'Residents receive nutritious, well-balanced meals prepared according to dietary needs, medical conditions, and personal preferences.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How do you support families living overseas?',
                'answer' => 'We provide clear communication, updates when required, and a reliable local care team—so overseas family members can stay informed and confident about their loved one’s wellbeing.',
                'visibility' => 'public',
            ],

            // ── Original / general FAQs (kept) ──
            [
                'question' => 'What types of care services are provided?',
                'answer' => 'We offer a range of care services including assistance with activities of daily living, medication management, and specialized memory care.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Is there 24/7 staff available for assistance?',
                'answer' => 'Yes, our facility has 24/7 staff available to assist residents whenever needed.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How are medical needs handled? Is there a nurse on-site?',
                'answer' => 'We have trained staff who can handle basic medical needs, and a nurse is available onsite for more specialized care.',
                'visibility' => 'public',
            ],
            [
                'question' => 'What are the living arrangements like (private or shared rooms)?',
                'answer' => 'Residents have the option for both private and shared rooms, depending on their package preference and budget.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Are meals provided, and can dietary restrictions be accommodated?',
                'answer' => 'Nutritious meals are provided, and we can accommodate various dietary restrictions and preferences.',
                'visibility' => 'public',
            ],
            [
                'question' => 'What kinds of activities and amenities are available for residents?',
                'answer' => 'We offer a variety of activities and amenities such as exercise classes, social events, and recreational outings.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How is safety and security handled within the facility?',
                'answer' => 'Safety and security are top priorities; our facility is equipped with security systems and staff are trained in emergency procedures.',
                'visibility' => 'public',
            ],
            [
                'question' => 'What is the staff-to-resident ratio?',
                'answer' => 'Our staff-to-resident ratio is designed to ensure personalized care and attention for each resident.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Is transportation provided for appointments or outings?',
                'answer' => 'Transportation is provided for appointments and outings to ensure residents can access necessary services and activities. Extra charges may apply.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How are personal care needs like bathing and grooming assisted?',
                'answer' => 'Our staff is available to assist residents with personal care needs like bathing and grooming on a daily basis. Rates may vary based on special concerns or needs for additional care.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Can couples stay together in the same room or suite?',
                'answer' => 'Yes, couples can stay together in the same room or suite if they prefer. They can select a customizable package.',
                'visibility' => 'public',
            ],
            [
                'question' => 'What are the costs and payment options for care services?',
                'answer' => 'Costs vary depending on the level of care needed and the chosen living arrangements. We offer various payment options including private pay, insurance, and assistance programs. We accept bank transfers, all card types, and special discounts for foreign currency payments in USD/GBP.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Are there any wait lists or special requirements for admission?',
                'answer' => 'We do have wait lists at times, and there may be specific requirements for admission depending on the level of care needed.',
                'visibility' => 'public',
            ],
            [
                'question' => 'How are medications managed and administered?',
                'answer' => 'Medications are managed and administered by trained staff according to each resident\'s individual care plan.',
                'visibility' => 'public',
            ],
            [
                'question' => 'Can visitors come and go freely, or are there set visiting hours?',
                'answer' => 'Visitors are welcome to come and go freely during designated visiting hours, ensuring residents can stay connected with loved ones.',
                'visibility' => 'public',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        $this->command->info('✅ FAQs seeded successfully! (' . count($faqs) . ' records added)');
    }
}