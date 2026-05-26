<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin users to assign as handlers
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'manager']);
        })->pluck('id')->toArray();

        if (empty($adminUsers)) {
            $this->command->warn('No admin or manager users found. Please create users first.');
            return;
        }

        $enquiries = [
            [
                'name' => 'John Anderson',
                'email' => 'john.anderson@email.com',
                'phone' => '+44 20 7946 0958',
                'alternative_phone' => '+44 7700 900123',
                'address' => '15 Park Lane, London, SW1A 1AA',
                'joining_potential' => 'level_1',
                'status' => 'contacted',
                'follow_up_date' => now()->addDays(2),
                'requirements' => 'Looking for full-time residential care for elderly mother with mobility issues. Requires wheelchair accessibility and regular physiotherapy sessions.',
                'notes' => 'Very interested. Family is looking to move mother in within the next 2 weeks. Budget is not a concern.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah.williams@email.com',
                'phone' => '+44 20 7946 0234',
                'alternative_phone' => null,
                'address' => '42 High Street, Manchester, M1 2AB',
                'joining_potential' => 'level_1',
                'status' => 'scheduled',
                'follow_up_date' => now()->addDays(5),
                'requirements' => 'Needs respite care for father recovering from stroke. Looking for 2-3 weeks of intensive rehabilitation care.',
                'notes' => 'Visit scheduled for next week. Father currently in hospital, expected discharge in 4 days.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'Michael Thompson',
                'email' => 'michael.thompson@email.com',
                'phone' => '+44 20 7946 0567',
                'alternative_phone' => '+44 7700 900456',
                'address' => '78 Queen Street, Birmingham, B2 4QG',
                'joining_potential' => 'level_2',
                'status' => 'follow_up',
                'follow_up_date' => now()->addDays(7),
                'requirements' => 'Enquiring about dementia care services. Mother diagnosed with early-stage Alzheimer\'s. Family wants to explore options.',
                'notes' => 'Not urgent. Family is still deciding between home care and residential. Follow up next week with more information about our dementia program.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'Emma Davis',
                'email' => null,
                'phone' => '+44 20 7946 0789',
                'alternative_phone' => '+44 7700 900789',
                'address' => '23 Victoria Road, Leeds, LS1 6AA',
                'joining_potential' => 'level_2',
                'status' => 'contacted',
                'follow_up_date' => now()->addDays(3),
                'requirements' => 'Looking for day care services for husband with Parkinson\'s disease. Needs specialized care 3 days per week.',
                'notes' => 'Spoke with her today. Interested in our day program. Sending brochure and pricing information.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert.brown@email.com',
                'phone' => '+44 20 7946 0345',
                'alternative_phone' => null,
                'address' => '56 Station Road, Bristol, BS1 3QF',
                'joining_potential' => 'level_3',
                'status' => 'new',
                'follow_up_date' => null,
                'requirements' => 'General enquiry about care home services. Father is 82, currently independent but planning ahead.',
                'notes' => 'Left voicemail. Needs call back to discuss options and schedule a tour.',
                'handled_by' => null,
            ],
            [
                'name' => 'Jennifer Wilson',
                'email' => 'jennifer.wilson@email.com',
                'phone' => '+44 20 7946 0912',
                'alternative_phone' => '+44 7700 900234',
                'address' => '91 Church Lane, Liverpool, L1 2AB',
                'joining_potential' => 'level_1',
                'status' => 'converted',
                'follow_up_date' => null,
                'requirements' => 'Emergency placement needed for grandmother after hospital discharge. Requires 24/7 nursing care.',
                'notes' => 'Successfully admitted on Dec 15th. Family very satisfied with the care and facilities.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'David Martinez',
                'email' => 'david.martinez@email.com',
                'phone' => '+44 20 7946 0678',
                'alternative_phone' => null,
                'address' => '34 Market Street, Glasgow, G1 1PF',
                'joining_potential' => 'level_4',
                'status' => 'not_interested',
                'follow_up_date' => null,
                'requirements' => 'Was looking for palliative care services for terminal patient.',
                'notes' => 'Family decided to keep patient at home with hospice support. Thanked us for the information.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'Lisa Taylor',
                'email' => 'lisa.taylor@email.com',
                'phone' => '+44 20 7946 0445',
                'alternative_phone' => '+44 7700 900567',
                'address' => '67 Oak Avenue, Edinburgh, EH1 2NG',
                'joining_potential' => 'level_3',
                'status' => 'follow_up',
                'follow_up_date' => now()->addDays(14),
                'requirements' => 'Interested in short-term respite care for disabled son during family vacation. Needs specialized equipment and trained staff.',
                'notes' => 'Planning vacation for summer 2026. Just gathering information at this stage. Follow up in 2 weeks.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
            [
                'name' => 'James Robinson',
                'email' => null,
                'phone' => '+44 20 7946 0823',
                'alternative_phone' => null,
                'address' => '12 Castle Road, Cardiff, CF10 1BH',
                'joining_potential' => 'level_2',
                'status' => 'new',
                'follow_up_date' => now()->addDay(),
                'requirements' => 'Looking for care facility with diabetes management expertise. Mother has type 1 diabetes and mobility issues.',
                'notes' => 'New enquiry received today. Need to call tomorrow to discuss our diabetes care program.',
                'handled_by' => null,
            ],
            [
                'name' => 'Patricia Moore',
                'email' => 'patricia.moore@email.com',
                'phone' => '+44 20 7946 0556',
                'alternative_phone' => '+44 7700 900890',
                'address' => '89 River View, Newcastle, NE1 4ST',
                'joining_potential' => 'level_1',
                'status' => 'scheduled',
                'follow_up_date' => now()->addDays(4),
                'requirements' => 'Needs long-term care for husband with advanced Parkinson\'s and dementia. Family can no longer manage at home.',
                'notes' => 'Very urgent case. Scheduled assessment visit for this Friday. Family is emotionally exhausted and needs immediate placement.',
                'handled_by' => $adminUsers[array_rand($adminUsers)],
            ],
        ];

        foreach ($enquiries as $enquiryData) {
            Enquiry::create($enquiryData);
        }

        $this->command->info('Successfully created 10 enquiry records!');
    }
}
