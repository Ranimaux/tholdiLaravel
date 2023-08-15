<?php

namespace App\Http\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Http\Model\Pays as ChildPays;
use App\Http\Model\PaysQuery as ChildPaysQuery;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Utilisateur as ChildUtilisateur;
use App\Http\Model\UtilisateurQuery as ChildUtilisateurQuery;
use App\Http\Model\Map\ReservationTableMap;
use App\Http\Model\Map\UtilisateurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'utilisateur' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Utilisateur implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Http\\Model\\Map\\UtilisateurTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the codeutilisateur field.
     *
     * @var        int
     */
    protected $codeutilisateur;

    /**
     * The value for the raisonsociale field.
     *
     * @var        string
     */
    protected $raisonsociale;

    /**
     * The value for the adresse field.
     *
     * @var        string
     */
    protected $adresse;

    /**
     * The value for the cp field.
     *
     * @var        string|null
     */
    protected $cp;

    /**
     * The value for the ville field.
     *
     * @var        string|null
     */
    protected $ville;

    /**
     * The value for the adrmel field.
     *
     * @var        string|null
     */
    protected $adrmel;

    /**
     * The value for the telephone field.
     *
     * @var        string|null
     */
    protected $telephone;

    /**
     * The value for the contact field.
     *
     * @var        string|null
     */
    protected $contact;

    /**
     * The value for the codepays field.
     *
     * @var        string
     */
    protected $codepays;

    /**
     * The value for the identifiant field.
     *
     * @var        string
     */
    protected $identifiant;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the profil field.
     *
     * Note: this column has a database default value of: 'client'
     * @var        string
     */
    protected $profil;

    /**
     * The value for the nombredetentativesdeconnexion field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $nombredetentativesdeconnexion;

    /**
     * The value for the dernieretentativedeconnexionnonvalide field.
     *
     * @var        DateTime|null
     */
    protected $dernieretentativedeconnexionnonvalide;

    /**
     * @var        ChildPays
     */
    protected $aPays;

    /**
     * @var        ObjectCollection|ChildReservation[] Collection to store aggregation of ChildReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation> Collection to store aggregation of ChildReservation objects.
     */
    protected $collReservations;
    protected $collReservationsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReservation[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation>
     */
    protected $reservationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->profil = 'client';
        $this->nombredetentativesdeconnexion = 0;
    }

    /**
     * Initializes internal state of App\Http\Model\Base\Utilisateur object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Utilisateur</code> instance.  If
     * <code>obj</code> is an instance of <code>Utilisateur</code>, delegates to
     * <code>equals(Utilisateur)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [codeutilisateur] column value.
     *
     * @return int
     */
    public function getCodeutilisateur()
    {
        return $this->codeutilisateur;
    }

    /**
     * Get the [raisonsociale] column value.
     *
     * @return string
     */
    public function getRaisonsociale()
    {
        return $this->raisonsociale;
    }

    /**
     * Get the [adresse] column value.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Get the [cp] column value.
     *
     * @return string|null
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Get the [ville] column value.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Get the [adrmel] column value.
     *
     * @return string|null
     */
    public function getAdrmel()
    {
        return $this->adrmel;
    }

    /**
     * Get the [telephone] column value.
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Get the [contact] column value.
     *
     * @return string|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Get the [codepays] column value.
     *
     * @return string
     */
    public function getCodepays()
    {
        return $this->codepays;
    }

    /**
     * Get the [identifiant] column value.
     *
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [profil] column value.
     *
     * @return string
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Get the [nombredetentativesdeconnexion] column value.
     *
     * @return int
     */
    public function getNombredetentativesdeconnexion()
    {
        return $this->nombredetentativesdeconnexion;
    }

    /**
     * Get the [optionally formatted] temporal [dernieretentativedeconnexionnonvalide] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getDernieretentativedeconnexionnonvalide($format = null)
    {
        if ($format === null) {
            return $this->dernieretentativedeconnexionnonvalide;
        } else {
            return $this->dernieretentativedeconnexionnonvalide instanceof \DateTimeInterface ? $this->dernieretentativedeconnexionnonvalide->format($format) : null;
        }
    }

    /**
     * Set the value of [codeutilisateur] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodeutilisateur($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codeutilisateur !== $v) {
            $this->codeutilisateur = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CODEUTILISATEUR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [raisonsociale] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRaisonsociale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->raisonsociale !== $v) {
            $this->raisonsociale = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_RAISONSOCIALE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [adresse] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdresse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adresse !== $v) {
            $this->adresse = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_ADRESSE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cp !== $v) {
            $this->cp = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ville] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVille($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ville !== $v) {
            $this->ville = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_VILLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [adrmel] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdrmel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adrmel !== $v) {
            $this->adrmel = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_ADRMEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [telephone] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telephone !== $v) {
            $this->telephone = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_TELEPHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contact] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CONTACT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [codepays] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodepays($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codepays !== $v) {
            $this->codepays = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CODEPAYS] = true;
        }

        if ($this->aPays !== null && $this->aPays->getCodepays() !== $v) {
            $this->aPays = null;
        }

        return $this;
    }

    /**
     * Set the value of [identifiant] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdentifiant($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->identifiant !== $v) {
            $this->identifiant = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_IDENTIFIANT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_PASSWORD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [profil] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProfil($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->profil !== $v) {
            $this->profil = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_PROFIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nombredetentativesdeconnexion] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNombredetentativesdeconnexion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nombredetentativesdeconnexion !== $v) {
            $this->nombredetentativesdeconnexion = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [dernieretentativedeconnexionnonvalide] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDernieretentativedeconnexionnonvalide($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dernieretentativedeconnexionnonvalide !== null || $dt !== null) {
            if ($this->dernieretentativedeconnexionnonvalide === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->dernieretentativedeconnexionnonvalide->format("Y-m-d H:i:s.u")) {
                $this->dernieretentativedeconnexionnonvalide = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->profil !== 'client') {
                return false;
            }

            if ($this->nombredetentativesdeconnexion !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UtilisateurTableMap::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codeutilisateur = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UtilisateurTableMap::translateFieldName('Raisonsociale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->raisonsociale = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UtilisateurTableMap::translateFieldName('Adresse', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adresse = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UtilisateurTableMap::translateFieldName('Cp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UtilisateurTableMap::translateFieldName('Ville', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ville = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UtilisateurTableMap::translateFieldName('Adrmel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adrmel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UtilisateurTableMap::translateFieldName('Telephone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telephone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UtilisateurTableMap::translateFieldName('Contact', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UtilisateurTableMap::translateFieldName('Codepays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codepays = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UtilisateurTableMap::translateFieldName('Identifiant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->identifiant = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UtilisateurTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UtilisateurTableMap::translateFieldName('Profil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->profil = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UtilisateurTableMap::translateFieldName('Nombredetentativesdeconnexion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombredetentativesdeconnexion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UtilisateurTableMap::translateFieldName('Dernieretentativedeconnexionnonvalide', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->dernieretentativedeconnexionnonvalide = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = UtilisateurTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Utilisateur'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aPays !== null && $this->codepays !== $this->aPays->getCodepays()) {
            $this->aPays = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUtilisateurQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPays = null;
            $this->collReservations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Utilisateur::setDeleted()
     * @see Utilisateur::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUtilisateurQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UtilisateurTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPays !== null) {
                if ($this->aPays->isModified() || $this->aPays->isNew()) {
                    $affectedRows += $this->aPays->save($con);
                }
                $this->setPays($this->aPays);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->reservationsScheduledForDeletion !== null) {
                if (!$this->reservationsScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReservationQuery::create()
                        ->filterByPrimaryKeys($this->reservationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reservationsScheduledForDeletion = null;
                }
            }

            if ($this->collReservations !== null) {
                foreach ($this->collReservations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[UtilisateurTableMap::COL_CODEUTILISATEUR] = true;
        if (null !== $this->codeutilisateur) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UtilisateurTableMap::COL_CODEUTILISATEUR . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEUTILISATEUR)) {
            $modifiedColumns[':p' . $index++]  = 'codeUtilisateur';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_RAISONSOCIALE)) {
            $modifiedColumns[':p' . $index++]  = 'raisonSociale';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRESSE)) {
            $modifiedColumns[':p' . $index++]  = 'adresse';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CP)) {
            $modifiedColumns[':p' . $index++]  = 'cp';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_VILLE)) {
            $modifiedColumns[':p' . $index++]  = 'ville';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRMEL)) {
            $modifiedColumns[':p' . $index++]  = 'adrMel';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'telephone';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CONTACT)) {
            $modifiedColumns[':p' . $index++]  = 'contact';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEPAYS)) {
            $modifiedColumns[':p' . $index++]  = 'codePays';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_IDENTIFIANT)) {
            $modifiedColumns[':p' . $index++]  = 'identifiant';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_PROFIL)) {
            $modifiedColumns[':p' . $index++]  = 'profil';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION)) {
            $modifiedColumns[':p' . $index++]  = 'nombreDeTentativesDeConnexion';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE)) {
            $modifiedColumns[':p' . $index++]  = 'derniereTentativeDeConnexionNonValide';
        }

        $sql = sprintf(
            'INSERT INTO utilisateur (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codeUtilisateur':
                        $stmt->bindValue($identifier, $this->codeutilisateur, PDO::PARAM_INT);

                        break;
                    case 'raisonSociale':
                        $stmt->bindValue($identifier, $this->raisonsociale, PDO::PARAM_STR);

                        break;
                    case 'adresse':
                        $stmt->bindValue($identifier, $this->adresse, PDO::PARAM_STR);

                        break;
                    case 'cp':
                        $stmt->bindValue($identifier, $this->cp, PDO::PARAM_STR);

                        break;
                    case 'ville':
                        $stmt->bindValue($identifier, $this->ville, PDO::PARAM_STR);

                        break;
                    case 'adrMel':
                        $stmt->bindValue($identifier, $this->adrmel, PDO::PARAM_STR);

                        break;
                    case 'telephone':
                        $stmt->bindValue($identifier, $this->telephone, PDO::PARAM_STR);

                        break;
                    case 'contact':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);

                        break;
                    case 'codePays':
                        $stmt->bindValue($identifier, $this->codepays, PDO::PARAM_STR);

                        break;
                    case 'identifiant':
                        $stmt->bindValue($identifier, $this->identifiant, PDO::PARAM_STR);

                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);

                        break;
                    case 'profil':
                        $stmt->bindValue($identifier, $this->profil, PDO::PARAM_STR);

                        break;
                    case 'nombreDeTentativesDeConnexion':
                        $stmt->bindValue($identifier, $this->nombredetentativesdeconnexion, PDO::PARAM_INT);

                        break;
                    case 'derniereTentativeDeConnexionNonValide':
                        $stmt->bindValue($identifier, $this->dernieretentativedeconnexionnonvalide ? $this->dernieretentativedeconnexionnonvalide->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setCodeutilisateur($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UtilisateurTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getCodeutilisateur();

            case 1:
                return $this->getRaisonsociale();

            case 2:
                return $this->getAdresse();

            case 3:
                return $this->getCp();

            case 4:
                return $this->getVille();

            case 5:
                return $this->getAdrmel();

            case 6:
                return $this->getTelephone();

            case 7:
                return $this->getContact();

            case 8:
                return $this->getCodepays();

            case 9:
                return $this->getIdentifiant();

            case 10:
                return $this->getPassword();

            case 11:
                return $this->getProfil();

            case 12:
                return $this->getNombredetentativesdeconnexion();

            case 13:
                return $this->getDernieretentativedeconnexionnonvalide();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Utilisateur'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Utilisateur'][$this->hashCode()] = true;
        $keys = UtilisateurTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCodeutilisateur(),
            $keys[1] => $this->getRaisonsociale(),
            $keys[2] => $this->getAdresse(),
            $keys[3] => $this->getCp(),
            $keys[4] => $this->getVille(),
            $keys[5] => $this->getAdrmel(),
            $keys[6] => $this->getTelephone(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getCodepays(),
            $keys[9] => $this->getIdentifiant(),
            $keys[10] => $this->getPassword(),
            $keys[11] => $this->getProfil(),
            $keys[12] => $this->getNombredetentativesdeconnexion(),
            $keys[13] => $this->getDernieretentativedeconnexionnonvalide(),
        ];
        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pays';
                        break;
                    default:
                        $key = 'Pays';
                }

                $result[$key] = $this->aPays->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collReservations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservations';
                        break;
                    default:
                        $key = 'Reservations';
                }

                $result[$key] = $this->collReservations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UtilisateurTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCodeutilisateur($value);
                break;
            case 1:
                $this->setRaisonsociale($value);
                break;
            case 2:
                $this->setAdresse($value);
                break;
            case 3:
                $this->setCp($value);
                break;
            case 4:
                $this->setVille($value);
                break;
            case 5:
                $this->setAdrmel($value);
                break;
            case 6:
                $this->setTelephone($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setCodepays($value);
                break;
            case 9:
                $this->setIdentifiant($value);
                break;
            case 10:
                $this->setPassword($value);
                break;
            case 11:
                $this->setProfil($value);
                break;
            case 12:
                $this->setNombredetentativesdeconnexion($value);
                break;
            case 13:
                $this->setDernieretentativedeconnexionnonvalide($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UtilisateurTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodeutilisateur($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setRaisonsociale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAdresse($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVille($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAdrmel($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTelephone($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setContact($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCodepays($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIdentifiant($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPassword($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setProfil($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setNombredetentativesdeconnexion($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDernieretentativedeconnexionnonvalide($arr[$keys[13]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(UtilisateurTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEUTILISATEUR)) {
            $criteria->add(UtilisateurTableMap::COL_CODEUTILISATEUR, $this->codeutilisateur);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_RAISONSOCIALE)) {
            $criteria->add(UtilisateurTableMap::COL_RAISONSOCIALE, $this->raisonsociale);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRESSE)) {
            $criteria->add(UtilisateurTableMap::COL_ADRESSE, $this->adresse);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CP)) {
            $criteria->add(UtilisateurTableMap::COL_CP, $this->cp);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_VILLE)) {
            $criteria->add(UtilisateurTableMap::COL_VILLE, $this->ville);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRMEL)) {
            $criteria->add(UtilisateurTableMap::COL_ADRMEL, $this->adrmel);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_TELEPHONE)) {
            $criteria->add(UtilisateurTableMap::COL_TELEPHONE, $this->telephone);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CONTACT)) {
            $criteria->add(UtilisateurTableMap::COL_CONTACT, $this->contact);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEPAYS)) {
            $criteria->add(UtilisateurTableMap::COL_CODEPAYS, $this->codepays);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_IDENTIFIANT)) {
            $criteria->add(UtilisateurTableMap::COL_IDENTIFIANT, $this->identifiant);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_PASSWORD)) {
            $criteria->add(UtilisateurTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_PROFIL)) {
            $criteria->add(UtilisateurTableMap::COL_PROFIL, $this->profil);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION)) {
            $criteria->add(UtilisateurTableMap::COL_NOMBREDETENTATIVESDECONNEXION, $this->nombredetentativesdeconnexion);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE)) {
            $criteria->add(UtilisateurTableMap::COL_DERNIERETENTATIVEDECONNEXIONNONVALIDE, $this->dernieretentativedeconnexionnonvalide);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildUtilisateurQuery::create();
        $criteria->add(UtilisateurTableMap::COL_CODEUTILISATEUR, $this->codeutilisateur);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getCodeutilisateur();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getCodeutilisateur();
    }

    /**
     * Generic method to set the primary key (codeutilisateur column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setCodeutilisateur($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCodeutilisateur();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Http\Model\Utilisateur (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setRaisonsociale($this->getRaisonsociale());
        $copyObj->setAdresse($this->getAdresse());
        $copyObj->setCp($this->getCp());
        $copyObj->setVille($this->getVille());
        $copyObj->setAdrmel($this->getAdrmel());
        $copyObj->setTelephone($this->getTelephone());
        $copyObj->setContact($this->getContact());
        $copyObj->setCodepays($this->getCodepays());
        $copyObj->setIdentifiant($this->getIdentifiant());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setProfil($this->getProfil());
        $copyObj->setNombredetentativesdeconnexion($this->getNombredetentativesdeconnexion());
        $copyObj->setDernieretentativedeconnexionnonvalide($this->getDernieretentativedeconnexionnonvalide());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReservation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCodeutilisateur(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \App\Http\Model\Utilisateur Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildPays object.
     *
     * @param ChildPays $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPays(ChildPays $v = null)
    {
        if ($v === null) {
            $this->setCodepays(NULL);
        } else {
            $this->setCodepays($v->getCodepays());
        }

        $this->aPays = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPays object, it will not be re-added.
        if ($v !== null) {
            $v->addUtilisateur($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPays object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPays The associated ChildPays object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPays(?ConnectionInterface $con = null)
    {
        if ($this->aPays === null && (($this->codepays !== "" && $this->codepays !== null))) {
            $this->aPays = ChildPaysQuery::create()->findPk($this->codepays, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPays->addUtilisateurs($this);
             */
        }

        return $this->aPays;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('Reservation' === $relationName) {
            $this->initReservations();
            return;
        }
    }

    /**
     * Clears out the collReservations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReservations()
     */
    public function clearReservations()
    {
        $this->collReservations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReservations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReservations($v = true): void
    {
        $this->collReservationsPartial = $v;
    }

    /**
     * Initializes the collReservations collection.
     *
     * By default this just sets the collReservations collection to an empty array (like clearcollReservations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservations(bool $overrideExisting = true): void
    {
        if (null !== $this->collReservations && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collReservations = new $collectionClassName;
        $this->collReservations->setModel('\App\Http\Model\Reservation');
    }

    /**
     * Gets an array of ChildReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUtilisateur is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation> List of ChildReservation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReservations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReservationsPartial && !$this->isNew();
        if (null === $this->collReservations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservations) {
                    $this->initReservations();
                } else {
                    $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

                    $collReservations = new $collectionClassName;
                    $collReservations->setModel('\App\Http\Model\Reservation');

                    return $collReservations;
                }
            } else {
                $collReservations = ChildReservationQuery::create(null, $criteria)
                    ->filterByUtilisateur($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReservationsPartial && count($collReservations)) {
                        $this->initReservations(false);

                        foreach ($collReservations as $obj) {
                            if (false == $this->collReservations->contains($obj)) {
                                $this->collReservations->append($obj);
                            }
                        }

                        $this->collReservationsPartial = true;
                    }

                    return $collReservations;
                }

                if ($partial && $this->collReservations) {
                    foreach ($this->collReservations as $obj) {
                        if ($obj->isNew()) {
                            $collReservations[] = $obj;
                        }
                    }
                }

                $this->collReservations = $collReservations;
                $this->collReservationsPartial = false;
            }
        }

        return $this->collReservations;
    }

    /**
     * Sets a collection of ChildReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reservations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReservations(Collection $reservations, ?ConnectionInterface $con = null)
    {
        /** @var ChildReservation[] $reservationsToDelete */
        $reservationsToDelete = $this->getReservations(new Criteria(), $con)->diff($reservations);


        $this->reservationsScheduledForDeletion = $reservationsToDelete;

        foreach ($reservationsToDelete as $reservationRemoved) {
            $reservationRemoved->setUtilisateur(null);
        }

        $this->collReservations = null;
        foreach ($reservations as $reservation) {
            $this->addReservation($reservation);
        }

        $this->collReservations = $reservations;
        $this->collReservationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reservation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Reservation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReservations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReservationsPartial && !$this->isNew();
        if (null === $this->collReservations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservations());
            }

            $query = ChildReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUtilisateur($this)
                ->count($con);
        }

        return count($this->collReservations);
    }

    /**
     * Method called to associate a ChildReservation object to this object
     * through the ChildReservation foreign key attribute.
     *
     * @param ChildReservation $l ChildReservation
     * @return $this The current object (for fluent API support)
     */
    public function addReservation(ChildReservation $l)
    {
        if ($this->collReservations === null) {
            $this->initReservations();
            $this->collReservationsPartial = true;
        }

        if (!$this->collReservations->contains($l)) {
            $this->doAddReservation($l);

            if ($this->reservationsScheduledForDeletion and $this->reservationsScheduledForDeletion->contains($l)) {
                $this->reservationsScheduledForDeletion->remove($this->reservationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReservation $reservation The ChildReservation object to add.
     */
    protected function doAddReservation(ChildReservation $reservation): void
    {
        $this->collReservations[]= $reservation;
        $reservation->setUtilisateur($this);
    }

    /**
     * @param ChildReservation $reservation The ChildReservation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReservation(ChildReservation $reservation)
    {
        if ($this->getReservations()->contains($reservation)) {
            $pos = $this->collReservations->search($reservation);
            $this->collReservations->remove($pos);
            if (null === $this->reservationsScheduledForDeletion) {
                $this->reservationsScheduledForDeletion = clone $this->collReservations;
                $this->reservationsScheduledForDeletion->clear();
            }
            $this->reservationsScheduledForDeletion[]= clone $reservation;
            $reservation->setUtilisateur(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinVilleRelatedByCodevillemisedispo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('VilleRelatedByCodevillemisedispo', $joinBehavior);

        return $this->getReservations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinVilleRelatedByCodevillerendre(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('VilleRelatedByCodevillerendre', $joinBehavior);

        return $this->getReservations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinDevis(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Devis', $joinBehavior);

        return $this->getReservations($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aPays) {
            $this->aPays->removeUtilisateur($this);
        }
        $this->codeutilisateur = null;
        $this->raisonsociale = null;
        $this->adresse = null;
        $this->cp = null;
        $this->ville = null;
        $this->adrmel = null;
        $this->telephone = null;
        $this->contact = null;
        $this->codepays = null;
        $this->identifiant = null;
        $this->password = null;
        $this->profil = null;
        $this->nombredetentativesdeconnexion = null;
        $this->dernieretentativedeconnexionnonvalide = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collReservations) {
                foreach ($this->collReservations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservations = null;
        $this->aPays = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UtilisateurTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
