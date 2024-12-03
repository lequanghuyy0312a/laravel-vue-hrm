<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('mail', 20)->unique();
            $table->string('full_name', 200)->nullable();
            $table->string('user_name', 200)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('password', 200);
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->date('job_created_at');
            $table->integer('job_position_id');
            $table->timestamps();
        });

        // Hàm trigger: Đồng bộ với bảng role_accounts sau khi insert
        DB::unprepared('
            CREATE OR REPLACE FUNCTION sync_to_role_accounts_after_insert_func() 
            RETURNS trigger AS $$
            BEGIN
                INSERT INTO role_accounts (mail, full_name,job_position_id, user_name, phone, password, employee_id, role_id, job_created_at, created_at, updated_at)
                VALUES (NEW.mail, NEW.full_name, NEW.job_position_id, NEW.user_name, NEW.phone, NEW.password, NEW.employee_id, NEW.role_id, NEW.job_created_at, NEW.created_at, NEW.updated_at);
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
            CREATE TRIGGER sync_to_role_accounts_after_insert
            AFTER INSERT ON accounts
            FOR EACH ROW
            EXECUTE FUNCTION sync_to_role_accounts_after_insert_func();
        ');

        // Hàm trigger: Đồng bộ khi UPDATE hoặc DELETE từ role_accounts
        DB::unprepared('
            CREATE OR REPLACE FUNCTION sync_accounts_after_update_or_delete_func() 
            RETURNS trigger AS $$
            BEGIN
                IF TG_OP = \'DELETE\' THEN
                    DELETE FROM accounts WHERE id = OLD.id;
                ELSIF TG_OP = \'UPDATE\' THEN
                    UPDATE accounts
                    SET mail = NEW.mail,
                        full_name = NEW.full_name,
                        user_name = NEW.user_name,
                        phone = NEW.phone,
                        password = NEW.password,
                        employee_id = NEW.employee_id,
                        role_id = NEW.role_id,
                        job_created_at = NEW.job_created_at,
                        job_position_id = NEW.job_position_id,
                        updated_at = NEW.updated_at
                    WHERE id = NEW.id;
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
            CREATE TRIGGER sync_accounts_after_update_or_delete
            AFTER UPDATE OR DELETE ON role_accounts
            FOR EACH ROW
            EXECUTE FUNCTION sync_accounts_after_update_or_delete_func();
        ');
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
        
        // Xóa trigger và hàm trigger
        DB::unprepared('DROP TRIGGER IF EXISTS sync_to_role_accounts_after_insert ON accounts;');
        DB::unprepared('DROP FUNCTION IF EXISTS sync_to_role_accounts_after_insert_func;');

        DB::unprepared('DROP TRIGGER IF EXISTS sync_accounts_after_update_or_delete ON role_accounts;');
        DB::unprepared('DROP FUNCTION IF EXISTS sync_accounts_after_update_or_delete_func;');
    }
}
