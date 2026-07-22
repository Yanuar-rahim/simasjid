<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * Nama command.
     */
    protected $signature = 'make:admin';

    /**
     * Deskripsi command.
     */
    protected $description = 'Membuat akun Administrator SIMASJID';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->newLine();

        $this->info('==========================================');
        $this->info('      SIMASJID Administrator Creator');
        $this->info('==========================================');

        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | Nama
        |--------------------------------------------------------------------------
        */

        $name = $this->ask('Nama Administrator');

        do {
            $email = $this->ask('Email');
            $exists = User::where('email', $email)->exists();

            if ($exists) {
                $this->error('Email sudah digunakan.');
            }

        } while ($exists);

        $phone = $this->ask('Nomor HP');
        $address = $this->ask('Alamat');

        do {
            $password = $this->secret('Password');
            $confirm = $this->secret('Konfirmasi Password');

            if ($password !== $confirm) {
                $this->error('Password tidak sama.');
            }

            if (strlen($password) < 8) {
                $this->error('Password minimal 8 karakter.');
            }

        } while (
            $password !== $confirm ||
            strlen($password) < 8
        );

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make($password),
        ]);

        $this->newLine();
        $this->info('✔ Administrator berhasil dibuat.');
        $this->newLine();
        $this->table(
            ['Field', 'Value'],
            [
                ['Nama', $user->name],
                ['Email', $user->email],
                ['Role', $user->role],
                ['Nomor HP', $user->phone],
                ['Alamat', $user->address],
            ]
        );
        
        $this->newLine();
        return self::SUCCESS;
    }
}