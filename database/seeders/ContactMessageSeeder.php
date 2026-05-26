<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'John Perera',
                'email' => 'john.perera@example.com',
                'number' => '+94771234567',
                'subject' => 'Inquiry about admission',
                'message' => 'Hello, I would like to know about the admission process for my father.',
                'is_read' => false,
            ],
            [
                'name' => 'Mary Silva',
                'email' => 'mary.silva@example.com',
                'number' => '+94779876543',
                'subject' => 'Tour request',
                'message' => 'Hi, I would like to schedule a visit to the Care Home in Negombo.',
                'is_read' => false,
            ],
            [
                'name' => 'Nimal Fernando',
                'email' => 'nimal.fernando@example.com',
                'number' => '+94771239876',
                'subject' => 'Service enquiry',
                'message' => 'Can you provide more details about the physiotherapy programs?',
                'is_read' => false,
            ],
            [
                'name' => 'Sunethra Jayasinghe',
                'email' => 'sunethra.jayasinghe@example.com',
                'number' => '+94771231234',
                'subject' => 'Pricing details',
                'message' => 'Hello, please send me the pricing packages for long-term stay.',
                'is_read' => false,
            ],
            [
                'name' => 'Ravi de Silva',
                'email' => 'ravi.desilva@example.com',
                'number' => '+94779870123',
                'subject' => 'Feedback',
                'message' => 'I visited your Colombo branch and would like to provide feedback on your services.',
                'is_read' => false,
            ],
        ];

        foreach ($messages as $msg) {
            ContactMessage::create($msg);
        }
    }
}
