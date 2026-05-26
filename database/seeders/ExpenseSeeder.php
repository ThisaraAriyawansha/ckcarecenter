<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Branch;
use App\Models\User;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first branch and admin user
        $branch = Branch::first();
        $user = User::role('admin')->first();

        if (!$branch || !$user) {
            $this->command->warn('Please ensure branches and admin users exist before running this seeder.');
            return;
        }

        // Sample expenses based on the CSV reference (November 2025)
        $expenses = [
            // November 1, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Groceries',
                'sub_category' => 'Shops',
                'amount' => 52751.99,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'Local Supermarket',
                'description' => 'Monthly grocery shopping',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Laundry',
                'sub_category' => null,
                'amount' => 1300.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'ABC Laundry Services',
                'description' => 'Weekly laundry service',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 750.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Staff transport',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'House Rent',
                'sub_category' => null,
                'amount' => 180000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'Property Owner',
                'description' => 'Monthly house rent',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Services',
                'sub_category' => null,
                'amount' => 1000.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Garbage Collection',
                'description' => 'Garbage lorry service',
                'notes' => '1000 garbage lorry',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Salaries',
                'sub_category' => 'Staff 1',
                'amount' => 45000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => null,
                'description' => 'Monthly salary payment',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Marketing',
                'sub_category' => null,
                'amount' => 10535.91,
                'payment_method' => 'Card',
                'vendor_name' => 'Marketing Agency',
                'description' => 'Monthly marketing expenses',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-01',
                'category' => 'Capital',
                'sub_category' => null,
                'amount' => 40000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'Electronics Store',
                'description' => 'Mini fridge purchase',
                'created_by' => $user->id,
            ],

            // November 2, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-02',
                'category' => 'Groceries',
                'sub_category' => 'Supermarket',
                'amount' => 1500.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Supermarket',
                'description' => 'Daily groceries',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-02',
                'category' => 'Groceries',
                'sub_category' => 'Shops',
                'amount' => 6204.24,
                'payment_method' => 'Cash',
                'vendor_name' => 'Medical Supplies',
                'description' => 'Commode chair, pressure meter, sugar monitor',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-02',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 250.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Local transport',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-02',
                'category' => 'Capital',
                'sub_category' => null,
                'amount' => 45000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'Medical Equipment Supplier',
                'description' => 'Medical equipment purchase',
                'created_by' => $user->id,
            ],

            // November 3, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-03',
                'category' => 'Groceries',
                'sub_category' => 'Supermarket',
                'amount' => 332.14,
                'payment_method' => 'Cash',
                'vendor_name' => 'Local Shop',
                'description' => 'Small groceries',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-03',
                'category' => 'Groceries',
                'sub_category' => 'Shops',
                'amount' => 3982.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Gas Supplier',
                'description' => 'Gas cylinder',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-03',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 654.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Transport expenses',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-03',
                'category' => 'Bills',
                'sub_category' => 'Other',
                'amount' => 5335.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Gas Supplier',
                'description' => 'Gas bill',
                'notes' => '5335 gas twg',
                'created_by' => $user->id,
            ],

            // November 4, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-04',
                'category' => 'Groceries',
                'sub_category' => 'Shops',
                'amount' => 2493.40,
                'payment_method' => 'Cash',
                'vendor_name' => 'Local Vendor',
                'description' => 'Groceries',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-04',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 460.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Transport',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-04',
                'category' => 'Marketing',
                'sub_category' => null,
                'amount' => 4405.00,
                'payment_method' => 'Online Payment',
                'vendor_name' => 'Digital Marketing',
                'description' => 'Online advertising',
                'created_by' => $user->id,
            ],

            // November 17, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-17',
                'category' => 'Laundry',
                'sub_category' => null,
                'amount' => 1760.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Laundry Service',
                'description' => 'Weekly laundry',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-17',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 1310.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Transport expenses',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-17',
                'category' => 'Bills',
                'sub_category' => 'Electricity',
                'amount' => 9505.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'CEB',
                'receipt_number' => 'CEB-2025-11',
                'description' => 'Monthly electricity bill',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-17',
                'category' => 'Bills',
                'sub_category' => 'Water',
                'amount' => 6378.02,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'Water Board',
                'receipt_number' => 'WB-2025-11',
                'description' => 'Monthly water bill',
                'created_by' => $user->id,
            ],

            // November 18, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-18',
                'category' => 'Cleaning',
                'sub_category' => null,
                'amount' => 11650.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Cleaning Supplies Store',
                'description' => 'Cleaning essentials',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-18',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 330.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Transport',
                'created_by' => $user->id,
            ],

            // November 19, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-19',
                'category' => 'Bills',
                'sub_category' => 'Other',
                'amount' => 7132.84,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => 'SLT',
                'receipt_number' => 'SLT-2025-11',
                'description' => 'PEO TV / SLT services',
                'created_by' => $user->id,
            ],

            // November 21, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-21',
                'category' => 'Bills',
                'sub_category' => 'Mobile',
                'amount' => 2039.70,
                'payment_method' => 'Online Payment',
                'vendor_name' => 'Mobile Provider',
                'description' => 'Monthly mobile bills',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-21',
                'category' => 'Marketing',
                'sub_category' => null,
                'amount' => 3000.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Job Portal',
                'description' => 'Job vacancy advertisement budget',
                'created_by' => $user->id,
            ],

            // November 23, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-23',
                'category' => 'Transport',
                'sub_category' => null,
                'amount' => 1650.00,
                'payment_method' => 'Cash',
                'vendor_name' => null,
                'description' => 'Transport expenses',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-23',
                'category' => 'Medical',
                'sub_category' => null,
                'amount' => 6310.29,
                'payment_method' => 'Cash',
                'vendor_name' => 'Medical Clinic',
                'description' => 'Medical bills',
                'notes' => "6310.29 Raja's Medical bills",
                'created_by' => $user->id,
            ],

            // November 30, 2025
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Bills',
                'sub_category' => 'Other',
                'amount' => 1620.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Newspaper Vendor',
                'description' => 'Newspapers',
                'notes' => '1620 News papers',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Services',
                'sub_category' => null,
                'amount' => 3500.00,
                'payment_method' => 'Cash',
                'vendor_name' => 'Service Provider',
                'description' => 'Monthly services',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Salaries',
                'sub_category' => 'Staff 1',
                'amount' => 50000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => null,
                'description' => 'Monthly salary - Staff 1',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Salaries',
                'sub_category' => 'Staff 2',
                'amount' => 100000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => null,
                'description' => 'Monthly salary - Staff 2',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Salaries',
                'sub_category' => 'Staff 3',
                'amount' => 30000.00,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => null,
                'description' => 'Monthly salary - Staff 3',
                'created_by' => $user->id,
            ],
            [
                'branch_id' => $branch->id,
                'expense_date' => '2025-11-30',
                'category' => 'Monthly Settlement',
                'sub_category' => null,
                'amount' => 22466.74,
                'payment_method' => 'Bank Transfer',
                'vendor_name' => null,
                'description' => 'Monthly settlement',
                'created_by' => $user->id,
            ],
        ];

        if (Expense::where('branch_id', $branch->id)->exists()) {
            $this->command->warn('Expenses already exist. Skipping expense seeding.');
            return;
        }

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }

        $this->command->info('Expense seeder completed successfully! Created ' . count($expenses) . ' sample expenses.');
    }
}
