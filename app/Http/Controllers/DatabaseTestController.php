<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DatabaseTestController extends Controller
{
    public function testConnection()
    {
        try {
            DB::connection()->getPdo();
            return 'Database connection successful!';
        } catch (\Exception $e) {
            return 'Database connection failed: ' . $e->getMessage();
        }
    }
}
