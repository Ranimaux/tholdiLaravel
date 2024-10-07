<?php

namespace App\Http\Model\Map;

use App\Http\Model\Typecontainer;
use App\Http\Model\TypecontainerQuery;
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
 * This class defines the structure of the 'typeContainer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TypecontainerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.TypecontainerTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'typeContainer';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Typecontainer';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Http\\Model\\Typecontainer';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Typecontainer';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the numTypeContainer field
     */
    public const COL_NUMTYPECONTAINER = 'typeContainer.numTypeContainer';

    /**
     * the column name for the codeTypeContainer field
     */
    public const COL_CODETYPECONTAINER = 'typeContainer.codeTypeContainer';

    /**
     * the column name for the libelleTypeContainer field
     */
    public const COL_LIBELLETYPECONTAINER = 'typeContainer.libelleTypeContainer';

    /**
     * the column name for the longueurEnMillimetre field
     */
    public const COL_LONGUEURENMILLIMETRE = 'typeContainer.longueurEnMillimetre';

    /**
     * the column name for the largeurEnMillimetre field
     */
    public const COL_LARGEURENMILLIMETRE = 'typeContainer.largeurEnMillimetre';

    /**
     * the column name for the hauteurEnMillimetre field
     */
    public const COL_HAUTEURENMILLIMETRE = 'typeContainer.hauteurEnMillimetre';

    /**
     * the column name for the masseEnTonne field
     */
    public const COL_MASSEENTONNE = 'typeContainer.masseEnTonne';

    /**
     * the column name for the volumeEnMetreCube field
     */
    public const COL_VOLUMEENMETRECUBE = 'typeContainer.volumeEnMetreCube';

    /**
     * the column name for the capaciteDeChargeEnTonne field
     */
    public const COL_CAPACITEDECHARGEENTONNE = 'typeContainer.capaciteDeChargeEnTonne';

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
        self::TYPE_PHPNAME       => ['Numtypecontainer', 'Codetypecontainer', 'Libelletypecontainer', 'Longueurenmillimetre', 'Largeurenmillimetre', 'Hauteurenmillimetre', 'Masseentonne', 'Volumeenmetrecube', 'Capacitedechargeentonne', ],
        self::TYPE_CAMELNAME     => ['numtypecontainer', 'codetypecontainer', 'libelletypecontainer', 'longueurenmillimetre', 'largeurenmillimetre', 'hauteurenmillimetre', 'masseentonne', 'volumeenmetrecube', 'capacitedechargeentonne', ],
        self::TYPE_COLNAME       => [TypecontainerTableMap::COL_NUMTYPECONTAINER, TypecontainerTableMap::COL_CODETYPECONTAINER, TypecontainerTableMap::COL_LIBELLETYPECONTAINER, TypecontainerTableMap::COL_LONGUEURENMILLIMETRE, TypecontainerTableMap::COL_LARGEURENMILLIMETRE, TypecontainerTableMap::COL_HAUTEURENMILLIMETRE, TypecontainerTableMap::COL_MASSEENTONNE, TypecontainerTableMap::COL_VOLUMEENMETRECUBE, TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE, ],
        self::TYPE_FIELDNAME     => ['numTypeContainer', 'codeTypeContainer', 'libelleTypeContainer', 'longueurEnMillimetre', 'largeurEnMillimetre', 'hauteurEnMillimetre', 'masseEnTonne', 'volumeEnMetreCube', 'capaciteDeChargeEnTonne', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['Numtypecontainer' => 0, 'Codetypecontainer' => 1, 'Libelletypecontainer' => 2, 'Longueurenmillimetre' => 3, 'Largeurenmillimetre' => 4, 'Hauteurenmillimetre' => 5, 'Masseentonne' => 6, 'Volumeenmetrecube' => 7, 'Capacitedechargeentonne' => 8, ],
        self::TYPE_CAMELNAME     => ['numtypecontainer' => 0, 'codetypecontainer' => 1, 'libelletypecontainer' => 2, 'longueurenmillimetre' => 3, 'largeurenmillimetre' => 4, 'hauteurenmillimetre' => 5, 'masseentonne' => 6, 'volumeenmetrecube' => 7, 'capacitedechargeentonne' => 8, ],
        self::TYPE_COLNAME       => [TypecontainerTableMap::COL_NUMTYPECONTAINER => 0, TypecontainerTableMap::COL_CODETYPECONTAINER => 1, TypecontainerTableMap::COL_LIBELLETYPECONTAINER => 2, TypecontainerTableMap::COL_LONGUEURENMILLIMETRE => 3, TypecontainerTableMap::COL_LARGEURENMILLIMETRE => 4, TypecontainerTableMap::COL_HAUTEURENMILLIMETRE => 5, TypecontainerTableMap::COL_MASSEENTONNE => 6, TypecontainerTableMap::COL_VOLUMEENMETRECUBE => 7, TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE => 8, ],
        self::TYPE_FIELDNAME     => ['numTypeContainer' => 0, 'codeTypeContainer' => 1, 'libelleTypeContainer' => 2, 'longueurEnMillimetre' => 3, 'largeurEnMillimetre' => 4, 'hauteurEnMillimetre' => 5, 'masseEnTonne' => 6, 'volumeEnMetreCube' => 7, 'capaciteDeChargeEnTonne' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Numtypecontainer' => 'NUMTYPECONTAINER',
        'Typecontainer.Numtypecontainer' => 'NUMTYPECONTAINER',
        'numtypecontainer' => 'NUMTYPECONTAINER',
        'typecontainer.numtypecontainer' => 'NUMTYPECONTAINER',
        'TypecontainerTableMap::COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'numTypeContainer' => 'NUMTYPECONTAINER',
        'typeContainer.numTypeContainer' => 'NUMTYPECONTAINER',
        'Codetypecontainer' => 'CODETYPECONTAINER',
        'Typecontainer.Codetypecontainer' => 'CODETYPECONTAINER',
        'codetypecontainer' => 'CODETYPECONTAINER',
        'typecontainer.codetypecontainer' => 'CODETYPECONTAINER',
        'TypecontainerTableMap::COL_CODETYPECONTAINER' => 'CODETYPECONTAINER',
        'COL_CODETYPECONTAINER' => 'CODETYPECONTAINER',
        'codeTypeContainer' => 'CODETYPECONTAINER',
        'typeContainer.codeTypeContainer' => 'CODETYPECONTAINER',
        'Libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'Typecontainer.Libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'typecontainer.libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'TypecontainerTableMap::COL_LIBELLETYPECONTAINER' => 'LIBELLETYPECONTAINER',
        'COL_LIBELLETYPECONTAINER' => 'LIBELLETYPECONTAINER',
        'libelleTypeContainer' => 'LIBELLETYPECONTAINER',
        'typeContainer.libelleTypeContainer' => 'LIBELLETYPECONTAINER',
        'Longueurenmillimetre' => 'LONGUEURENMILLIMETRE',
        'Typecontainer.Longueurenmillimetre' => 'LONGUEURENMILLIMETRE',
        'longueurenmillimetre' => 'LONGUEURENMILLIMETRE',
        'typecontainer.longueurenmillimetre' => 'LONGUEURENMILLIMETRE',
        'TypecontainerTableMap::COL_LONGUEURENMILLIMETRE' => 'LONGUEURENMILLIMETRE',
        'COL_LONGUEURENMILLIMETRE' => 'LONGUEURENMILLIMETRE',
        'longueurEnMillimetre' => 'LONGUEURENMILLIMETRE',
        'typeContainer.longueurEnMillimetre' => 'LONGUEURENMILLIMETRE',
        'Largeurenmillimetre' => 'LARGEURENMILLIMETRE',
        'Typecontainer.Largeurenmillimetre' => 'LARGEURENMILLIMETRE',
        'largeurenmillimetre' => 'LARGEURENMILLIMETRE',
        'typecontainer.largeurenmillimetre' => 'LARGEURENMILLIMETRE',
        'TypecontainerTableMap::COL_LARGEURENMILLIMETRE' => 'LARGEURENMILLIMETRE',
        'COL_LARGEURENMILLIMETRE' => 'LARGEURENMILLIMETRE',
        'largeurEnMillimetre' => 'LARGEURENMILLIMETRE',
        'typeContainer.largeurEnMillimetre' => 'LARGEURENMILLIMETRE',
        'Hauteurenmillimetre' => 'HAUTEURENMILLIMETRE',
        'Typecontainer.Hauteurenmillimetre' => 'HAUTEURENMILLIMETRE',
        'hauteurenmillimetre' => 'HAUTEURENMILLIMETRE',
        'typecontainer.hauteurenmillimetre' => 'HAUTEURENMILLIMETRE',
        'TypecontainerTableMap::COL_HAUTEURENMILLIMETRE' => 'HAUTEURENMILLIMETRE',
        'COL_HAUTEURENMILLIMETRE' => 'HAUTEURENMILLIMETRE',
        'hauteurEnMillimetre' => 'HAUTEURENMILLIMETRE',
        'typeContainer.hauteurEnMillimetre' => 'HAUTEURENMILLIMETRE',
        'Masseentonne' => 'MASSEENTONNE',
        'Typecontainer.Masseentonne' => 'MASSEENTONNE',
        'masseentonne' => 'MASSEENTONNE',
        'typecontainer.masseentonne' => 'MASSEENTONNE',
        'TypecontainerTableMap::COL_MASSEENTONNE' => 'MASSEENTONNE',
        'COL_MASSEENTONNE' => 'MASSEENTONNE',
        'masseEnTonne' => 'MASSEENTONNE',
        'typeContainer.masseEnTonne' => 'MASSEENTONNE',
        'Volumeenmetrecube' => 'VOLUMEENMETRECUBE',
        'Typecontainer.Volumeenmetrecube' => 'VOLUMEENMETRECUBE',
        'volumeenmetrecube' => 'VOLUMEENMETRECUBE',
        'typecontainer.volumeenmetrecube' => 'VOLUMEENMETRECUBE',
        'TypecontainerTableMap::COL_VOLUMEENMETRECUBE' => 'VOLUMEENMETRECUBE',
        'COL_VOLUMEENMETRECUBE' => 'VOLUMEENMETRECUBE',
        'volumeEnMetreCube' => 'VOLUMEENMETRECUBE',
        'typeContainer.volumeEnMetreCube' => 'VOLUMEENMETRECUBE',
        'Capacitedechargeentonne' => 'CAPACITEDECHARGEENTONNE',
        'Typecontainer.Capacitedechargeentonne' => 'CAPACITEDECHARGEENTONNE',
        'capacitedechargeentonne' => 'CAPACITEDECHARGEENTONNE',
        'typecontainer.capacitedechargeentonne' => 'CAPACITEDECHARGEENTONNE',
        'TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE' => 'CAPACITEDECHARGEENTONNE',
        'COL_CAPACITEDECHARGEENTONNE' => 'CAPACITEDECHARGEENTONNE',
        'capaciteDeChargeEnTonne' => 'CAPACITEDECHARGEENTONNE',
        'typeContainer.capaciteDeChargeEnTonne' => 'CAPACITEDECHARGEENTONNE',
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
        $this->setName('typeContainer');
        $this->setPhpName('Typecontainer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Typecontainer');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('numTypeContainer', 'Numtypecontainer', 'SMALLINT', true, null, null);
        $this->addColumn('codeTypeContainer', 'Codetypecontainer', 'CHAR', true, 4, null);
        $this->addColumn('libelleTypeContainer', 'Libelletypecontainer', 'VARCHAR', true, 200, null);
        $this->addColumn('longueurEnMillimetre', 'Longueurenmillimetre', 'DECIMAL', true, 5, null);
        $this->addColumn('largeurEnMillimetre', 'Largeurenmillimetre', 'DECIMAL', true, 5, null);
        $this->addColumn('hauteurEnMillimetre', 'Hauteurenmillimetre', 'DECIMAL', true, 5, null);
        $this->addColumn('masseEnTonne', 'Masseentonne', 'DECIMAL', false, 5, null);
        $this->addColumn('volumeEnMetreCube', 'Volumeenmetrecube', 'DECIMAL', false, 4, null);
        $this->addColumn('capaciteDeChargeEnTonne', 'Capacitedechargeentonne', 'DECIMAL', false, 5, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Reserver', '\\App\\Http\\Model\\Reserver', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':numTypeContainer',
    1 => ':numTypeContainer',
  ),
), null, null, 'Reservers', false);
        $this->addRelation('Tarificationcontainer', '\\App\\Http\\Model\\Tarificationcontainer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':numTypeContainer',
    1 => ':numTypeContainer',
  ),
), null, null, 'Tarificationcontainers', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TypecontainerTableMap::CLASS_DEFAULT : TypecontainerTableMap::OM_CLASS;
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
     * @return array (Typecontainer object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TypecontainerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TypecontainerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TypecontainerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TypecontainerTableMap::OM_CLASS;
            /** @var Typecontainer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TypecontainerTableMap::addInstanceToPool($obj, $key);
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
            $key = TypecontainerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TypecontainerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Typecontainer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TypecontainerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TypecontainerTableMap::COL_NUMTYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_CODETYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LIBELLETYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LARGEURENMILLIMETRE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_MASSEENTONNE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_VOLUMEENMETRECUBE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE);
        } else {
            $criteria->addSelectColumn($alias . '.numTypeContainer');
            $criteria->addSelectColumn($alias . '.codeTypeContainer');
            $criteria->addSelectColumn($alias . '.libelleTypeContainer');
            $criteria->addSelectColumn($alias . '.longueurEnMillimetre');
            $criteria->addSelectColumn($alias . '.largeurEnMillimetre');
            $criteria->addSelectColumn($alias . '.hauteurEnMillimetre');
            $criteria->addSelectColumn($alias . '.masseEnTonne');
            $criteria->addSelectColumn($alias . '.volumeEnMetreCube');
            $criteria->addSelectColumn($alias . '.capaciteDeChargeEnTonne');
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
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_NUMTYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_CODETYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LIBELLETYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LARGEURENMILLIMETRE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_MASSEENTONNE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_VOLUMEENMETRECUBE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE);
        } else {
            $criteria->removeSelectColumn($alias . '.numTypeContainer');
            $criteria->removeSelectColumn($alias . '.codeTypeContainer');
            $criteria->removeSelectColumn($alias . '.libelleTypeContainer');
            $criteria->removeSelectColumn($alias . '.longueurEnMillimetre');
            $criteria->removeSelectColumn($alias . '.largeurEnMillimetre');
            $criteria->removeSelectColumn($alias . '.hauteurEnMillimetre');
            $criteria->removeSelectColumn($alias . '.masseEnTonne');
            $criteria->removeSelectColumn($alias . '.volumeEnMetreCube');
            $criteria->removeSelectColumn($alias . '.capaciteDeChargeEnTonne');
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
        return Propel::getServiceContainer()->getDatabaseMap(TypecontainerTableMap::DATABASE_NAME)->getTable(TypecontainerTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Typecontainer or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Typecontainer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Typecontainer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TypecontainerTableMap::DATABASE_NAME);
            $criteria->add(TypecontainerTableMap::COL_NUMTYPECONTAINER, (array) $values, Criteria::IN);
        }

        $query = TypecontainerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TypecontainerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TypecontainerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the typeContainer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TypecontainerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Typecontainer or Criteria object.
     *
     * @param mixed $criteria Criteria or Typecontainer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Typecontainer object
        }


        // Set the correct dbName
        $query = TypecontainerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
