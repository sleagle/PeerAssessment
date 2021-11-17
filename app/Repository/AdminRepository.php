<?php


namespace App\Repository;


use App\Models\Admin;
use Illuminate\Database\Connection;

class AdminRepository extends BaseRepository
{
    /**
     * AdminRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    public function getAdminByUserId(int $userId): Admin
    {
        $admin = Admin::where('USER_ID', $userId);

        return $admin->first();
    }
}
