<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;

class FixViewedAttributeForInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $activities = Activity::where('causer_type', 'App\Models\Invoice')->where('description', 'viewed')->get();
        foreach ($activities as $activity) {
            if ($invoice = $activity->causer) {
                $invoice->update(['viewed' => true]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
