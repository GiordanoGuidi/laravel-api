<?php

use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //definizione colonna 
            // $table->unsignedBigInteger('type_id')->nullable()->after('id');
            //definizione chuiave esterna 
            // $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();
            //# Soluzione più breve
            $table->foreignIdFor(Type::class)->after('id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Rtypeseverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //Rimuovo la relazione(chiave esterna)
            // $table->dropForeign('projects_type_id_foreign');
            // //Rimuovo la colonna
            // $table->dropColumn('type_id');
            //# Soluzione più breve
            $table->dropForeignIdFor(Type::class);
        });
    }
};
