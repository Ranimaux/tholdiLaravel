<?php

namespace App\Http\Model\Map;

use App\Http\Model\Devis;
use App\Http\Model\DevisQuery;
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
 * This class defines the structure of the 'devis' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DevisTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.DevisTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'devis';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Devis';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Http\\Model\\Devis';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Devis';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the codeDevis field
     */
    public const COL_CODEDEVIS = 'devis.codeDevis';

    /**
     * the column name for the dateDevis field
     */
    public const COL_DATEDEVIS = 'devis.dateDevis';

    /**
     * the column name for the montantDevis field
     */
    public const COL_MONTANTDEVIS = 'devis.montantDevis';

    /**
     * the column name for the volume field
     */
    public const COL_VOLUME = 'devis.volume';

    /**
     * the column name for the nbContainers field
     */
    public const COL_NBCONTAINERS = 'devis.nbContainers';

    /**
     * the column name for the valider field
     */
    public const COL_VALIDER = 'devis.valider';

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
        self::TYPE_PHPNAME       => ['Codedevis', 'Datedevis', 'Montantdevis', 'Volume', 'Nbcontainers', 'Valider', ],
        self::TYPE_CAMELNAME     => ['codedevis', 'datedevis', 'montantdevis', 'volume', 'nbcontainers', 'valider', ],
        self::TYPE_COLNAME       => [DevisTableMap::COL_CODEDEVIS, DevisTableMap::COL_DATEDEVIS, DevisTableMap::COL_MONTANTDEVIS, DevisTableMap::COL_VOLUME, DevisTableMap::COL_NBCONTAINERS, DevisTableMap::COL_VALIDER, ],
        self::TYPE_FIELDNAME     => ['codeDevis', 'dateDevis', 'montantDevis', 'volume', 'nbContainers', 'valider', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['Codedevis' => 0, 'Datedevis' => 1, 'Montantdevis' => 2, 'Volume' => 3, 'Nbcontainers' => 4, 'Valider' => 5, ],
        self::TYPE_CAMELNAME     => ['codedevis' => 0, 'datedevis' => 1, 'montantdevis' => 2, 'volume' => 3, 'nbcontainers' => 4, 'valider' => 5, ],
        self::TYPE_COLNAME       => [DevisTableMap::COL_CODEDEVIS => 0, DevisTableMap::COL_DATEDEVIS => 1, DevisTableMap::COL_MONTANTDEVIS => 2, DevisTableMap::COL_VOLUME => 3, DevisTableMap::COL_NBCONTAINERS => 4, DevisTableMap::COL_VALIDER => 5, ],
        self::TYPE_FIELDNAME     => ['codeDevis' => 0, 'dateDevis' => 1, 'montantDevis' => 2, 'volume' => 3, 'nbContainers' => 4, 'valider' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Codedevis' => 'CODEDEVIS',
        'Devis.Codedevis' => 'CODEDEVIS',
        'codedevis' => 'CODEDEVIS',
        'devis.codedevis' => 'CODEDEVIS',
        'DevisTableMap::COL_CODEDEVIS' => 'CODEDEVIS',
        'COL_CODEDEVIS' => 'CODEDEVIS',
        'codeDevis' => 'CODEDEVIS',
        'devis.codeDevis' => 'CODEDEVIS',
        'Datedevis' => 'DATEDEVIS',
        'Devis.Datedevis' => 'DATEDEVIS',
        'datedevis' => 'DATEDEVIS',
        'devis.datedevis' => 'DATEDEVIS',
        'DevisTableMap::COL_DATEDEVIS' => 'DATEDEVIS',
        'COL_DATEDEVIS' => 'DATEDEVIS',
        'dateDevis' => 'DATEDEVIS',
        'devis.dateDevis' => 'DATEDEVIS',
        'Montantdevis' => 'MONTANTDEVIS',
        'Devis.Montantdevis' => 'MONTANTDEVIS',
        'montantdevis' => 'MONTANTDEVIS',
        'devis.montantdevis' => 'MONTANTDEVIS',
        'DevisTableMap::COL_MONTANTDEVIS' => 'MONTANTDEVIS',
        'COL_MONTANTDEVIS' => 'MONTANTDEVIS',
        'montantDevis' => 'MONTANTDEVIS',
        'devis.montantDevis' => 'MONTANTDEVIS',
        'Volume' => 'VOLUME',
        'Devis.Volume' => 'VOLUME',
        'volume' => 'VOLUME',
        'devis.volume' => 'VOLUME',
        'DevisTableMap::COL_VOLUME' => 'VOLUME',
        'COL_VOLUME' => 'VOLUME',
        'Nbcontainers' => 'NBCONTAINERS',
        'Devis.Nbcontainers' => 'NBCONTAINERS',
        'nbcontainers' => 'NBCONTAINERS',
        'devis.nbcontainers' => 'NBCONTAINERS',
        'DevisTableMap::COL_NBCONTAINERS' => 'NBCONTAINERS',
        'COL_NBCONTAINERS' => 'NBCONTAINERS',
        'nbContainers' => 'NBCONTAINERS',
        'devis.nbContainers' => 'NBCONTAINERS',
        'Valider' => 'VALIDER',
        'Devis.Valider' => 'VALIDER',
        'valider' => 'VALIDER',
        'devis.valider' => 'VALIDER',
        'DevisTableMap::COL_VALIDER' => 'VALIDER',
        'COL_VALIDER' => 'VALIDER',
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
        $this->setName('devis');
        $this->setPhpName('Devis');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Devis');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('codeDevis', 'Codedevis', 'INTEGER', true, null, null);
        $this->addColumn('dateDevis', 'Datedevis', 'DATE', true, null, null);
        $this->addColumn('montantDevis', 'Montantdevis', 'DECIMAL', true, 10, null);
        $this->addColumn('volume', 'Volume', 'SMALLINT', false, null, null);
        $this->addColumn('nbContainers', 'Nbcontainers', 'SMALLINT', false, null, null);
        $this->addColumn('valider', 'Valider', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Reservation', '\\App\\Http\\Model\\Reservation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codeDevis',
    1 => ':codeDevis',
  ),
), 'SET NULL', 'CASCADE', 'Reservations', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to devis     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ReservationTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DevisTableMap::CLASS_DEFAULT : DevisTableMap::OM_CLASS;
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
     * @return array (Devis object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DevisTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DevisTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DevisTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DevisTableMap::OM_CLASS;
            /** @var Devis $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DevisTableMap::addInstanceToPool($obj, $key);
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
            $key = DevisTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DevisTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Devis $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DevisTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DevisTableMap::COL_CODEDEVIS);
            $criteria->addSelectColumn(DevisTableMap::COL_DATEDEVIS);
            $criteria->addSelectColumn(DevisTableMap::COL_MONTANTDEVIS);
            $criteria->addSelectColumn(DevisTableMap::COL_VOLUME);
            $criteria->addSelectColumn(DevisTableMap::COL_NBCONTAINERS);
            $criteria->addSelectColumn(DevisTableMap::COL_VALIDER);
        } else {
            $criteria->addSelectColumn($alias . '.codeDevis');
            $criteria->addSelectColumn($alias . '.dateDevis');
            $criteria->addSelectColumn($alias . '.montantDevis');
            $criteria->addSelectColumn($alias . '.volume');
            $criteria->addSelectColumn($alias . '.nbContainers');
            $criteria->addSelectColumn($alias . '.valider');
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
            $criteria->removeSelectColumn(DevisTableMap::COL_CODEDEVIS);
            $criteria->removeSelectColumn(DevisTableMap::COL_DATEDEVIS);
            $criteria->removeSelectColumn(DevisTableMap::COL_MONTANTDEVIS);
            $criteria->removeSelectColumn(DevisTableMap::COL_VOLUME);
            $criteria->removeSelectColumn(DevisTableMap::COL_NBCONTAINERS);
            $criteria->removeSelectColumn(DevisTableMap::COL_VALIDER);
        } else {
            $criteria->removeSelectColumn($alias . '.codeDevis');
            $criteria->removeSelectColumn($alias . '.dateDevis');
            $criteria->removeSelectColumn($alias . '.montantDevis');
            $criteria->removeSelectColumn($alias . '.volume');
            $criteria->removeSelectColumn($alias . '.nbContainers');
            $criteria->removeSelectColumn($alias . '.valider');
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
        return Propel::getServiceContainer()->getDatabaseMap(DevisTableMap::DATABASE_NAME)->getTable(DevisTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Devis or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Devis object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DevisTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Devis) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DevisTableMap::DATABASE_NAME);
            $criteria->add(DevisTableMap::COL_CODEDEVIS, (array) $values, Criteria::IN);
        }

        $query = DevisQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DevisTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DevisTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DevisQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Devis or Criteria object.
     *
     * @param mixed $criteria Criteria or Devis object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DevisTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Devis object
        }

        if ($criteria->containsKey(DevisTableMap::COL_CODEDEVIS) && $criteria->keyContainsValue(DevisTableMap::COL_CODEDEVIS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DevisTableMap::COL_CODEDEVIS.')');
        }


        // Set the correct dbName
        $query = DevisQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
