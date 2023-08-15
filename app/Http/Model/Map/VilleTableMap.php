<?php

namespace App\Http\Model\Map;

use App\Http\Model\Ville;
use App\Http\Model\VilleQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'ville' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VilleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.VilleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ville';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Ville';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Http\\Model\\Ville';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Ville';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the codeVille field
     */
    public const COL_CODEVILLE = 'ville.codeVille';

    /**
     * the column name for the nomVille field
     */
    public const COL_NOMVILLE = 'ville.nomVille';

    /**
     * the column name for the codePays field
     */
    public const COL_CODEPAYS = 'ville.codePays';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Codeville', 'Nomville', 'Codepays', ],
        self::TYPE_CAMELNAME     => ['codeville', 'nomville', 'codepays', ],
        self::TYPE_COLNAME       => [VilleTableMap::COL_CODEVILLE, VilleTableMap::COL_NOMVILLE, VilleTableMap::COL_CODEPAYS, ],
        self::TYPE_FIELDNAME     => ['codeVille', 'nomVille', 'codePays', ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Codeville' => 0, 'Nomville' => 1, 'Codepays' => 2, ],
        self::TYPE_CAMELNAME     => ['codeville' => 0, 'nomville' => 1, 'codepays' => 2, ],
        self::TYPE_COLNAME       => [VilleTableMap::COL_CODEVILLE => 0, VilleTableMap::COL_NOMVILLE => 1, VilleTableMap::COL_CODEPAYS => 2, ],
        self::TYPE_FIELDNAME     => ['codeVille' => 0, 'nomVille' => 1, 'codePays' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Codeville' => 'CODEVILLE',
        'Ville.Codeville' => 'CODEVILLE',
        'codeville' => 'CODEVILLE',
        'ville.codeville' => 'CODEVILLE',
        'VilleTableMap::COL_CODEVILLE' => 'CODEVILLE',
        'COL_CODEVILLE' => 'CODEVILLE',
        'codeVille' => 'CODEVILLE',
        'ville.codeVille' => 'CODEVILLE',
        'Nomville' => 'NOMVILLE',
        'Ville.Nomville' => 'NOMVILLE',
        'nomville' => 'NOMVILLE',
        'ville.nomville' => 'NOMVILLE',
        'VilleTableMap::COL_NOMVILLE' => 'NOMVILLE',
        'COL_NOMVILLE' => 'NOMVILLE',
        'nomVille' => 'NOMVILLE',
        'ville.nomVille' => 'NOMVILLE',
        'Codepays' => 'CODEPAYS',
        'Ville.Codepays' => 'CODEPAYS',
        'codepays' => 'CODEPAYS',
        'ville.codepays' => 'CODEPAYS',
        'VilleTableMap::COL_CODEPAYS' => 'CODEPAYS',
        'COL_CODEPAYS' => 'CODEPAYS',
        'codePays' => 'CODEPAYS',
        'ville.codePays' => 'CODEPAYS',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('ville');
        $this->setPhpName('Ville');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Ville');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codeVille', 'Codeville', 'CHAR', true, 3, '');
        $this->addColumn('nomVille', 'Nomville', 'VARCHAR', true, 30, null);
        $this->addForeignKey('codePays', 'Codepays', 'CHAR', 'pays', 'codePays', true, 4, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Pays', '\\App\\Http\\Model\\Pays', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codePays',
    1 => ':codePays',
  ),
), null, null, null, false);
        $this->addRelation('ReservationRelatedByCodevillemisedispo', '\\App\\Http\\Model\\Reservation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codeVilleMiseDispo',
    1 => ':codeVille',
  ),
), null, null, 'ReservationsRelatedByCodevillemisedispo', false);
        $this->addRelation('ReservationRelatedByCodevillerendre', '\\App\\Http\\Model\\Reservation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codeVilleRendre',
    1 => ':codeVille',
  ),
), null, null, 'ReservationsRelatedByCodevillerendre', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? VilleTableMap::CLASS_DEFAULT : VilleTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Ville object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = VilleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VilleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VilleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VilleTableMap::OM_CLASS;
            /** @var Ville $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VilleTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VilleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VilleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Ville $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VilleTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VilleTableMap::COL_CODEVILLE);
            $criteria->addSelectColumn(VilleTableMap::COL_NOMVILLE);
            $criteria->addSelectColumn(VilleTableMap::COL_CODEPAYS);
        } else {
            $criteria->addSelectColumn($alias . '.codeVille');
            $criteria->addSelectColumn($alias . '.nomVille');
            $criteria->addSelectColumn($alias . '.codePays');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(VilleTableMap::COL_CODEVILLE);
            $criteria->removeSelectColumn(VilleTableMap::COL_NOMVILLE);
            $criteria->removeSelectColumn(VilleTableMap::COL_CODEPAYS);
        } else {
            $criteria->removeSelectColumn($alias . '.codeVille');
            $criteria->removeSelectColumn($alias . '.nomVille');
            $criteria->removeSelectColumn($alias . '.codePays');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(VilleTableMap::DATABASE_NAME)->getTable(VilleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Ville or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Ville object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VilleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Ville) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VilleTableMap::DATABASE_NAME);
            $criteria->add(VilleTableMap::COL_CODEVILLE, (array) $values, Criteria::IN);
        }

        $query = VilleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VilleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VilleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ville table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return VilleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Ville or Criteria object.
     *
     * @param mixed $criteria Criteria or Ville object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VilleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Ville object
        }


        // Set the correct dbName
        $query = VilleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
