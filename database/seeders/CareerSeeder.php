<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get branches
        $branches = Branch::all();

        if ($branches->isEmpty()) {
            $this->command->warn('No branches found. Please create branches first.');
            return;
        }

        // Get admin/manager users for supervisors
        $supervisors = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'manager']);
        })->pluck('id')->toArray();

        if (empty($supervisors)) {
            $this->command->warn('No admin or manager users found.');
            $supervisors = [null];
        }

        $careers = [
            [
                'full_name' => 'Nimal Perera',
                'email' => 'nimal.perera@ckhomecare.lk',
                'phone' => '+94 77 123 4567',
                'employee_id' => 'CR-001',
                'job_title' => 'Senior Care Assistant',
                'gender' => 'male',
                'date_of_birth' => '1985-03-15',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '850751234V',
                'current_address' => '45/1, Galle Road, Colombo 03',
                'city' => 'Colombo',
                'postal_code' => '00300',
                'emergency_contact_name' => 'Kumari Perera',
                'emergency_contact_relationship' => 'Wife',
                'emergency_contact_phone' => '+94 77 234 5678',
                'joining_date' => '2020-01-15',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 45000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Bank of Ceylon',
                'bank_account_number' => '1234567890',
                'bank_branch' => 'Colombo Fort',
                'highest_qualification' => 'Diploma in Care Management',
                'years_of_experience' => 8,
                'certifications' => 'First Aid Certificate, Dementia Care Training',
            ],
            [
                'full_name' => 'Sanduni Silva',
                'email' => 'sanduni.silva@ckhomecare.lk',
                'phone' => '+94 71 234 5678',
                'employee_id' => 'CR-002',
                'job_title' => 'Care Assistant',
                'gender' => 'female',
                'date_of_birth' => '1992-07-22',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '927234567V',
                'current_address' => '12, Temple Road, Kandy',
                'city' => 'Kandy',
                'postal_code' => '20000',
                'emergency_contact_name' => 'Ranjith Silva',
                'emergency_contact_relationship' => 'Father',
                'emergency_contact_phone' => '+94 71 345 6789',
                'joining_date' => '2021-06-01',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 38000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'People\'s Bank',
                'bank_account_number' => '2345678901',
                'bank_branch' => 'Kandy',
                'highest_qualification' => 'Certificate in Elderly Care',
                'years_of_experience' => 4,
                'certifications' => 'Manual Handling, Infection Control',
            ],
            [
                'full_name' => 'Kamal Fernando',
                'email' => 'kamal.fernando@ckhomecare.lk',
                'phone' => '+94 76 345 6789',
                'employee_id' => 'CR-003',
                'job_title' => 'Care Assistant',
                'gender' => 'male',
                'date_of_birth' => '1988-11-10',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '883141234V',
                'current_address' => '67, Beach Road, Galle',
                'city' => 'Galle',
                'postal_code' => '80000',
                'emergency_contact_name' => 'Dilini Fernando',
                'emergency_contact_relationship' => 'Wife',
                'emergency_contact_phone' => '+94 76 456 7890',
                'joining_date' => '2019-09-15',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 42000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Commercial Bank',
                'bank_account_number' => '3456789012',
                'bank_branch' => 'Galle',
                'highest_qualification' => 'Diploma in Nursing Care',
                'years_of_experience' => 6,
                'certifications' => 'First Aid, Safeguarding Adults',
            ],
            [
                'full_name' => 'Priyanka Jayawardena',
                'email' => 'priyanka.j@ckhomecare.lk',
                'phone' => '+94 70 456 7890',
                'employee_id' => 'CR-004',
                'job_title' => 'Senior Care Assistant',
                'gender' => 'female',
                'date_of_birth' => '1986-05-18',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '861391234V',
                'current_address' => '89, Main Street, Negombo',
                'city' => 'Negombo',
                'postal_code' => '11500',
                'emergency_contact_name' => 'Asanka Jayawardena',
                'emergency_contact_relationship' => 'Husband',
                'emergency_contact_phone' => '+94 70 567 8901',
                'joining_date' => '2018-03-20',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 47000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Sampath Bank',
                'bank_account_number' => '4567890123',
                'bank_branch' => 'Negombo',
                'highest_qualification' => 'Diploma in Care Management',
                'years_of_experience' => 10,
                'certifications' => 'First Aid, Dementia Care, Manual Handling, Safeguarding',
            ],
            [
                'full_name' => 'Chaminda Rajapaksha',
                'email' => 'chaminda.r@ckhomecare.lk',
                'phone' => '+94 75 567 8901',
                'employee_id' => 'CR-005',
                'job_title' => 'Care Assistant',
                'gender' => 'male',
                'date_of_birth' => '1995-09-25',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '952692345V',
                'current_address' => '23, Lake View, Kurunegala',
                'city' => 'Kurunegala',
                'postal_code' => '60000',
                'emergency_contact_name' => 'Sumithra Rajapaksha',
                'emergency_contact_relationship' => 'Mother',
                'emergency_contact_phone' => '+94 75 678 9012',
                'joining_date' => '2022-01-10',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 36000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Hatton National Bank',
                'bank_account_number' => '5678901234',
                'bank_branch' => 'Kurunegala',
                'highest_qualification' => 'Certificate in Care Support',
                'years_of_experience' => 3,
                'certifications' => 'First Aid, Infection Control',
            ],
            [
                'full_name' => 'Thisara Bandara',
                'email' => 'thisara.b@ckhomecare.lk',
                'phone' => '+94 72 678 9012',
                'employee_id' => 'CR-006',
                'job_title' => 'Care Assistant',
                'gender' => 'male',
                'date_of_birth' => '1990-12-08',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '903422345V',
                'current_address' => '56, Hill Street, Matara',
                'city' => 'Matara',
                'postal_code' => '81000',
                'emergency_contact_name' => 'Nadeeka Bandara',
                'emergency_contact_relationship' => 'Sister',
                'emergency_contact_phone' => '+94 72 789 0123',
                'joining_date' => '2021-08-01',
                'employment_type' => 'part_time',
                'employment_status' => 'active',
                'salary' => 22000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Bank of Ceylon',
                'bank_account_number' => '6789012345',
                'bank_branch' => 'Matara',
                'highest_qualification' => 'Certificate in Elderly Care',
                'years_of_experience' => 4,
                'certifications' => 'Manual Handling',
            ],
            [
                'full_name' => 'Hashini Wijesinghe',
                'email' => 'hashini.w@ckhomecare.lk',
                'phone' => '+94 77 789 0123',
                'employee_id' => 'CR-007',
                'job_title' => 'Senior Care Assistant',
                'gender' => 'female',
                'date_of_birth' => '1984-04-12',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '841031234V',
                'current_address' => '34, Park Avenue, Colombo 07',
                'city' => 'Colombo',
                'postal_code' => '00700',
                'emergency_contact_name' => 'Ruwan Wijesinghe',
                'emergency_contact_relationship' => 'Husband',
                'emergency_contact_phone' => '+94 77 890 1234',
                'joining_date' => '2017-05-15',
                'employment_type' => 'full_time',
                'employment_status' => 'active',
                'salary' => 50000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'Commercial Bank',
                'bank_account_number' => '7890123456',
                'bank_branch' => 'Colombo 07',
                'highest_qualification' => 'Diploma in Care Management',
                'years_of_experience' => 12,
                'certifications' => 'First Aid, Dementia Care, Palliative Care, Safeguarding, Manual Handling',
            ],
            [
                'full_name' => 'Lakshan Mendis',
                'email' => 'lakshan.m@ckhomecare.lk',
                'phone' => '+94 71 890 1234',
                'employee_id' => 'CR-008',
                'job_title' => 'Care Assistant',
                'gender' => 'male',
                'date_of_birth' => '1993-08-30',
                'nationality' => 'Sri Lankan',
                'national_id_number' => '932422345V',
                'current_address' => '78, Station Road, Jaffna',
                'city' => 'Jaffna',
                'postal_code' => '40000',
                'emergency_contact_name' => 'Shalini Mendis',
                'emergency_contact_relationship' => 'Wife',
                'emergency_contact_phone' => '+94 71 901 2345',
                'joining_date' => '2023-02-01',
                'employment_type' => 'contract',
                'employment_status' => 'active',
                'salary' => 40000.00,
                'salary_type' => 'monthly',
                'bank_name' => 'People\'s Bank',
                'bank_account_number' => '8901234567',
                'bank_branch' => 'Jaffna',
                'highest_qualification' => 'Certificate in Care Support',
                'years_of_experience' => 2,
                'certifications' => 'First Aid',
                'contract_start_date' => '2023-02-01',
                'contract_end_date' => '2024-01-31',
            ],
        ];

        foreach ($careers as $careerData) {
            $user = User::firstOrCreate(
                ['email' => $careerData['email']],
                [
                    'name' => $careerData['full_name'],
                    'password' => Hash::make('password123'),
                    'branch_id' => $branches->random()->id,
                ]
            );

            if (!$user->hasRole('career')) {
                $user->assignRole('career');
            }

            // Calculate age
            $age = now()->diffInYears($careerData['date_of_birth']);

            // Create career profile
            Career::firstOrCreate(
                ['employee_id' => $careerData['employee_id']],
                [
                'user_id' => $user->id,
                'employee_id' => $careerData['employee_id'],
                'full_name' => $careerData['full_name'],
                'date_of_birth' => $careerData['date_of_birth'],
                'age' => $age,
                'gender' => $careerData['gender'],
                'nationality' => $careerData['nationality'],
                'national_id_number' => $careerData['national_id_number'],
                'email' => $careerData['email'],
                'phone' => $careerData['phone'],
                'current_address' => $careerData['current_address'],
                'city' => $careerData['city'],
                'postal_code' => $careerData['postal_code'],
                'emergency_contact_name' => $careerData['emergency_contact_name'],
                'emergency_contact_relationship' => $careerData['emergency_contact_relationship'],
                'emergency_contact_phone' => $careerData['emergency_contact_phone'],
                'joining_date' => $careerData['joining_date'],
                'contract_start_date' => $careerData['contract_start_date'] ?? null,
                'contract_end_date' => $careerData['contract_end_date'] ?? null,
                'employment_type' => $careerData['employment_type'],
                'employment_status' => $careerData['employment_status'],
                'job_title' => $careerData['job_title'],
                'department' => 'Care Services',
                'branch_id' => $user->branch_id,
                'supervisor_id' => $supervisors[array_rand($supervisors)],
                'salary' => $careerData['salary'],
                'salary_type' => $careerData['salary_type'],
                'bank_name' => $careerData['bank_name'],
                'bank_account_number' => $careerData['bank_account_number'],
                'bank_branch' => $careerData['bank_branch'],
                'highest_qualification' => $careerData['highest_qualification'],
                'years_of_experience' => $careerData['years_of_experience'],
                'certifications' => $careerData['certifications'],
                ]
            );
        }

        $this->command->info('Successfully created 8 career staff records!');
        $this->command->info('Default password for all users: password123');
    }
}
