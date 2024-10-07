<?php

namespace App\Http\Model\Map;

use App\Http\Model\Utilisateur;
use App\Http\Model\UtilisateurQuery;
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
 * This class defines the structure of the 'utilisateur' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UtilisateurTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.UtilisateurTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'utilisateur';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Utilisateur';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Http\\Model\\Utilisateur';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Utilisateur';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the codeUtilisateur field
     */
    public const COL_CODEUTILISATEUR = 'utilisateur.codeUtilisateur';

    /**
     * the column name for the raisonSociale field
     */
    public const COL_RAISONSOCIALE = 'utilisateur.raisonSociale';

    /**
     * the column name for the adresse field
     */
    public const COL_ADRESSE = 'utilisateur.adresse';

    /**
     * the column name for the cp field
     */
    public const COL_CP = 'utilisateur.cp';

    /**
     * the column name for the ville field
     */
    public const COL_VILLE = 'utilisateur.ville';

    /**
     * the column name for the adrMel field
     */
    public const COL_ADRMEL = 'utilisateur.adrMel';

    /**
     * the column name for the telephone field
     */
    public const COL_TELEPHONE = 'utilisateur.telephone';

    /**
     * the column name for the contact field
     */
    public const COL_CONTACT = 'utilisateur.contact';

    /**
     * the column name for the codePays field
     */
    public const COL_CODEPAYS = 'utilisateur.codePays';

    /**
     * the column name for the identifiant field
     */
    public const COL_IDENTIFIANT = 'utilisateur.identifiant';

    /**
     * the column name for the password field
     */
    public const COL_PASSWORD = 'utilisateur.password';

    /**
     * the column name for the profil field
     */
    public const COL_PROFIL = 'utilisateur.profil';

    /**
     * the column name for the nombreDeTentativesDeConnexion field
     */
    public const COL_NOMBREDETENTATIVESDECONNEXION = 'utilisateur.nombreDeTentativesDeConnexion';

    /**
     * the column name for the derniereTentativeDeConnexionNonValide field
     */
    public const COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE = 'utilisateur.derniereTentativeDeConnexionNonValide';

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
        self::TYPE_PHPNAME       => ['Codeutilisateur', 'Raisonsociale', 'Adresse', 'Cp', 'Ville', 'Adrmel', 'Telephone', 'Contact', 'Codepays', 'Identifiant', 'Password', 'Profil', 'Nombredetentativesdeconnexion', 'Dernieretentativedeconnexionnonvalide', ],
        self::TYPE_CAMELNAME     => ['codeutilisateur', 'raisonsociale', 'adresse', 'cp', 'ville', 'adrmel', 'telephone', 'contact', 'codepays', 'identifiant', 'password', 'profil', 'nombredetentativesdeconnexion', 'dernieretentativedeconnexionnonvalide', ],
        self::TYPE_COLNAME       => [UtilisateurTableMap::COL_CODEUTILISATEUR, UtilisateurTableMap::COL_RAISONSOCIALE, UtilisateurTableMap::COL_ADRESSE, UtilisateurTableMap::COL_CP, UtilisateurTableMap::COL_VILLE, UtilisateurTableMap::COL_ADRMEL, UtilisateurTableMap::COL_TELEPHONE, UtilisateurTableMap::COL_CONTACT, UtilisateurTableMap::COL_CODEPAYS, UtilisateurTableMap::COL_IDENTIFIANT, UtilisateurTableMap::COL_PASSWORD, UtilisateurTableMap::COL_PROFIL, UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION, UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE, ],
        self::TYPE_FIELDNAME     => ['codeUtilisateur', 'raisonSociale', 'adresse', 'cp', 'ville', 'adrMel', 'telephone', 'contact', 'codePays', 'identifiant', 'password', 'profil', 'nombreDeTentativesDeConnexion', 'derniereTentativeDeConnexionNonValide', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['Codeutilisateur' => 0, 'Raisonsociale' => 1, 'Adresse' => 2, 'Cp' => 3, 'Ville' => 4, 'Adrmel' => 5, 'Telephone' => 6, 'Contact' => 7, 'Codepays' => 8, 'Identifiant' => 9, 'Password' => 10, 'Profil' => 11, 'Nombredetentativesdeconnexion' => 12, 'Dernieretentativedeconnexionnonvalide' => 13, ],
        self::TYPE_CAMELNAME     => ['codeutilisateur' => 0, 'raisonsociale' => 1, 'adresse' => 2, 'cp' => 3, 'ville' => 4, 'adrmel' => 5, 'telephone' => 6, 'contact' => 7, 'codepays' => 8, 'identifiant' => 9, 'password' => 10, 'profil' => 11, 'nombredetentativesdeconnexion' => 12, 'dernieretentativedeconnexionnonvalide' => 13, ],
        self::TYPE_COLNAME       => [UtilisateurTableMap::COL_CODEUTILISATEUR => 0, UtilisateurTableMap::COL_RAISONSOCIALE => 1, UtilisateurTableMap::COL_ADRESSE => 2, UtilisateurTableMap::COL_CP => 3, UtilisateurTableMap::COL_VILLE => 4, UtilisateurTableMap::COL_ADRMEL => 5, UtilisateurTableMap::COL_TELEPHONE => 6, UtilisateurTableMap::COL_CONTACT => 7, UtilisateurTableMap::COL_CODEPAYS => 8, UtilisateurTableMap::COL_IDENTIFIANT => 9, UtilisateurTableMap::COL_PASSWORD => 10, UtilisateurTableMap::COL_PROFIL => 11, UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION => 12, UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE => 13, ],
        self::TYPE_FIELDNAME     => ['codeUtilisateur' => 0, 'raisonSociale' => 1, 'adresse' => 2, 'cp' => 3, 'ville' => 4, 'adrMel' => 5, 'telephone' => 6, 'contact' => 7, 'codePays' => 8, 'identifiant' => 9, 'password' => 10, 'profil' => 11, 'nombreDeTentativesDeConnexion' => 12, 'derniereTentativeDeConnexionNonValide' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Codeutilisateur' => 'CODEUTILISATEUR',
        'Utilisateur.Codeutilisateur' => 'CODEUTILISATEUR',
        'codeutilisateur' => 'CODEUTILISATEUR',
        'utilisateur.codeutilisateur' => 'CODEUTILISATEUR',
        'UtilisateurTableMap::COL_CODEUTILISATEUR' => 'CODEUTILISATEUR',
        'COL_CODEUTILISATEUR' => 'CODEUTILISATEUR',
        'codeUtilisateur' => 'CODEUTILISATEUR',
        'utilisateur.codeUtilisateur' => 'CODEUTILISATEUR',
        'Raisonsociale' => 'RAISONSOCIALE',
        'Utilisateur.Raisonsociale' => 'RAISONSOCIALE',
        'raisonsociale' => 'RAISONSOCIALE',
        'utilisateur.raisonsociale' => 'RAISONSOCIALE',
        'UtilisateurTableMap::COL_RAISONSOCIALE' => 'RAISONSOCIALE',
        'COL_RAISONSOCIALE' => 'RAISONSOCIALE',
        'raisonSociale' => 'RAISONSOCIALE',
        'utilisateur.raisonSociale' => 'RAISONSOCIALE',
        'Adresse' => 'ADRESSE',
        'Utilisateur.Adresse' => 'ADRESSE',
        'adresse' => 'ADRESSE',
        'utilisateur.adresse' => 'ADRESSE',
        'UtilisateurTableMap::COL_ADRESSE' => 'ADRESSE',
        'COL_ADRESSE' => 'ADRESSE',
        'Cp' => 'CP',
        'Utilisateur.Cp' => 'CP',
        'cp' => 'CP',
        'utilisateur.cp' => 'CP',
        'UtilisateurTableMap::COL_CP' => 'CP',
        'COL_CP' => 'CP',
        'Ville' => 'VILLE',
        'Utilisateur.Ville' => 'VILLE',
        'ville' => 'VILLE',
        'utilisateur.ville' => 'VILLE',
        'UtilisateurTableMap::COL_VILLE' => 'VILLE',
        'COL_VILLE' => 'VILLE',
        'Adrmel' => 'ADRMEL',
        'Utilisateur.Adrmel' => 'ADRMEL',
        'adrmel' => 'ADRMEL',
        'utilisateur.adrmel' => 'ADRMEL',
        'UtilisateurTableMap::COL_ADRMEL' => 'ADRMEL',
        'COL_ADRMEL' => 'ADRMEL',
        'adrMel' => 'ADRMEL',
        'utilisateur.adrMel' => 'ADRMEL',
        'Telephone' => 'TELEPHONE',
        'Utilisateur.Telephone' => 'TELEPHONE',
        'telephone' => 'TELEPHONE',
        'utilisateur.telephone' => 'TELEPHONE',
        'UtilisateurTableMap::COL_TELEPHONE' => 'TELEPHONE',
        'COL_TELEPHONE' => 'TELEPHONE',
        'Contact' => 'CONTACT',
        'Utilisateur.Contact' => 'CONTACT',
        'contact' => 'CONTACT',
        'utilisateur.contact' => 'CONTACT',
        'UtilisateurTableMap::COL_CONTACT' => 'CONTACT',
        'COL_CONTACT' => 'CONTACT',
        'Codepays' => 'CODEPAYS',
        'Utilisateur.Codepays' => 'CODEPAYS',
        'codepays' => 'CODEPAYS',
        'utilisateur.codepays' => 'CODEPAYS',
        'UtilisateurTableMap::COL_CODEPAYS' => 'CODEPAYS',
        'COL_CODEPAYS' => 'CODEPAYS',
        'codePays' => 'CODEPAYS',
        'utilisateur.codePays' => 'CODEPAYS',
        'Identifiant' => 'IDENTIFIANT',
        'Utilisateur.Identifiant' => 'IDENTIFIANT',
        'identifiant' => 'IDENTIFIANT',
        'utilisateur.identifiant' => 'IDENTIFIANT',
        'UtilisateurTableMap::COL_IDENTIFIANT' => 'IDENTIFIANT',
        'COL_IDENTIFIANT' => 'IDENTIFIANT',
        'Password' => 'PASSWORD',
        'Utilisateur.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'utilisateur.password' => 'PASSWORD',
        'UtilisateurTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'Profil' => 'PROFIL',
        'Utilisateur.Profil' => 'PROFIL',
        'profil' => 'PROFIL',
        'utilisateur.profil' => 'PROFIL',
        'UtilisateurTableMap::COL_PROFIL' => 'PROFIL',
        'COL_PROFIL' => 'PROFIL',
        'Nombredetentativesdeconnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'Utilisateur.Nombredetentativesdeconnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'nombredetentativesdeconnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'utilisateur.nombredetentativesdeconnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION' => 'NOMBREDETENTATIVESDECONNEXION',
        'COL_NOMBREDETENTATIVESDECONNEXION' => 'NOMBREDETENTATIVESDECONNEXION',
        'nombreDeTentativesDeConnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'utilisateur.nombreDeTentativesDeConnexion' => 'NOMBREDETENTATIVESDECONNEXION',
        'Dernieretentativedeconnexionnonvalide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'Utilisateur.Dernieretentativedeconnexionnonvalide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'dernieretentativedeconnexionnonvalide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'utilisateur.dernieretentativedeconnexionnonvalide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'derniereTentativeDeConnexionNonValide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
        'utilisateur.derniereTentativeDeConnexionNonValide' => 'DERNIERETENTATIVEDECONNEXIONNONVALIDE',
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
        $this->setName('utilisateur');
        $this->setPhpName('Utilisateur');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Utilisateur');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('codeUtilisateur', 'Codeutilisateur', 'INTEGER', true, null, null);
        $this->addColumn('raisonSociale', 'Raisonsociale', 'VARCHAR', true, 50, null);
        $this->addColumn('adresse', 'Adresse', 'VARCHAR', true, 80, null);
        $this->addColumn('cp', 'Cp', 'CHAR', false, 5, null);
        $this->addColumn('ville', 'Ville', 'VARCHAR', false, 40, null);
        $this->addColumn('adrMel', 'Adrmel', 'VARCHAR', false, 100, null);
        $this->addColumn('telephone', 'Telephone', 'CHAR', false, 10, null);
        $this->addColumn('contact', 'Contact', 'VARCHAR', false, 50, null);
        $this->addForeignKey('codePays', 'Codepays', 'CHAR', 'pays', 'codePays', true, 4, null);
        $this->addColumn('identifiant', 'Identifiant', 'CHAR', true, 10, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('profil', 'Profil', 'CHAR', true, null, 'client');
        $this->addColumn('nombreDeTentativesDeConnexion', 'Nombredetentativesdeconnexion', 'TINYINT', true, null, 0);
        $this->addColumn('derniereTentativeDeConnexionNonValide', 'Dernieretentativedeconnexionnonvalide', 'DATETIME', false, null, null);
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
        $this->addRelation('Reservation', '\\App\\Http\\Model\\Reservation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codeUtilisateur',
    1 => ':codeUtilisateur',
  ),
), null, null, 'Reservations', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UtilisateurTableMap::CLASS_DEFAULT : UtilisateurTableMap::OM_CLASS;
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
     * @return array (Utilisateur object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UtilisateurTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UtilisateurTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UtilisateurTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UtilisateurTableMap::OM_CLASS;
            /** @var Utilisateur $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UtilisateurTableMap::addInstanceToPool($obj, $key);
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
            $key = UtilisateurTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UtilisateurTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Utilisateur $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UtilisateurTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UtilisateurTableMap::COL_CODEUTILISATEUR);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_RAISONSOCIALE);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_ADRESSE);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_CP);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_VILLE);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_ADRMEL);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_TELEPHONE);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_CONTACT);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_CODEPAYS);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_IDENTIFIANT);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_PROFIL);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION);
            $criteria->addSelectColumn(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE);
        } else {
            $criteria->addSelectColumn($alias . '.codeUtilisateur');
            $criteria->addSelectColumn($alias . '.raisonSociale');
            $criteria->addSelectColumn($alias . '.adresse');
            $criteria->addSelectColumn($alias . '.cp');
            $criteria->addSelectColumn($alias . '.ville');
            $criteria->addSelectColumn($alias . '.adrMel');
            $criteria->addSelectColumn($alias . '.telephone');
            $criteria->addSelectColumn($alias . '.contact');
            $criteria->addSelectColumn($alias . '.codePays');
            $criteria->addSelectColumn($alias . '.identifiant');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.profil');
            $criteria->addSelectColumn($alias . '.nombreDeTentativesDeConnexion');
            $criteria->addSelectColumn($alias . '.derniereTentativeDeConnexionNonValide');
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
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_CODEUTILISATEUR);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_RAISONSOCIALE);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_ADRESSE);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_CP);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_VILLE);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_ADRMEL);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_TELEPHONE);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_CONTACT);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_CODEPAYS);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_IDENTIFIANT);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_PROFIL);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION);
            $criteria->removeSelectColumn(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE);
        } else {
            $criteria->removeSelectColumn($alias . '.codeUtilisateur');
            $criteria->removeSelectColumn($alias . '.raisonSociale');
            $criteria->removeSelectColumn($alias . '.adresse');
            $criteria->removeSelectColumn($alias . '.cp');
            $criteria->removeSelectColumn($alias . '.ville');
            $criteria->removeSelectColumn($alias . '.adrMel');
            $criteria->removeSelectColumn($alias . '.telephone');
            $criteria->removeSelectColumn($alias . '.contact');
            $criteria->removeSelectColumn($alias . '.codePays');
            $criteria->removeSelectColumn($alias . '.identifiant');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.profil');
            $criteria->removeSelectColumn($alias . '.nombreDeTentativesDeConnexion');
            $criteria->removeSelectColumn($alias . '.derniereTentativeDeConnexionNonValide');
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
        return Propel::getServiceContainer()->getDatabaseMap(UtilisateurTableMap::DATABASE_NAME)->getTable(UtilisateurTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Utilisateur or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Utilisateur object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Utilisateur) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UtilisateurTableMap::DATABASE_NAME);
            $criteria->add(UtilisateurTableMap::COL_CODEUTILISATEUR, (array) $values, Criteria::IN);
        }

        $query = UtilisateurQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UtilisateurTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UtilisateurTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the utilisateur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UtilisateurQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Utilisateur or Criteria object.
     *
     * @param mixed $criteria Criteria or Utilisateur object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Utilisateur object
        }

        if ($criteria->containsKey(UtilisateurTableMap::COL_CODEUTILISATEUR) && $criteria->keyContainsValue(UtilisateurTableMap::COL_CODEUTILISATEUR) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UtilisateurTableMap::COL_CODEUTILISATEUR.')');
        }


        // Set the correct dbName
        $query = UtilisateurQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
