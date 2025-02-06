use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('units', function (Blueprint $table) {
            $table->integer('post_id')->nullable();
            $table->string('unit_size')->nullable();
            $table->json('unit_features')->nullable();
        });
    }

    public function down() {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['post_id','unit_size', 'unit_features']);
        });
    }
};