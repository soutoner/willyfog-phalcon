<?php

namespace App\Db\Seeds;

use App\Db\Seeds\Models\AccessTokenSeeder;
use App\Db\Seeds\Models\AdminSeeder;
use App\Db\Seeds\Models\CentreSeeder;
use App\Db\Seeds\Models\CitySeeder;
use App\Db\Seeds\Models\CoordinatorSeeder;
use App\Db\Seeds\Models\CountrySeeder;
use App\Db\Seeds\Models\DegreeSeeder;
use App\Db\Seeds\Models\EquivalenceSeeder;
use App\Db\Seeds\Models\LogGrantSeeder;
use App\Db\Seeds\Models\ProfessorSeeder;
use App\Db\Seeds\Models\RecognizerSeeder;
use App\Db\Seeds\Models\Relationships\AccessTokenGrantsCentreSeeder;
use App\Db\Seeds\Models\Relationships\CoordinatorCoordCentreSeeder;
use App\Db\Seeds\Models\Relationships\LogGrantPermittedCentreSeeder;
use App\Db\Seeds\Models\Relationships\StudentEnrolledDegreeSeeder;
use App\Db\Seeds\Models\Relationships\SubjectEquivalentSubjectSeeder;
use App\Db\Seeds\Models\RequestSeeder;
use App\Db\Seeds\Models\StudentSeeder;
use App\Db\Seeds\Models\SubjectSeeder;
use App\Lib\Logs\HTMLLogger;

class DatabaseSeeder
{
    /**
     * Call here seeders.
     *
     * @param bool $want_fake : Whether to create fake users or not
     */
    public static function Seed($want_fake = true)
    {
        $logger = new HTMLLogger('seeder.html', '/seeders/');
        /**
         * Models.
         */
        AdminSeeder::Seed($want_fake, $logger);
        LogGrantSeeder::Seed($want_fake, $logger);
        AccessTokenSeeder::Seed($want_fake, $logger);
        CountrySeeder::Seed($want_fake, $logger);
        CitySeeder::Seed($want_fake, $logger);
        CentreSeeder::Seed($want_fake, $logger);
        DegreeSeeder::Seed($want_fake, $logger);
        StudentSeeder::Seed($want_fake, $logger);
        RecognizerSeeder::Seed($want_fake, $logger);
        SubjectSeeder::Seed($want_fake, $logger);
        CoordinatorSeeder::Seed($want_fake, $logger);
        ProfessorSeeder::Seed($want_fake, $logger);
        RequestSeeder::Seed($want_fake, $logger);
        EquivalenceSeeder::Seed($want_fake, $logger);
        /**
         * Relationships.
         */
        LogGrantPermittedCentreSeeder::Seed($want_fake, $logger);
        AccessTokenGrantsCentreSeeder::Seed($want_fake, $logger);
        CoordinatorCoordCentreSeeder::Seed($want_fake, $logger);
        StudentEnrolledDegreeSeeder::Seed($want_fake, $logger);
        SubjectEquivalentSubjectSeeder::Seed($want_fake, $logger);

        $logger->success('Database successfully seeded!');
    }
}
