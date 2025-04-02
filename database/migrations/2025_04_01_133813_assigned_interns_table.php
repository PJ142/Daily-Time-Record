    <?php

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
            Schema::create('assigned_interns', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('intern_id');
                $table->unsignedBigInteger('supervisor_id');
                $table->date('internship_start_date')->nullable();
                $table->date('internship_end_date')->nullable();
                $table->timestamps();

                // Foreign key constraints
                $table->foreign('intern_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('daily_time_records');
        }
    };
