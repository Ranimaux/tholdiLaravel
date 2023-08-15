<?php

namespace App\Http\Model\Map;

use App\Http\Model\Reserver;
use App\Http\Model\ReserverQuery;
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
 * This class defines the structure of the 'reserver' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ReserverTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.ReserverTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'reserver';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Reserver';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Http\\Model\\Reserver';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Reserver';

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
     * the column name for the codeReservation field
     */
    public const COL_CODERESERVATION = 'reserver.codeReservation';

    /**
     * the column name for the numTypeContainer field
     */
    public const COL_NUMTYPECONTAINER = 'reserver.numTypeContainer';

    /**
     * the column name for the qteReserver field
     */
    public const COL_QTERESERVER = 'reserver.qteReserver';

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
        self::TYPE_PHPNAME       => ['Codereservation', 'Numtypecontainer', 'Qtereserver', ],
        self::TYPE_CAMELNAME     => ['codereservation', 'numtypecontainer', 'qtereserver', ],
        self::TYPE_COLNAME       => [ReserverTableMap::COL_CODERESERVATION, ReserverTableMap::COL_NUMTYPECONTAINER, ReserverTableMap::COL_QTERESERVER, ],
        self::TYPE_FIELDNAME     => ['codeReservation', 'numTypeContainer', 'qteReserver', ],
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
        self::TYPE_PHPNAME       => ['Codereservation' => 0, 'Numtypecontainer' => 1, 'Qtereserver' => 2, ],
        self::TYPE_CAMELNAME     => ['codereservation' => 0, 'numtypecontainer' => 1, 'qtereserver' => 2, ],
        self::TYPE_COLNAME       => [ReserverTableMap::COL_CODERESERVATION => 0, ReserverTableMap::COL_NUMTYPECONTAINER => 1, ReserverTableMap::COL_QTERESERVER => 2, ],
        self::TYPE_FIELDNAME     => ['codeReservation' => 0, 'numTypeContainer' => 1, 'qteReserver' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Codereservation' => 'CODERESERVATION',
        'Reserver.Codereservation' => 'CODERESERVATION',
        'codereservation' => 'CODERESERVATION',
        'reserver.codereservation' => 'CODERESERVATION',
        'ReserverTableMap::COL_CODERESERVATION' => 'CODERESERVATION',
        'COL_CODERESERVATION' => 'CODERESERVATION',
        'codeReservation' => 'CODERESERVATION',
        'reserver.codeReservation' => 'CODERESERVATION',
        'Numtypecontainer' => 'NUMTYPECONTAINER',
        'Reserver.Numtypecontainer' => 'NUMTYPECONTAINER',
        'numtypecontainer' => 'NUMTYPECONTAINER',
        'reserver.numtypecontainer' => 'NUMTYPECONTAINER',
        'ReserverTableMap::COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'numTypeContainer' => 'NUMTYPECONTAINER',
        'reserver.numTypeContainer' => 'NUMTYPECONTAINER',
        'Qtereserver' => 'QTERESERVER',
        'Reserver.Qtereserver' => 'QTERESERVER',
        'qtereserver' => 'QTERESERVER',
        'reserver.qtereserver' => 'QTERESERVER',
        'ReserverTableMap::COL_QTERESERVER' => 'QTERESERVER',
        'COL_QTERESERVER' => 'QTERESERVER',
        'qteReserver' => 'QTERESERVER',
        'reserver.qteReserver' => 'QTERESERVER',
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
        $this->setName('reserver');
        $this->setPhpName('Reserver');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Reserver');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('codeReservation', 'Codereservation', 'INTEGER' , 'reservation', 'codeReservation', true, null, 0);
        $this->addForeignPrimaryKey('numTypeContainer', 'Numtypecontainer', 'SMALLINT' , 'typeContainer', 'numTypeContainer', true, null, null);
        $this->addColumn('qteReserver', 'Qtereserver', 'SMALLINT', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Reservation', '\\App\\Http\\Model\\Reservation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codeReservation',
    1 => ':codeReservation',
  ),
), null, null, null, false);
        $this->addRelation('Typecontainer', '\\App\\Http\\Model\\Typecontainer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':numTypeContainer',
    1 => ':numTypeContainer',
  ),
), null, null, null, false);
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \App\Http\Model\Reserver $obj A \App\Http\Model\Reserver object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(Reserver $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getCodereservation() || is_scalar($obj->getCodereservation()) || is_callable([$obj->getCodereservation(), '__toString']) ? (string) $obj->getCodereservation() : $obj->getCodereservation()), (null === $obj->getNumtypecontainer() || is_scalar($obj->getNumtypecontainer()) || is_callable([$obj->getNumtypecontainer(), '__toString']) ? (string) $obj->getNumtypecontainer() : $obj->getNumtypecontainer())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \App\Http\Model\Reserver object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \App\Http\Model\Reserver) {
                $key = serialize([(null === $value->getCodereservation() || is_scalar($value->getCodereservation()) || is_callable([$value->getCodereservation(), '__toString']) ? (string) $value->getCodereservation() : $value->getCodereservation()), (null === $value->getNumtypecontainer() || is_scalar($value->getNumtypecontainer()) || is_callable([$value->getNumtypecontainer(), '__toString']) ? (string) $value->getNumtypecontainer() : $value->getNumtypecontainer())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \App\Http\Model\Reserver object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? ReserverTableMap::CLASS_DEFAULT : ReserverTableMap::OM_CLASS;
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
     * @return array (Reserver object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ReserverTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReserverTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReserverTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReserverTableMap::OM_CLASS;
            /** @var Reserver $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReserverTableMap::addInstanceToPool($obj, $key);
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
            $key = ReserverTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReserverTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reserver $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReserverTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReserverTableMap::COL_CODERESERVATION);
            $criteria->addSelectColumn(ReserverTableMap::COL_NUMTYPECONTAINER);
            $criteria->addSelectColumn(ReserverTableMap::COL_QTERESERVER);
        } else {
            $criteria->addSelectColumn($alias . '.codeReservation');
            $criteria->addSelectColumn($alias . '.numTypeContainer');
            $criteria->addSelectColumn($alias . '.qteReserver');
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
            $criteria->removeSelectColumn(ReserverTableMap::COL_CODERESERVATION);
            $criteria->removeSelectColumn(ReserverTableMap::COL_NUMTYPECONTAINER);
            $criteria->removeSelectColumn(ReserverTableMap::COL_QTERESERVER);
        } else {
            $criteria->removeSelectColumn($alias . '.codeReservation');
            $criteria->removeSelectColumn($alias . '.numTypeContainer');
            $criteria->removeSelectColumn($alias . '.qteReserver');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReserverTableMap::DATABASE_NAME)->getTable(ReserverTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Reserver or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Reserver object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReserverTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Reserver) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReserverTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ReserverTableMap::COL_CODERESERVATION, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ReserverTableMap::COL_NUMTYPECONTAINER, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ReserverQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReserverTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReserverTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reserver table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ReserverQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reserver or Criteria object.
     *
     * @param mixed $criteria Criteria or Reserver object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReserverTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reserver object
        }


        // Set the correct dbName
        $query = ReserverQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
