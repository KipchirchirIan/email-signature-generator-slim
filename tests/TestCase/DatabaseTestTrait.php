<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 8/25/20
 * Time: 4:35 PM
 */

namespace App\Test\TestCase;

use PDO;
use UnexpectedValueException;

/*
 * Database Test
 */
trait DatabaseTestTrait
{
    use AppTestTrait;

    /**
     * Create tables and insert fixtures
     *
     * @before
     *
     * @return void
     */
    protected function setupDatabase(): void
    {
        $this->getConnection();


        $this->createTables();
        $this->truncateTables();

        if (!empty($this->fixtures)) {
            $this->insertFixtures($this->fixtures);
        }
    }

    /**
     * Get database connection
     *
     * @return PDO The PDO instance
     */
    protected function getConnection(): PDO
    {
        return $this->container->get(PDO::class);
    }

    /**
     * Create tables
     *
     * @return void
     */
    protected function createTables(): void
    {
        if (defined('DB_TEST_TRAIT_INIT')) {
            return;
        }

        $this->dropTables();
        $this->importSchema();

        define('DB_TEST_TRAIT_INIT', 1);
    }

    /**
     * Import table schema
     *
     * @return void
     */
    protected function importSchema(): void
    {
        $pdo = $this->getConnection();
        $pdo->exec('SET unique_checks=0; SET foreign_key_checks=0;');
        $pdo->exec((string)file_get_contents(__DIR__ . '/../../resources/schema.sql'));
        $pdo->exec('SET unique_checks=1; SET foreign_key_checks=1;');
    }

    /**
     * Clean up database. Truncate tables
     *
     * @return void
     * @throws UnexpectedValueException
     *
     */
    protected function dropTables(): void
    {
        $pdo = $this->getConnection();

        $pdo->exec('SET unique_checks=0; SET foreign_key_checks=0;');

        $statement = $pdo->query(
            'SELECT TABLE_NAME
                        FROM information_schema.TABLES 
                        WHERE TABLE_SCHEMA = database()'
        );

        if (!$statement) {
            throw new UnexpectedValueException('Invalid SQL statement');
        }

        $sql = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $sql[] = sprintf('DROP TABLE `%s`;', $row['TABLE_NAME']);
        }

        if ($sql) {
            $pdo->exec(implode("\n", $sql));
        }

        $pdo->exec('SET unique_checks=1; SET foreign_key_checks=1;');
    }

    /**
     * Clean up database
     *
     * @return void
     * @throws UnexpectedValueException
     *
     */
    protected function truncateTables(): void
    {
        $pdo = $this->getConnection();

        $pdo->exec('SET unique_checks=0; SET foreign_key_checks=0; SET information_schema_stats_expiry=0');


        // Truncate only changed tables
        $statement = $pdo->query(
            'SELECT TABLE_NAME
                           FROM information_schema.TABLES
                           WHERE TABLE_SCHEMA = database()
                           AND UPDATE_TIME IS NOT NULL'
        );

        if (!$statement) {
            throw new UnexpectedValueException('Invalid SQL statement');
        }

        $sql = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $sql[] = sprintf('TRUNCATE TABLE `%s`;', $row['TABLE_NAME']);
        }

        if ($sql) {
            $pdo->exec(implode("\n", $sql));
        }

        $pdo->exec('SET unique_checks=1; SET foreign_key_checks=1;');
    }

    /**
     * Iterate over all fixtures and insert them into their tables.
     *
     * @param array $fixtures The fixtures
     *
     * @return void
     */
    protected function insertFixtures(array $fixtures): void
    {
        foreach ($fixtures as $fixture) {
            $object = new $fixture();

            foreach ($object->records as $row) {
                $this->insertFixture($object->table, $row);
            }
        }
    }

    /**
     * Insert row into table.
     *
     * @param string $table The table name
     * @param array $row The row data
     *
     * @return void
     */
    protected function insertFixture(string $table, array $row): void
    {
        $pdo = $this->getConnection();
//        $pdo->exec('USE emailsignaturegen_test;');
        $fields = array_keys($row);

        array_walk(
            $fields,
            function (&$value) {
                $value = sprintf('`%s`=:%s', $value, $value);
            }
        );

        $statement = $pdo->prepare(sprintf('INSERT INTO `%s` SET %s', $table, implode(',', $fields)));
        $statement->execute($row);
    }
}