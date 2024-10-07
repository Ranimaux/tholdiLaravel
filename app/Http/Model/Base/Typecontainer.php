<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Reserver as ChildReserver;
use App\Http\Model\ReserverQuery as ChildReserverQuery;
use App\Http\Model\Tarificationcontainer as ChildTarificationcontainer;
use App\Http\Model\TarificationcontainerQuery as ChildTarificationcontainerQuery;
use App\Http\Model\Typecontainer as ChildTypecontainer;
use App\Http\Model\TypecontainerQuery as ChildTypecontainerQuery;
use App\Http\Model\Map\ReserverTableMap;
use App\Http\Model\Map\TarificationcontainerTableMap;
use App\Http\Model\Map\TypecontainerTableMap;
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

/**
 * Base class that represents a row from the 'typeContainer' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Typecontainer implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Http\\Model\\Map\\TypecontainerTableMap';


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
     * The value for the numtypecontainer field.
     *
     * @var        int
     */
    protected $numtypecontainer;

    /**
     * The value for the codetypecontainer field.
     *
     * @var        string
     */
    protected $codetypecontainer;

    /**
     * The value for the libelletypecontainer field.
     *
     * @var        string
     */
    protected $libelletypecontainer;

    /**
     * The value for the longueurenmillimetre field.
     *
     * @var        string
     */
    protected $longueurenmillimetre;

    /**
     * The value for the largeurenmillimetre field.
     *
     * @var        string
     */
    protected $largeurenmillimetre;

    /**
     * The value for the hauteurenmillimetre field.
     *
     * @var        string
     */
    protected $hauteurenmillimetre;

    /**
     * The value for the masseentonne field.
     *
     * @var        string|null
     */
    protected $masseentonne;

    /**
     * The value for the volumeenmetrecube field.
     *
     * @var        string|null
     */
    protected $volumeenmetrecube;

    /**
     * The value for the capacitedechargeentonne field.
     *
     * @var        string|null
     */
    protected $capacitedechargeentonne;

    /**
     * @var        ObjectCollection|ChildReserver[] Collection to store aggregation of ChildReserver objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReserver> Collection to store aggregation of ChildReserver objects.
     */
    protected $collReservers;
    protected $collReserversPartial;

    /**
     * @var        ObjectCollection|ChildTarificationcontainer[] Collection to store aggregation of ChildTarificationcontainer objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTarificationcontainer> Collection to store aggregation of ChildTarificationcontainer objects.
     */
    protected $collTarificationcontainers;
    protected $collTarificationcontainersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReserver[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReserver>
     */
    protected $reserversScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTarificationcontainer[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTarificationcontainer>
     */
    protected $tarificationcontainersScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Http\Model\Base\Typecontainer object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>Typecontainer</code> instance.  If
     * <code>obj</code> is an instance of <code>Typecontainer</code>, delegates to
     * <code>equals(Typecontainer)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [numtypecontainer] column value.
     *
     * @return int
     */
    public function getNumtypecontainer()
    {
        return $this->numtypecontainer;
    }

    /**
     * Get the [codetypecontainer] column value.
     *
     * @return string
     */
    public function getCodetypecontainer()
    {
        return $this->codetypecontainer;
    }

    /**
     * Get the [libelletypecontainer] column value.
     *
     * @return string
     */
    public function getLibelletypecontainer()
    {
        return $this->libelletypecontainer;
    }

    /**
     * Get the [longueurenmillimetre] column value.
     *
     * @return string
     */
    public function getLongueurenmillimetre()
    {
        return $this->longueurenmillimetre;
    }

    /**
     * Get the [largeurenmillimetre] column value.
     *
     * @return string
     */
    public function getLargeurenmillimetre()
    {
        return $this->largeurenmillimetre;
    }

    /**
     * Get the [hauteurenmillimetre] column value.
     *
     * @return string
     */
    public function getHauteurenmillimetre()
    {
        return $this->hauteurenmillimetre;
    }

    /**
     * Get the [masseentonne] column value.
     *
     * @return string|null
     */
    public function getMasseentonne()
    {
        return $this->masseentonne;
    }

    /**
     * Get the [volumeenmetrecube] column value.
     *
     * @return string|null
     */
    public function getVolumeenmetrecube()
    {
        return $this->volumeenmetrecube;
    }

    /**
     * Get the [capacitedechargeentonne] column value.
     *
     * @return string|null
     */
    public function getCapacitedechargeentonne()
    {
        return $this->capacitedechargeentonne;
    }

    /**
     * Set the value of [numtypecontainer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNumtypecontainer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->numtypecontainer !== $v) {
            $this->numtypecontainer = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_NUMTYPECONTAINER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [codetypecontainer] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodetypecontainer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codetypecontainer !== $v) {
            $this->codetypecontainer = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_CODETYPECONTAINER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [libelletypecontainer] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLibelletypecontainer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->libelletypecontainer !== $v) {
            $this->libelletypecontainer = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_LIBELLETYPECONTAINER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [longueurenmillimetre] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLongueurenmillimetre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->longueurenmillimetre !== $v) {
            $this->longueurenmillimetre = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_LONGUEURENMILLIMETRE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [largeurenmillimetre] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLargeurenmillimetre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->largeurenmillimetre !== $v) {
            $this->largeurenmillimetre = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_LARGEURENMILLIMETRE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [hauteurenmillimetre] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHauteurenmillimetre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hauteurenmillimetre !== $v) {
            $this->hauteurenmillimetre = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_HAUTEURENMILLIMETRE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [masseentonne] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMasseentonne($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->masseentonne !== $v) {
            $this->masseentonne = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_MASSEENTONNE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [volumeenmetrecube] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVolumeenmetrecube($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->volumeenmetrecube !== $v) {
            $this->volumeenmetrecube = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_VOLUMEENMETRECUBE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [capacitedechargeentonne] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCapacitedechargeentonne($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->capacitedechargeentonne !== $v) {
            $this->capacitedechargeentonne = $v;
            $this->modifiedColumns[TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE] = true;
        }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TypecontainerTableMap::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numtypecontainer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TypecontainerTableMap::translateFieldName('Codetypecontainer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codetypecontainer = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TypecontainerTableMap::translateFieldName('Libelletypecontainer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->libelletypecontainer = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TypecontainerTableMap::translateFieldName('Longueurenmillimetre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->longueurenmillimetre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TypecontainerTableMap::translateFieldName('Largeurenmillimetre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->largeurenmillimetre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TypecontainerTableMap::translateFieldName('Hauteurenmillimetre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hauteurenmillimetre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TypecontainerTableMap::translateFieldName('Masseentonne', TableMap::TYPE_PHPNAME, $indexType)];
            $this->masseentonne = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TypecontainerTableMap::translateFieldName('Volumeenmetrecube', TableMap::TYPE_PHPNAME, $indexType)];
            $this->volumeenmetrecube = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TypecontainerTableMap::translateFieldName('Capacitedechargeentonne', TableMap::TYPE_PHPNAME, $indexType)];
            $this->capacitedechargeentonne = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = TypecontainerTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Typecontainer'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTypecontainerQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collReservers = null;

            $this->collTarificationcontainers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Typecontainer::setDeleted()
     * @see Typecontainer::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTypecontainerQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
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
                TypecontainerTableMap::addInstanceToPool($this);
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

            if ($this->reserversScheduledForDeletion !== null) {
                if (!$this->reserversScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReserverQuery::create()
                        ->filterByPrimaryKeys($this->reserversScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reserversScheduledForDeletion = null;
                }
            }

            if ($this->collReservers !== null) {
                foreach ($this->collReservers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tarificationcontainersScheduledForDeletion !== null) {
                if (!$this->tarificationcontainersScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\TarificationcontainerQuery::create()
                        ->filterByPrimaryKeys($this->tarificationcontainersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tarificationcontainersScheduledForDeletion = null;
                }
            }

            if ($this->collTarificationcontainers !== null) {
                foreach ($this->collTarificationcontainers as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TypecontainerTableMap::COL_NUMTYPECONTAINER)) {
            $modifiedColumns[':p' . $index++]  = 'numTypeContainer';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_CODETYPECONTAINER)) {
            $modifiedColumns[':p' . $index++]  = 'codeTypeContainer';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LIBELLETYPECONTAINER)) {
            $modifiedColumns[':p' . $index++]  = 'libelleTypeContainer';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE)) {
            $modifiedColumns[':p' . $index++]  = 'longueurEnMillimetre';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LARGEURENMILLIMETRE)) {
            $modifiedColumns[':p' . $index++]  = 'largeurEnMillimetre';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE)) {
            $modifiedColumns[':p' . $index++]  = 'hauteurEnMillimetre';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_MASSEENTONNE)) {
            $modifiedColumns[':p' . $index++]  = 'masseEnTonne';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_VOLUMEENMETRECUBE)) {
            $modifiedColumns[':p' . $index++]  = 'volumeEnMetreCube';
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE)) {
            $modifiedColumns[':p' . $index++]  = 'capaciteDeChargeEnTonne';
        }

        $sql = sprintf(
            'INSERT INTO typeContainer (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'numTypeContainer':
                        $stmt->bindValue($identifier, $this->numtypecontainer, PDO::PARAM_INT);

                        break;
                    case 'codeTypeContainer':
                        $stmt->bindValue($identifier, $this->codetypecontainer, PDO::PARAM_STR);

                        break;
                    case 'libelleTypeContainer':
                        $stmt->bindValue($identifier, $this->libelletypecontainer, PDO::PARAM_STR);

                        break;
                    case 'longueurEnMillimetre':
                        $stmt->bindValue($identifier, $this->longueurenmillimetre, PDO::PARAM_STR);

                        break;
                    case 'largeurEnMillimetre':
                        $stmt->bindValue($identifier, $this->largeurenmillimetre, PDO::PARAM_STR);

                        break;
                    case 'hauteurEnMillimetre':
                        $stmt->bindValue($identifier, $this->hauteurenmillimetre, PDO::PARAM_STR);

                        break;
                    case 'masseEnTonne':
                        $stmt->bindValue($identifier, $this->masseentonne, PDO::PARAM_STR);

                        break;
                    case 'volumeEnMetreCube':
                        $stmt->bindValue($identifier, $this->volumeenmetrecube, PDO::PARAM_STR);

                        break;
                    case 'capaciteDeChargeEnTonne':
                        $stmt->bindValue($identifier, $this->capacitedechargeentonne, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = TypecontainerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNumtypecontainer();

            case 1:
                return $this->getCodetypecontainer();

            case 2:
                return $this->getLibelletypecontainer();

            case 3:
                return $this->getLongueurenmillimetre();

            case 4:
                return $this->getLargeurenmillimetre();

            case 5:
                return $this->getHauteurenmillimetre();

            case 6:
                return $this->getMasseentonne();

            case 7:
                return $this->getVolumeenmetrecube();

            case 8:
                return $this->getCapacitedechargeentonne();

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
        if (isset($alreadyDumpedObjects['Typecontainer'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Typecontainer'][$this->hashCode()] = true;
        $keys = TypecontainerTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getNumtypecontainer(),
            $keys[1] => $this->getCodetypecontainer(),
            $keys[2] => $this->getLibelletypecontainer(),
            $keys[3] => $this->getLongueurenmillimetre(),
            $keys[4] => $this->getLargeurenmillimetre(),
            $keys[5] => $this->getHauteurenmillimetre(),
            $keys[6] => $this->getMasseentonne(),
            $keys[7] => $this->getVolumeenmetrecube(),
            $keys[8] => $this->getCapacitedechargeentonne(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collReservers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservers';
                        break;
                    default:
                        $key = 'Reservers';
                }

                $result[$key] = $this->collReservers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTarificationcontainers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tarificationcontainers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tarificationContainers';
                        break;
                    default:
                        $key = 'Tarificationcontainers';
                }

                $result[$key] = $this->collTarificationcontainers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TypecontainerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setNumtypecontainer($value);
                break;
            case 1:
                $this->setCodetypecontainer($value);
                break;
            case 2:
                $this->setLibelletypecontainer($value);
                break;
            case 3:
                $this->setLongueurenmillimetre($value);
                break;
            case 4:
                $this->setLargeurenmillimetre($value);
                break;
            case 5:
                $this->setHauteurenmillimetre($value);
                break;
            case 6:
                $this->setMasseentonne($value);
                break;
            case 7:
                $this->setVolumeenmetrecube($value);
                break;
            case 8:
                $this->setCapacitedechargeentonne($value);
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
        $keys = TypecontainerTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setNumtypecontainer($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCodetypecontainer($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLibelletypecontainer($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLongueurenmillimetre($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLargeurenmillimetre($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setHauteurenmillimetre($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMasseentonne($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVolumeenmetrecube($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCapacitedechargeentonne($arr[$keys[8]]);
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
        $criteria = new Criteria(TypecontainerTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TypecontainerTableMap::COL_NUMTYPECONTAINER)) {
            $criteria->add(TypecontainerTableMap::COL_NUMTYPECONTAINER, $this->numtypecontainer);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_CODETYPECONTAINER)) {
            $criteria->add(TypecontainerTableMap::COL_CODETYPECONTAINER, $this->codetypecontainer);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LIBELLETYPECONTAINER)) {
            $criteria->add(TypecontainerTableMap::COL_LIBELLETYPECONTAINER, $this->libelletypecontainer);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE)) {
            $criteria->add(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE, $this->longueurenmillimetre);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_LARGEURENMILLIMETRE)) {
            $criteria->add(TypecontainerTableMap::COL_LARGEURENMILLIMETRE, $this->largeurenmillimetre);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE)) {
            $criteria->add(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE, $this->hauteurenmillimetre);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_MASSEENTONNE)) {
            $criteria->add(TypecontainerTableMap::COL_MASSEENTONNE, $this->masseentonne);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_VOLUMEENMETRECUBE)) {
            $criteria->add(TypecontainerTableMap::COL_VOLUMEENMETRECUBE, $this->volumeenmetrecube);
        }
        if ($this->isColumnModified(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE)) {
            $criteria->add(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE, $this->capacitedechargeentonne);
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
        $criteria = ChildTypecontainerQuery::create();
        $criteria->add(TypecontainerTableMap::COL_NUMTYPECONTAINER, $this->numtypecontainer);

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
        $validPk = null !== $this->getNumtypecontainer();

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
        return $this->getNumtypecontainer();
    }

    /**
     * Generic method to set the primary key (numtypecontainer column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setNumtypecontainer($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getNumtypecontainer();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Http\Model\Typecontainer (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setNumtypecontainer($this->getNumtypecontainer());
        $copyObj->setCodetypecontainer($this->getCodetypecontainer());
        $copyObj->setLibelletypecontainer($this->getLibelletypecontainer());
        $copyObj->setLongueurenmillimetre($this->getLongueurenmillimetre());
        $copyObj->setLargeurenmillimetre($this->getLargeurenmillimetre());
        $copyObj->setHauteurenmillimetre($this->getHauteurenmillimetre());
        $copyObj->setMasseentonne($this->getMasseentonne());
        $copyObj->setVolumeenmetrecube($this->getVolumeenmetrecube());
        $copyObj->setCapacitedechargeentonne($this->getCapacitedechargeentonne());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReserver($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTarificationcontainers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTarificationcontainer($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \App\Http\Model\Typecontainer Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('Reserver' === $relationName) {
            $this->initReservers();
            return;
        }
        if ('Tarificationcontainer' === $relationName) {
            $this->initTarificationcontainers();
            return;
        }
    }

    /**
     * Clears out the collReservers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReservers()
     */
    public function clearReservers()
    {
        $this->collReservers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReservers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReservers($v = true): void
    {
        $this->collReserversPartial = $v;
    }

    /**
     * Initializes the collReservers collection.
     *
     * By default this just sets the collReservers collection to an empty array (like clearcollReservers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservers(bool $overrideExisting = true): void
    {
        if (null !== $this->collReservers && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReserverTableMap::getTableMap()->getCollectionClassName();

        $this->collReservers = new $collectionClassName;
        $this->collReservers->setModel('\App\Http\Model\Reserver');
    }

    /**
     * Gets an array of ChildReserver objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTypecontainer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReserver[] List of ChildReserver objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReserver> List of ChildReserver objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReservers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReserversPartial && !$this->isNew();
        if (null === $this->collReservers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservers) {
                    $this->initReservers();
                } else {
                    $collectionClassName = ReserverTableMap::getTableMap()->getCollectionClassName();

                    $collReservers = new $collectionClassName;
                    $collReservers->setModel('\App\Http\Model\Reserver');

                    return $collReservers;
                }
            } else {
                $collReservers = ChildReserverQuery::create(null, $criteria)
                    ->filterByTypecontainer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReserversPartial && count($collReservers)) {
                        $this->initReservers(false);

                        foreach ($collReservers as $obj) {
                            if (false == $this->collReservers->contains($obj)) {
                                $this->collReservers->append($obj);
                            }
                        }

                        $this->collReserversPartial = true;
                    }

                    return $collReservers;
                }

                if ($partial && $this->collReservers) {
                    foreach ($this->collReservers as $obj) {
                        if ($obj->isNew()) {
                            $collReservers[] = $obj;
                        }
                    }
                }

                $this->collReservers = $collReservers;
                $this->collReserversPartial = false;
            }
        }

        return $this->collReservers;
    }

    /**
     * Sets a collection of ChildReserver objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reservers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReservers(Collection $reservers, ?ConnectionInterface $con = null)
    {
        /** @var ChildReserver[] $reserversToDelete */
        $reserversToDelete = $this->getReservers(new Criteria(), $con)->diff($reservers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->reserversScheduledForDeletion = clone $reserversToDelete;

        foreach ($reserversToDelete as $reserverRemoved) {
            $reserverRemoved->setTypecontainer(null);
        }

        $this->collReservers = null;
        foreach ($reservers as $reserver) {
            $this->addReserver($reserver);
        }

        $this->collReservers = $reservers;
        $this->collReserversPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reserver objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Reserver objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReservers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReserversPartial && !$this->isNew();
        if (null === $this->collReservers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservers());
            }

            $query = ChildReserverQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTypecontainer($this)
                ->count($con);
        }

        return count($this->collReservers);
    }

    /**
     * Method called to associate a ChildReserver object to this object
     * through the ChildReserver foreign key attribute.
     *
     * @param ChildReserver $l ChildReserver
     * @return $this The current object (for fluent API support)
     */
    public function addReserver(ChildReserver $l)
    {
        if ($this->collReservers === null) {
            $this->initReservers();
            $this->collReserversPartial = true;
        }

        if (!$this->collReservers->contains($l)) {
            $this->doAddReserver($l);

            if ($this->reserversScheduledForDeletion and $this->reserversScheduledForDeletion->contains($l)) {
                $this->reserversScheduledForDeletion->remove($this->reserversScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReserver $reserver The ChildReserver object to add.
     */
    protected function doAddReserver(ChildReserver $reserver): void
    {
        $this->collReservers[]= $reserver;
        $reserver->setTypecontainer($this);
    }

    /**
     * @param ChildReserver $reserver The ChildReserver object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReserver(ChildReserver $reserver)
    {
        if ($this->getReservers()->contains($reserver)) {
            $pos = $this->collReservers->search($reserver);
            $this->collReservers->remove($pos);
            if (null === $this->reserversScheduledForDeletion) {
                $this->reserversScheduledForDeletion = clone $this->collReservers;
                $this->reserversScheduledForDeletion->clear();
            }
            $this->reserversScheduledForDeletion[]= clone $reserver;
            $reserver->setTypecontainer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Typecontainer is new, it will return
     * an empty collection; or if this Typecontainer has previously
     * been saved, it will retrieve related Reservers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Typecontainer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReserver[] List of ChildReserver objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReserver}> List of ChildReserver objects
     */
    public function getReserversJoinReservation(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReserverQuery::create(null, $criteria);
        $query->joinWith('Reservation', $joinBehavior);

        return $this->getReservers($query, $con);
    }

    /**
     * Clears out the collTarificationcontainers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTarificationcontainers()
     */
    public function clearTarificationcontainers()
    {
        $this->collTarificationcontainers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTarificationcontainers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTarificationcontainers($v = true): void
    {
        $this->collTarificationcontainersPartial = $v;
    }

    /**
     * Initializes the collTarificationcontainers collection.
     *
     * By default this just sets the collTarificationcontainers collection to an empty array (like clearcollTarificationcontainers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTarificationcontainers(bool $overrideExisting = true): void
    {
        if (null !== $this->collTarificationcontainers && !$overrideExisting) {
            return;
        }

        $collectionClassName = TarificationcontainerTableMap::getTableMap()->getCollectionClassName();

        $this->collTarificationcontainers = new $collectionClassName;
        $this->collTarificationcontainers->setModel('\App\Http\Model\Tarificationcontainer');
    }

    /**
     * Gets an array of ChildTarificationcontainer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTypecontainer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTarificationcontainer[] List of ChildTarificationcontainer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTarificationcontainer> List of ChildTarificationcontainer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTarificationcontainers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTarificationcontainersPartial && !$this->isNew();
        if (null === $this->collTarificationcontainers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTarificationcontainers) {
                    $this->initTarificationcontainers();
                } else {
                    $collectionClassName = TarificationcontainerTableMap::getTableMap()->getCollectionClassName();

                    $collTarificationcontainers = new $collectionClassName;
                    $collTarificationcontainers->setModel('\App\Http\Model\Tarificationcontainer');

                    return $collTarificationcontainers;
                }
            } else {
                $collTarificationcontainers = ChildTarificationcontainerQuery::create(null, $criteria)
                    ->filterByTypecontainer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTarificationcontainersPartial && count($collTarificationcontainers)) {
                        $this->initTarificationcontainers(false);

                        foreach ($collTarificationcontainers as $obj) {
                            if (false == $this->collTarificationcontainers->contains($obj)) {
                                $this->collTarificationcontainers->append($obj);
                            }
                        }

                        $this->collTarificationcontainersPartial = true;
                    }

                    return $collTarificationcontainers;
                }

                if ($partial && $this->collTarificationcontainers) {
                    foreach ($this->collTarificationcontainers as $obj) {
                        if ($obj->isNew()) {
                            $collTarificationcontainers[] = $obj;
                        }
                    }
                }

                $this->collTarificationcontainers = $collTarificationcontainers;
                $this->collTarificationcontainersPartial = false;
            }
        }

        return $this->collTarificationcontainers;
    }

    /**
     * Sets a collection of ChildTarificationcontainer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $tarificationcontainers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTarificationcontainers(Collection $tarificationcontainers, ?ConnectionInterface $con = null)
    {
        /** @var ChildTarificationcontainer[] $tarificationcontainersToDelete */
        $tarificationcontainersToDelete = $this->getTarificationcontainers(new Criteria(), $con)->diff($tarificationcontainers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->tarificationcontainersScheduledForDeletion = clone $tarificationcontainersToDelete;

        foreach ($tarificationcontainersToDelete as $tarificationcontainerRemoved) {
            $tarificationcontainerRemoved->setTypecontainer(null);
        }

        $this->collTarificationcontainers = null;
        foreach ($tarificationcontainers as $tarificationcontainer) {
            $this->addTarificationcontainer($tarificationcontainer);
        }

        $this->collTarificationcontainers = $tarificationcontainers;
        $this->collTarificationcontainersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tarificationcontainer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tarificationcontainer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTarificationcontainers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTarificationcontainersPartial && !$this->isNew();
        if (null === $this->collTarificationcontainers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTarificationcontainers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTarificationcontainers());
            }

            $query = ChildTarificationcontainerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTypecontainer($this)
                ->count($con);
        }

        return count($this->collTarificationcontainers);
    }

    /**
     * Method called to associate a ChildTarificationcontainer object to this object
     * through the ChildTarificationcontainer foreign key attribute.
     *
     * @param ChildTarificationcontainer $l ChildTarificationcontainer
     * @return $this The current object (for fluent API support)
     */
    public function addTarificationcontainer(ChildTarificationcontainer $l)
    {
        if ($this->collTarificationcontainers === null) {
            $this->initTarificationcontainers();
            $this->collTarificationcontainersPartial = true;
        }

        if (!$this->collTarificationcontainers->contains($l)) {
            $this->doAddTarificationcontainer($l);

            if ($this->tarificationcontainersScheduledForDeletion and $this->tarificationcontainersScheduledForDeletion->contains($l)) {
                $this->tarificationcontainersScheduledForDeletion->remove($this->tarificationcontainersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTarificationcontainer $tarificationcontainer The ChildTarificationcontainer object to add.
     */
    protected function doAddTarificationcontainer(ChildTarificationcontainer $tarificationcontainer): void
    {
        $this->collTarificationcontainers[]= $tarificationcontainer;
        $tarificationcontainer->setTypecontainer($this);
    }

    /**
     * @param ChildTarificationcontainer $tarificationcontainer The ChildTarificationcontainer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTarificationcontainer(ChildTarificationcontainer $tarificationcontainer)
    {
        if ($this->getTarificationcontainers()->contains($tarificationcontainer)) {
            $pos = $this->collTarificationcontainers->search($tarificationcontainer);
            $this->collTarificationcontainers->remove($pos);
            if (null === $this->tarificationcontainersScheduledForDeletion) {
                $this->tarificationcontainersScheduledForDeletion = clone $this->collTarificationcontainers;
                $this->tarificationcontainersScheduledForDeletion->clear();
            }
            $this->tarificationcontainersScheduledForDeletion[]= clone $tarificationcontainer;
            $tarificationcontainer->setTypecontainer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Typecontainer is new, it will return
     * an empty collection; or if this Typecontainer has previously
     * been saved, it will retrieve related Tarificationcontainers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Typecontainer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTarificationcontainer[] List of ChildTarificationcontainer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTarificationcontainer}> List of ChildTarificationcontainer objects
     */
    public function getTarificationcontainersJoinDuree(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTarificationcontainerQuery::create(null, $criteria);
        $query->joinWith('Duree', $joinBehavior);

        return $this->getTarificationcontainers($query, $con);
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
        $this->numtypecontainer = null;
        $this->codetypecontainer = null;
        $this->libelletypecontainer = null;
        $this->longueurenmillimetre = null;
        $this->largeurenmillimetre = null;
        $this->hauteurenmillimetre = null;
        $this->masseentonne = null;
        $this->volumeenmetrecube = null;
        $this->capacitedechargeentonne = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collReservers) {
                foreach ($this->collReservers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTarificationcontainers) {
                foreach ($this->collTarificationcontainers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservers = null;
        $this->collTarificationcontainers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TypecontainerTableMap::DEFAULT_STRING_FORMAT);
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
