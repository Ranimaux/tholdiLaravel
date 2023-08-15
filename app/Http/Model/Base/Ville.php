<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Pays as ChildPays;
use App\Http\Model\PaysQuery as ChildPaysQuery;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Ville as ChildVille;
use App\Http\Model\VilleQuery as ChildVilleQuery;
use App\Http\Model\Map\ReservationTableMap;
use App\Http\Model\Map\VilleTableMap;
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
 * Base class that represents a row from the 'ville' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Ville implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Http\\Model\\Map\\VilleTableMap';


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
     * The value for the codeville field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $codeville;

    /**
     * The value for the nomville field.
     *
     * @var        string
     */
    protected $nomville;

    /**
     * The value for the codepays field.
     *
     * @var        string
     */
    protected $codepays;

    /**
     * @var        ChildPays
     */
    protected $aPays;

    /**
     * @var        ObjectCollection|ChildReservation[] Collection to store aggregation of ChildReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation> Collection to store aggregation of ChildReservation objects.
     */
    protected $collReservationsRelatedByCodevillemisedispo;
    protected $collReservationsRelatedByCodevillemisedispoPartial;

    /**
     * @var        ObjectCollection|ChildReservation[] Collection to store aggregation of ChildReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation> Collection to store aggregation of ChildReservation objects.
     */
    protected $collReservationsRelatedByCodevillerendre;
    protected $collReservationsRelatedByCodevillerendrePartial;

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
    protected $reservationsRelatedByCodevillemisedispoScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReservation[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation>
     */
    protected $reservationsRelatedByCodevillerendreScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->codeville = '';
    }

    /**
     * Initializes internal state of App\Http\Model\Base\Ville object.
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
     * Compares this with another <code>Ville</code> instance.  If
     * <code>obj</code> is an instance of <code>Ville</code>, delegates to
     * <code>equals(Ville)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [codeville] column value.
     *
     * @return string
     */
    public function getCodeville()
    {
        return $this->codeville;
    }

    /**
     * Get the [nomville] column value.
     *
     * @return string
     */
    public function getNomville()
    {
        return $this->nomville;
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
     * Set the value of [codeville] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodeville($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codeville !== $v) {
            $this->codeville = $v;
            $this->modifiedColumns[VilleTableMap::COL_CODEVILLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nomville] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNomville($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nomville !== $v) {
            $this->nomville = $v;
            $this->modifiedColumns[VilleTableMap::COL_NOMVILLE] = true;
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
            $this->modifiedColumns[VilleTableMap::COL_CODEPAYS] = true;
        }

        if ($this->aPays !== null && $this->aPays->getCodepays() !== $v) {
            $this->aPays = null;
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
            if ($this->codeville !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VilleTableMap::translateFieldName('Codeville', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codeville = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VilleTableMap::translateFieldName('Nomville', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nomville = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VilleTableMap::translateFieldName('Codepays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codepays = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = VilleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Ville'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(VilleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVilleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPays = null;
            $this->collReservationsRelatedByCodevillemisedispo = null;

            $this->collReservationsRelatedByCodevillerendre = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Ville::setDeleted()
     * @see Ville::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VilleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVilleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VilleTableMap::DATABASE_NAME);
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
                VilleTableMap::addInstanceToPool($this);
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

            if ($this->reservationsRelatedByCodevillemisedispoScheduledForDeletion !== null) {
                if (!$this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReservationQuery::create()
                        ->filterByPrimaryKeys($this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion = null;
                }
            }

            if ($this->collReservationsRelatedByCodevillemisedispo !== null) {
                foreach ($this->collReservationsRelatedByCodevillemisedispo as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->reservationsRelatedByCodevillerendreScheduledForDeletion !== null) {
                if (!$this->reservationsRelatedByCodevillerendreScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReservationQuery::create()
                        ->filterByPrimaryKeys($this->reservationsRelatedByCodevillerendreScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reservationsRelatedByCodevillerendreScheduledForDeletion = null;
                }
            }

            if ($this->collReservationsRelatedByCodevillerendre !== null) {
                foreach ($this->collReservationsRelatedByCodevillerendre as $referrerFK) {
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
        if ($this->isColumnModified(VilleTableMap::COL_CODEVILLE)) {
            $modifiedColumns[':p' . $index++]  = 'codeVille';
        }
        if ($this->isColumnModified(VilleTableMap::COL_NOMVILLE)) {
            $modifiedColumns[':p' . $index++]  = 'nomVille';
        }
        if ($this->isColumnModified(VilleTableMap::COL_CODEPAYS)) {
            $modifiedColumns[':p' . $index++]  = 'codePays';
        }

        $sql = sprintf(
            'INSERT INTO ville (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codeVille':
                        $stmt->bindValue($identifier, $this->codeville, PDO::PARAM_STR);

                        break;
                    case 'nomVille':
                        $stmt->bindValue($identifier, $this->nomville, PDO::PARAM_STR);

                        break;
                    case 'codePays':
                        $stmt->bindValue($identifier, $this->codepays, PDO::PARAM_STR);

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
        $pos = VilleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCodeville();

            case 1:
                return $this->getNomville();

            case 2:
                return $this->getCodepays();

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
        if (isset($alreadyDumpedObjects['Ville'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Ville'][$this->hashCode()] = true;
        $keys = VilleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCodeville(),
            $keys[1] => $this->getNomville(),
            $keys[2] => $this->getCodepays(),
        ];
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
            if (null !== $this->collReservationsRelatedByCodevillemisedispo) {

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

                $result[$key] = $this->collReservationsRelatedByCodevillemisedispo->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collReservationsRelatedByCodevillerendre) {

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

                $result[$key] = $this->collReservationsRelatedByCodevillerendre->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = VilleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCodeville($value);
                break;
            case 1:
                $this->setNomville($value);
                break;
            case 2:
                $this->setCodepays($value);
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
        $keys = VilleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodeville($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNomville($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCodepays($arr[$keys[2]]);
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
        $criteria = new Criteria(VilleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VilleTableMap::COL_CODEVILLE)) {
            $criteria->add(VilleTableMap::COL_CODEVILLE, $this->codeville);
        }
        if ($this->isColumnModified(VilleTableMap::COL_NOMVILLE)) {
            $criteria->add(VilleTableMap::COL_NOMVILLE, $this->nomville);
        }
        if ($this->isColumnModified(VilleTableMap::COL_CODEPAYS)) {
            $criteria->add(VilleTableMap::COL_CODEPAYS, $this->codepays);
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
        $criteria = ChildVilleQuery::create();
        $criteria->add(VilleTableMap::COL_CODEVILLE, $this->codeville);

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
        $validPk = null !== $this->getCodeville();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getCodeville();
    }

    /**
     * Generic method to set the primary key (codeville column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setCodeville($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCodeville();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Http\Model\Ville (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCodeville($this->getCodeville());
        $copyObj->setNomville($this->getNomville());
        $copyObj->setCodepays($this->getCodepays());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservationsRelatedByCodevillemisedispo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReservationRelatedByCodevillemisedispo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReservationsRelatedByCodevillerendre() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReservationRelatedByCodevillerendre($relObj->copy($deepCopy));
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
     * @return \App\Http\Model\Ville Clone of current object.
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
            $v->addVille($this);
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
                $this->aPays->addVilles($this);
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
        if ('ReservationRelatedByCodevillemisedispo' === $relationName) {
            $this->initReservationsRelatedByCodevillemisedispo();
            return;
        }
        if ('ReservationRelatedByCodevillerendre' === $relationName) {
            $this->initReservationsRelatedByCodevillerendre();
            return;
        }
    }

    /**
     * Clears out the collReservationsRelatedByCodevillemisedispo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReservationsRelatedByCodevillemisedispo()
     */
    public function clearReservationsRelatedByCodevillemisedispo()
    {
        $this->collReservationsRelatedByCodevillemisedispo = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReservationsRelatedByCodevillemisedispo collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReservationsRelatedByCodevillemisedispo($v = true): void
    {
        $this->collReservationsRelatedByCodevillemisedispoPartial = $v;
    }

    /**
     * Initializes the collReservationsRelatedByCodevillemisedispo collection.
     *
     * By default this just sets the collReservationsRelatedByCodevillemisedispo collection to an empty array (like clearcollReservationsRelatedByCodevillemisedispo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservationsRelatedByCodevillemisedispo(bool $overrideExisting = true): void
    {
        if (null !== $this->collReservationsRelatedByCodevillemisedispo && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collReservationsRelatedByCodevillemisedispo = new $collectionClassName;
        $this->collReservationsRelatedByCodevillemisedispo->setModel('\App\Http\Model\Reservation');
    }

    /**
     * Gets an array of ChildReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVille is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation> List of ChildReservation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReservationsRelatedByCodevillemisedispo(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReservationsRelatedByCodevillemisedispoPartial && !$this->isNew();
        if (null === $this->collReservationsRelatedByCodevillemisedispo || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservationsRelatedByCodevillemisedispo) {
                    $this->initReservationsRelatedByCodevillemisedispo();
                } else {
                    $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

                    $collReservationsRelatedByCodevillemisedispo = new $collectionClassName;
                    $collReservationsRelatedByCodevillemisedispo->setModel('\App\Http\Model\Reservation');

                    return $collReservationsRelatedByCodevillemisedispo;
                }
            } else {
                $collReservationsRelatedByCodevillemisedispo = ChildReservationQuery::create(null, $criteria)
                    ->filterByVilleRelatedByCodevillemisedispo($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReservationsRelatedByCodevillemisedispoPartial && count($collReservationsRelatedByCodevillemisedispo)) {
                        $this->initReservationsRelatedByCodevillemisedispo(false);

                        foreach ($collReservationsRelatedByCodevillemisedispo as $obj) {
                            if (false == $this->collReservationsRelatedByCodevillemisedispo->contains($obj)) {
                                $this->collReservationsRelatedByCodevillemisedispo->append($obj);
                            }
                        }

                        $this->collReservationsRelatedByCodevillemisedispoPartial = true;
                    }

                    return $collReservationsRelatedByCodevillemisedispo;
                }

                if ($partial && $this->collReservationsRelatedByCodevillemisedispo) {
                    foreach ($this->collReservationsRelatedByCodevillemisedispo as $obj) {
                        if ($obj->isNew()) {
                            $collReservationsRelatedByCodevillemisedispo[] = $obj;
                        }
                    }
                }

                $this->collReservationsRelatedByCodevillemisedispo = $collReservationsRelatedByCodevillemisedispo;
                $this->collReservationsRelatedByCodevillemisedispoPartial = false;
            }
        }

        return $this->collReservationsRelatedByCodevillemisedispo;
    }

    /**
     * Sets a collection of ChildReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reservationsRelatedByCodevillemisedispo A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReservationsRelatedByCodevillemisedispo(Collection $reservationsRelatedByCodevillemisedispo, ?ConnectionInterface $con = null)
    {
        /** @var ChildReservation[] $reservationsRelatedByCodevillemisedispoToDelete */
        $reservationsRelatedByCodevillemisedispoToDelete = $this->getReservationsRelatedByCodevillemisedispo(new Criteria(), $con)->diff($reservationsRelatedByCodevillemisedispo);


        $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion = $reservationsRelatedByCodevillemisedispoToDelete;

        foreach ($reservationsRelatedByCodevillemisedispoToDelete as $reservationRelatedByCodevillemisedispoRemoved) {
            $reservationRelatedByCodevillemisedispoRemoved->setVilleRelatedByCodevillemisedispo(null);
        }

        $this->collReservationsRelatedByCodevillemisedispo = null;
        foreach ($reservationsRelatedByCodevillemisedispo as $reservationRelatedByCodevillemisedispo) {
            $this->addReservationRelatedByCodevillemisedispo($reservationRelatedByCodevillemisedispo);
        }

        $this->collReservationsRelatedByCodevillemisedispo = $reservationsRelatedByCodevillemisedispo;
        $this->collReservationsRelatedByCodevillemisedispoPartial = false;

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
    public function countReservationsRelatedByCodevillemisedispo(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReservationsRelatedByCodevillemisedispoPartial && !$this->isNew();
        if (null === $this->collReservationsRelatedByCodevillemisedispo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservationsRelatedByCodevillemisedispo) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservationsRelatedByCodevillemisedispo());
            }

            $query = ChildReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVilleRelatedByCodevillemisedispo($this)
                ->count($con);
        }

        return count($this->collReservationsRelatedByCodevillemisedispo);
    }

    /**
     * Method called to associate a ChildReservation object to this object
     * through the ChildReservation foreign key attribute.
     *
     * @param ChildReservation $l ChildReservation
     * @return $this The current object (for fluent API support)
     */
    public function addReservationRelatedByCodevillemisedispo(ChildReservation $l)
    {
        if ($this->collReservationsRelatedByCodevillemisedispo === null) {
            $this->initReservationsRelatedByCodevillemisedispo();
            $this->collReservationsRelatedByCodevillemisedispoPartial = true;
        }

        if (!$this->collReservationsRelatedByCodevillemisedispo->contains($l)) {
            $this->doAddReservationRelatedByCodevillemisedispo($l);

            if ($this->reservationsRelatedByCodevillemisedispoScheduledForDeletion and $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->contains($l)) {
                $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->remove($this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReservation $reservationRelatedByCodevillemisedispo The ChildReservation object to add.
     */
    protected function doAddReservationRelatedByCodevillemisedispo(ChildReservation $reservationRelatedByCodevillemisedispo): void
    {
        $this->collReservationsRelatedByCodevillemisedispo[]= $reservationRelatedByCodevillemisedispo;
        $reservationRelatedByCodevillemisedispo->setVilleRelatedByCodevillemisedispo($this);
    }

    /**
     * @param ChildReservation $reservationRelatedByCodevillemisedispo The ChildReservation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReservationRelatedByCodevillemisedispo(ChildReservation $reservationRelatedByCodevillemisedispo)
    {
        if ($this->getReservationsRelatedByCodevillemisedispo()->contains($reservationRelatedByCodevillemisedispo)) {
            $pos = $this->collReservationsRelatedByCodevillemisedispo->search($reservationRelatedByCodevillemisedispo);
            $this->collReservationsRelatedByCodevillemisedispo->remove($pos);
            if (null === $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion) {
                $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion = clone $this->collReservationsRelatedByCodevillemisedispo;
                $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion->clear();
            }
            $this->reservationsRelatedByCodevillemisedispoScheduledForDeletion[]= clone $reservationRelatedByCodevillemisedispo;
            $reservationRelatedByCodevillemisedispo->setVilleRelatedByCodevillemisedispo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Ville is new, it will return
     * an empty collection; or if this Ville has previously
     * been saved, it will retrieve related ReservationsRelatedByCodevillemisedispo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Ville.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsRelatedByCodevillemisedispoJoinUtilisateur(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Utilisateur', $joinBehavior);

        return $this->getReservationsRelatedByCodevillemisedispo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Ville is new, it will return
     * an empty collection; or if this Ville has previously
     * been saved, it will retrieve related ReservationsRelatedByCodevillemisedispo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Ville.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsRelatedByCodevillemisedispoJoinDevis(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Devis', $joinBehavior);

        return $this->getReservationsRelatedByCodevillemisedispo($query, $con);
    }

    /**
     * Clears out the collReservationsRelatedByCodevillerendre collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReservationsRelatedByCodevillerendre()
     */
    public function clearReservationsRelatedByCodevillerendre()
    {
        $this->collReservationsRelatedByCodevillerendre = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReservationsRelatedByCodevillerendre collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReservationsRelatedByCodevillerendre($v = true): void
    {
        $this->collReservationsRelatedByCodevillerendrePartial = $v;
    }

    /**
     * Initializes the collReservationsRelatedByCodevillerendre collection.
     *
     * By default this just sets the collReservationsRelatedByCodevillerendre collection to an empty array (like clearcollReservationsRelatedByCodevillerendre());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservationsRelatedByCodevillerendre(bool $overrideExisting = true): void
    {
        if (null !== $this->collReservationsRelatedByCodevillerendre && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collReservationsRelatedByCodevillerendre = new $collectionClassName;
        $this->collReservationsRelatedByCodevillerendre->setModel('\App\Http\Model\Reservation');
    }

    /**
     * Gets an array of ChildReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVille is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation> List of ChildReservation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReservationsRelatedByCodevillerendre(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReservationsRelatedByCodevillerendrePartial && !$this->isNew();
        if (null === $this->collReservationsRelatedByCodevillerendre || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservationsRelatedByCodevillerendre) {
                    $this->initReservationsRelatedByCodevillerendre();
                } else {
                    $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

                    $collReservationsRelatedByCodevillerendre = new $collectionClassName;
                    $collReservationsRelatedByCodevillerendre->setModel('\App\Http\Model\Reservation');

                    return $collReservationsRelatedByCodevillerendre;
                }
            } else {
                $collReservationsRelatedByCodevillerendre = ChildReservationQuery::create(null, $criteria)
                    ->filterByVilleRelatedByCodevillerendre($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReservationsRelatedByCodevillerendrePartial && count($collReservationsRelatedByCodevillerendre)) {
                        $this->initReservationsRelatedByCodevillerendre(false);

                        foreach ($collReservationsRelatedByCodevillerendre as $obj) {
                            if (false == $this->collReservationsRelatedByCodevillerendre->contains($obj)) {
                                $this->collReservationsRelatedByCodevillerendre->append($obj);
                            }
                        }

                        $this->collReservationsRelatedByCodevillerendrePartial = true;
                    }

                    return $collReservationsRelatedByCodevillerendre;
                }

                if ($partial && $this->collReservationsRelatedByCodevillerendre) {
                    foreach ($this->collReservationsRelatedByCodevillerendre as $obj) {
                        if ($obj->isNew()) {
                            $collReservationsRelatedByCodevillerendre[] = $obj;
                        }
                    }
                }

                $this->collReservationsRelatedByCodevillerendre = $collReservationsRelatedByCodevillerendre;
                $this->collReservationsRelatedByCodevillerendrePartial = false;
            }
        }

        return $this->collReservationsRelatedByCodevillerendre;
    }

    /**
     * Sets a collection of ChildReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reservationsRelatedByCodevillerendre A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReservationsRelatedByCodevillerendre(Collection $reservationsRelatedByCodevillerendre, ?ConnectionInterface $con = null)
    {
        /** @var ChildReservation[] $reservationsRelatedByCodevillerendreToDelete */
        $reservationsRelatedByCodevillerendreToDelete = $this->getReservationsRelatedByCodevillerendre(new Criteria(), $con)->diff($reservationsRelatedByCodevillerendre);


        $this->reservationsRelatedByCodevillerendreScheduledForDeletion = $reservationsRelatedByCodevillerendreToDelete;

        foreach ($reservationsRelatedByCodevillerendreToDelete as $reservationRelatedByCodevillerendreRemoved) {
            $reservationRelatedByCodevillerendreRemoved->setVilleRelatedByCodevillerendre(null);
        }

        $this->collReservationsRelatedByCodevillerendre = null;
        foreach ($reservationsRelatedByCodevillerendre as $reservationRelatedByCodevillerendre) {
            $this->addReservationRelatedByCodevillerendre($reservationRelatedByCodevillerendre);
        }

        $this->collReservationsRelatedByCodevillerendre = $reservationsRelatedByCodevillerendre;
        $this->collReservationsRelatedByCodevillerendrePartial = false;

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
    public function countReservationsRelatedByCodevillerendre(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReservationsRelatedByCodevillerendrePartial && !$this->isNew();
        if (null === $this->collReservationsRelatedByCodevillerendre || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservationsRelatedByCodevillerendre) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservationsRelatedByCodevillerendre());
            }

            $query = ChildReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVilleRelatedByCodevillerendre($this)
                ->count($con);
        }

        return count($this->collReservationsRelatedByCodevillerendre);
    }

    /**
     * Method called to associate a ChildReservation object to this object
     * through the ChildReservation foreign key attribute.
     *
     * @param ChildReservation $l ChildReservation
     * @return $this The current object (for fluent API support)
     */
    public function addReservationRelatedByCodevillerendre(ChildReservation $l)
    {
        if ($this->collReservationsRelatedByCodevillerendre === null) {
            $this->initReservationsRelatedByCodevillerendre();
            $this->collReservationsRelatedByCodevillerendrePartial = true;
        }

        if (!$this->collReservationsRelatedByCodevillerendre->contains($l)) {
            $this->doAddReservationRelatedByCodevillerendre($l);

            if ($this->reservationsRelatedByCodevillerendreScheduledForDeletion and $this->reservationsRelatedByCodevillerendreScheduledForDeletion->contains($l)) {
                $this->reservationsRelatedByCodevillerendreScheduledForDeletion->remove($this->reservationsRelatedByCodevillerendreScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReservation $reservationRelatedByCodevillerendre The ChildReservation object to add.
     */
    protected function doAddReservationRelatedByCodevillerendre(ChildReservation $reservationRelatedByCodevillerendre): void
    {
        $this->collReservationsRelatedByCodevillerendre[]= $reservationRelatedByCodevillerendre;
        $reservationRelatedByCodevillerendre->setVilleRelatedByCodevillerendre($this);
    }

    /**
     * @param ChildReservation $reservationRelatedByCodevillerendre The ChildReservation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReservationRelatedByCodevillerendre(ChildReservation $reservationRelatedByCodevillerendre)
    {
        if ($this->getReservationsRelatedByCodevillerendre()->contains($reservationRelatedByCodevillerendre)) {
            $pos = $this->collReservationsRelatedByCodevillerendre->search($reservationRelatedByCodevillerendre);
            $this->collReservationsRelatedByCodevillerendre->remove($pos);
            if (null === $this->reservationsRelatedByCodevillerendreScheduledForDeletion) {
                $this->reservationsRelatedByCodevillerendreScheduledForDeletion = clone $this->collReservationsRelatedByCodevillerendre;
                $this->reservationsRelatedByCodevillerendreScheduledForDeletion->clear();
            }
            $this->reservationsRelatedByCodevillerendreScheduledForDeletion[]= clone $reservationRelatedByCodevillerendre;
            $reservationRelatedByCodevillerendre->setVilleRelatedByCodevillerendre(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Ville is new, it will return
     * an empty collection; or if this Ville has previously
     * been saved, it will retrieve related ReservationsRelatedByCodevillerendre from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Ville.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsRelatedByCodevillerendreJoinUtilisateur(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Utilisateur', $joinBehavior);

        return $this->getReservationsRelatedByCodevillerendre($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Ville is new, it will return
     * an empty collection; or if this Ville has previously
     * been saved, it will retrieve related ReservationsRelatedByCodevillerendre from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Ville.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsRelatedByCodevillerendreJoinDevis(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Devis', $joinBehavior);

        return $this->getReservationsRelatedByCodevillerendre($query, $con);
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
            $this->aPays->removeVille($this);
        }
        $this->codeville = null;
        $this->nomville = null;
        $this->codepays = null;
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
            if ($this->collReservationsRelatedByCodevillemisedispo) {
                foreach ($this->collReservationsRelatedByCodevillemisedispo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReservationsRelatedByCodevillerendre) {
                foreach ($this->collReservationsRelatedByCodevillerendre as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservationsRelatedByCodevillemisedispo = null;
        $this->collReservationsRelatedByCodevillerendre = null;
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
        return (string) $this->exportTo(VilleTableMap::DEFAULT_STRING_FORMAT);
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
