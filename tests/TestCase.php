<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{

    protected static $migrationsRun = false;
    protected static $tableNames = [];
    protected $isFullApplicationRefresh = false;

    public function createApplication()
    {
        global $app;

        if (!isset($app) || $this->isFullApplicationRefresh) {
            $app = require __DIR__ . '/../bootstrap/app.php';
        }

        $app->make(Kernel::class)->bootstrap();

        $this->injectDependencies($app);

        return $app;
    }


    private function injectDependencies(Application $app)
    {
    }

    protected function dropAllTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $results = DB::select(
            '
                SELECT concat(\'DROP TABLE IF EXISTS \', table_name, \';\') AS query
                FROM information_schema.tables
                WHERE table_schema = \'' . env('DB_DATABASE') . '\'
            '
        );

        foreach ($results as $result) {
            DB::statement($result->query);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    protected function setUp(): void
    {
        parent::setUp();


        if (!static::$migrationsRun) {
            $this->dropAllTables();

            Artisan::call('migrate');

            $tables = array_map(function ($t) {
                $tmp = (array)$t;
                return reset($tmp);
            }, DB::select('SHOW TABLES'));

            static::$migrationsRun = true;
            static::$tableNames = array_filter(
                $tables,
                function (string $value): bool {
                    return $value !== 'migrations';
                }
            );
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            foreach (static::$tableNames as $name) {
                DB::table($name)->truncate();
            }
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }
    }

//    protected function createCompanyAccount(string $username){
//        //todo: may be add creating company object
//        return factory(Account::class)->create(['username' => $username, 'role'=>AccountRoles::COMPANY]);
//    }
//
//    protected function createAgentAccount(string $username){
//        //todo: may be add creating agent object
//        return factory(Account::class)->create(['username' => $username, 'role'=>AccountRoles::AGENT]);
//    }

    /**
     * use for token auth like
     * $response = $this->post('api/agents/search', (array)$query, $this->setSuperAdminHeader());
     * just as example
     * @param $account
     */
    protected function setAuthHeader($account)
    {
//        $authService = $this->app->make(AuthService::class);
//        $authModel = new AuthTokenModel();
//        $authModel->username = $account->username;
//        $authModel->role = $account->role;
//        $authModel->accountId = $account->id;
//
//        $expiration = new DateTime(); //current date/time
//        $hours = 100;
//        $expiration->add(new DateInterval("PT{$hours}H"));
//
//        $authModel->exp =$expiration->getTimestamp();
//        $this->fillPermissions($authModel);
//
//        //simulate valid token
//        if ($account->role == AccountRoles::COMPANY){
//            $authModel->companyId =  $account->id;
//        } else if ($account->role == AccountRoles::AGENT){
//            $agent =Agent::query()->where('id', $account->id)->first();
//            $authModel->companyId = $agent["company_id"];
//            $authModel->agentId = $agent["id"];
//        }
//
//
//        $jwt = $authService->getToken($authModel);
//        return [
//            'Authorization' => 'Bearer '.$jwt
//        ];
    }

    private function fillPermissions($tokenModel)
    {
//        $adminRepository = $this->app->make(AdminRepository::class);
//        $tokenModel->permissions = [];
//        if ($tokenModel->role == AccountRoles::ADMIN) {
//            $tokenModel->permissions = [];
//            $admin = $adminRepository->findById($tokenModel->accountId);
//            if ($admin->approveAgents){
//                $tokenModel->permissions[] = Permissions::APPROVE_AGENTS;
//            }
//        }
    }

    protected function tearDown(): void
    {
    }
}
