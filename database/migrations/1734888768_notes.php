<?php
return new class implements \App\Commands\Contract\Migration
{
    /**
    * Run migration script 
    * @return string
    */
    public function up(): string
    {
        return '
        CREATE TABLE notes (
           id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
           title VARCHAR(255) NOT NULL,
           created_at DATETIME DEFAULT NOW(),
           updated_at DATETIME DEFAULT NOW()
        );
        ';
    }
    /**
    * Rollback migration script
    * @return string
    */
    public function down(): string
    {
        return 'DROP TABLE notes';
    }
};