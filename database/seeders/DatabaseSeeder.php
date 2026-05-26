<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting C & K Home Nursing and Care Center Database Seeding...');
        $this->command->newLine();

        // Order is important - seed in dependency order
        $this->call([
            // Core system data
            RoleSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,

            // Client-related data
            ClientSeeder::class,
            DoctorSeeder::class,
            MedicationSeeder::class,
            ClientOutingSeeder::class,
            ClientDailyChecklistSeeder::class,

            // Staff-related data
            CareerSeeder::class,
            ChefChecklistSeeder::class,

            // Financial data
            ExpenseSeeder::class,

            // Public website data
            ServiceSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            GallerySeeder::class,
            WhoweareSeeder::class,
            CareHomeSeeder::class,
            BlogSeeder::class,
            ContactMessageSeeder::class,
            EnquirySeeder::class,
            PackageSeeder::class,
            EventSeeder::class,
            
        ]);

        $this->command->newLine();
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->newLine();
        $this->command->info('📋 Summary:');
        $this->command->info('   - Core System: Roles, Branches, Users');
        $this->command->info('   - Clients: 6 Clients with guardians, doctors, medications, outings');
        $this->command->info('   - Staff: Careers, chef checklists');
        $this->command->info('   - Financial: Expenses data');
        $this->command->info('   - Website: Services, Testimonials, FAQs, Gallery, Care Homes, Blogs, Contact Messages, Enquiries');
        $this->command->newLine();
        $this->command->info('🔑 Login Credentials (password: password):');
        $this->command->info('   Admin:   admin@ckhomecare.com');
        $this->command->info('   Manager: kasun.silva@ckhomecare.com');
        $this->command->info('   Career:  amila.bandara@ckhomecare.com');
        $this->command->info('   Nurse:   nurse.malini@ckhomecare.com');
        $this->command->info('   User:    ruwan.silva@ckhomecare.com');
        $this->command->newLine();
    }
}
