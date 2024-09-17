<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Artisan;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use RealRashid\SweetAlert\Facades\Alert;

class DatabaseController extends Controller
{   public function __construct()
    {
        $this->middleware('auth');
    }
    public function showTables()
    {
        // Get all tables in the database
    $tables = DB::select('SHOW TABLES');

        $databaseName = env('DB_DATABASE'); // Fetch your database name from the .env file

        // Get the key for the first result item to use dynamically
        $firstTable = reset($tables);
        $key = key((array)$firstTable); // Fetch the key for the dynamic column name

        $tableNames = [];
        foreach ($tables as $table) {
            $tableNames[] = $table->$key;
        }

        // Pass the table names to the view
        return view('select-table', compact('tableNames'));
    }

    public function deleteTable(Request $request)
    {
        // Get the selected table from the request
        $tableName = $request->input('table');

        // Use DB to run a query to drop the table
        DB::statement('TRUNCATE  TABLE ' . $tableName);

        return redirect()->back()->with('success', 'Table ' . $tableName . ' deleted successfully!');
    }
    public function migrateRefreshAndSeed()
    {
        // Run the migrate:refresh command
        Artisan::call('migrate:refresh');

        // Run the db:seed command
        Artisan::call('db:seed');

        // Return success message (or redirect if needed)
        // return response()->json(['message' => 'Database migrated and seeded successfully']);
        Alert::success(title: 'Database migrated and seeded successfully');
        ActivityLogger::activity(Auth::user()->id. "Database migrated and seeded successfully");
        return redirect()->back();
    }
}
