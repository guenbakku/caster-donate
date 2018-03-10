<?php
use Migrations\AbstractSeed;

/**
 * Resources seed.
 */
class ResourcesSeed extends AbstractSeed
{
    /**
     * Bảng `resources` vừa chứa dữ liệu ban đầu của hệ thống, vừa chứa dữ liệu của user đưa lên.
     * Ngoài ra bảng resources được liên kết khóa ngoại với bảng `users_resources`.
     * Do đó không thể sử dụng seed script để đưa dữ liệu ban đầu của hệ thống vào bảng này.
     * Dữ liệu ban đầu của bảng này được đưa vào bằng migration script: `SeedResourcesTable.php`
     */
}
