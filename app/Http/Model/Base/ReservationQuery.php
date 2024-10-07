<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Map\ReservationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `reservation` table.
 *
 * @method     ChildReservationQuery orderByCodereservation($order = Criteria::ASC) Order by the codeReservation column
 * @method     ChildReservationQuery orderByDatedebutreservation($order = Criteria::ASC) Order by the dateDebutReservation column
 * @method     ChildReservationQuery orderByDatefinreservation($order = Criteria::ASC) Order by the dateFinReservation column
 * @method     ChildReservationQuery orderByDatereservation($order = Criteria::ASC) Order by the dateReservation column
 * @method     ChildReservationQuery orderByVolumeestime($order = Criteria::ASC) Order by the volumeEstime column
 * @method     ChildReservationQuery orderByCodedevis($order = Criteria::ASC) Order by the codeDevis column
 * @method     ChildReservationQuery orderByCodevillemisedispo($order = Criteria::ASC) Order by the codeVilleMiseDispo column
 * @method     ChildReservationQuery orderByCodevillerendre($order = Criteria::ASC) Order by the codeVilleRendre column
 * @method     ChildReservationQuery orderByCodeutilisateur($order = Criteria::ASC) Order by the codeUtilisateur column
 * @method     ChildReservationQuery orderByEtat($order = Criteria::ASC) Order by the etat column
 *
 * @method     ChildReservationQuery groupByCodereservation() Group by the codeReservation column
 * @method     ChildReservationQuery groupByDatedebutreservation() Group by the dateDebutReservation column
 * @method     ChildReservationQuery groupByDatefinreservation() Group by the dateFinReservation column
 * @method     ChildReservationQuery groupByDatereservation() Group by the dateReservation column
 * @method     ChildReservationQuery groupByVolumeestime() Group by the volumeEstime column
 * @method     ChildReservationQuery groupByCodedevis() Group by the codeDevis column
 * @method     ChildReservationQuery groupByCodevillemisedispo() Group by the codeVilleMiseDispo column
 * @method     ChildReservationQuery groupByCodevillerendre() Group by the codeVilleRendre column
 * @method     ChildReservationQuery groupByCodeutilisateur() Group by the codeUtilisateur column
 * @method     ChildReservationQuery groupByEtat() Group by the etat column
 *
 * @method     ChildReservationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReservationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReservationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReservationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReservationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReservationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReservationQuery leftJoinUtilisateur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Utilisateur relation
 * @method     ChildReservationQuery rightJoinUtilisateur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Utilisateur relation
 * @method     ChildReservationQuery innerJoinUtilisateur($relationAlias = null) Adds a INNER JOIN clause to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery joinWithUtilisateur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery leftJoinWithUtilisateur() Adds a LEFT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildReservationQuery rightJoinWithUtilisateur() Adds a RIGHT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildReservationQuery innerJoinWithUtilisateur() Adds a INNER JOIN clause and with to the query using the Utilisateur relation
 *
 * @method     ChildReservationQuery leftJoinVilleRelatedByCodevillemisedispo($relationAlias = null) Adds a LEFT JOIN clause to the query using the VilleRelatedByCodevillemisedispo relation
 * @method     ChildReservationQuery rightJoinVilleRelatedByCodevillemisedispo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VilleRelatedByCodevillemisedispo relation
 * @method     ChildReservationQuery innerJoinVilleRelatedByCodevillemisedispo($relationAlias = null) Adds a INNER JOIN clause to the query using the VilleRelatedByCodevillemisedispo relation
 *
 * @method     ChildReservationQuery joinWithVilleRelatedByCodevillemisedispo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VilleRelatedByCodevillemisedispo relation
 *
 * @method     ChildReservationQuery leftJoinWithVilleRelatedByCodevillemisedispo() Adds a LEFT JOIN clause and with to the query using the VilleRelatedByCodevillemisedispo relation
 * @method     ChildReservationQuery rightJoinWithVilleRelatedByCodevillemisedispo() Adds a RIGHT JOIN clause and with to the query using the VilleRelatedByCodevillemisedispo relation
 * @method     ChildReservationQuery innerJoinWithVilleRelatedByCodevillemisedispo() Adds a INNER JOIN clause and with to the query using the VilleRelatedByCodevillemisedispo relation
 *
 * @method     ChildReservationQuery leftJoinVilleRelatedByCodevillerendre($relationAlias = null) Adds a LEFT JOIN clause to the query using the VilleRelatedByCodevillerendre relation
 * @method     ChildReservationQuery rightJoinVilleRelatedByCodevillerendre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VilleRelatedByCodevillerendre relation
 * @method     ChildReservationQuery innerJoinVilleRelatedByCodevillerendre($relationAlias = null) Adds a INNER JOIN clause to the query using the VilleRelatedByCodevillerendre relation
 *
 * @method     ChildReservationQuery joinWithVilleRelatedByCodevillerendre($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VilleRelatedByCodevillerendre relation
 *
 * @method     ChildReservationQuery leftJoinWithVilleRelatedByCodevillerendre() Adds a LEFT JOIN clause and with to the query using the VilleRelatedByCodevillerendre relation
 * @method     ChildReservationQuery rightJoinWithVilleRelatedByCodevillerendre() Adds a RIGHT JOIN clause and with to the query using the VilleRelatedByCodevillerendre relation
 * @method     ChildReservationQuery innerJoinWithVilleRelatedByCodevillerendre() Adds a INNER JOIN clause and with to the query using the VilleRelatedByCodevillerendre relation
 *
 * @method     ChildReservationQuery leftJoinDevis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Devis relation
 * @method     ChildReservationQuery rightJoinDevis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Devis relation
 * @method     ChildReservationQuery innerJoinDevis($relationAlias = null) Adds a INNER JOIN clause to the query using the Devis relation
 *
 * @method     ChildReservationQuery joinWithDevis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Devis relation
 *
 * @method     ChildReservationQuery leftJoinWithDevis() Adds a LEFT JOIN clause and with to the query using the Devis relation
 * @method     ChildReservationQuery rightJoinWithDevis() Adds a RIGHT JOIN clause and with to the query using the Devis relation
 * @method     ChildReservationQuery innerJoinWithDevis() Adds a INNER JOIN clause and with to the query using the Devis relation
 *
 * @method     ChildReservationQuery leftJoinReserver($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reserver relation
 * @method     ChildReservationQuery rightJoinReserver($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reserver relation
 * @method     ChildReservationQuery innerJoinReserver($relationAlias = null) Adds a INNER JOIN clause to the query using the Reserver relation
 *
 * @method     ChildReservationQuery joinWithReserver($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reserver relation
 *
 * @method     ChildReservationQuery leftJoinWithReserver() Adds a LEFT JOIN clause and with to the query using the Reserver relation
 * @method     ChildReservationQuery rightJoinWithReserver() Adds a RIGHT JOIN clause and with to the query using the Reserver relation
 * @method     ChildReservationQuery innerJoinWithReserver() Adds a INNER JOIN clause and with to the query using the Reserver relation
 *
 * @method     \App\Http\Model\UtilisateurQuery|\App\Http\Model\VilleQuery|\App\Http\Model\VilleQuery|\App\Http\Model\DevisQuery|\App\Http\Model\ReserverQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReservation|null findOne(?ConnectionInterface $con = null) Return the first ChildReservation matching the query
 * @method     ChildReservation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildReservation matching the query, or a new ChildReservation object populated from the query conditions when no match is found
 *
 * @method     ChildReservation|null findOneByCodereservation(int $codeReservation) Return the first ChildReservation filtered by the codeReservation column
 * @method     ChildReservation|null findOneByDatedebutreservation(string $dateDebutReservation) Return the first ChildReservation filtered by the dateDebutReservation column
 * @method     ChildReservation|null findOneByDatefinreservation(string $dateFinReservation) Return the first ChildReservation filtered by the dateFinReservation column
 * @method     ChildReservation|null findOneByDatereservation(string $dateReservation) Return the first ChildReservation filtered by the dateReservation column
 * @method     ChildReservation|null findOneByVolumeestime(int $volumeEstime) Return the first ChildReservation filtered by the volumeEstime column
 * @method     ChildReservation|null findOneByCodedevis(int $codeDevis) Return the first ChildReservation filtered by the codeDevis column
 * @method     ChildReservation|null findOneByCodevillemisedispo(string $codeVilleMiseDispo) Return the first ChildReservation filtered by the codeVilleMiseDispo column
 * @method     ChildReservation|null findOneByCodevillerendre(string $codeVilleRendre) Return the first ChildReservation filtered by the codeVilleRendre column
 * @method     ChildReservation|null findOneByCodeutilisateur(int $codeUtilisateur) Return the first ChildReservation filtered by the codeUtilisateur column
 * @method     ChildReservation|null findOneByEtat(string $etat) Return the first ChildReservation filtered by the etat column
 *
 * @method     ChildReservation requirePk($key, ?ConnectionInterface $con = null) Return the ChildReservation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOne(?ConnectionInterface $con = null) Return the first ChildReservation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservation requireOneByCodereservation(int $codeReservation) Return the first ChildReservation filtered by the codeReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByDatedebutreservation(string $dateDebutReservation) Return the first ChildReservation filtered by the dateDebutReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByDatefinreservation(string $dateFinReservation) Return the first ChildReservation filtered by the dateFinReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByDatereservation(string $dateReservation) Return the first ChildReservation filtered by the dateReservation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByVolumeestime(int $volumeEstime) Return the first ChildReservation filtered by the volumeEstime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByCodedevis(int $codeDevis) Return the first ChildReservation filtered by the codeDevis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByCodevillemisedispo(string $codeVilleMiseDispo) Return the first ChildReservation filtered by the codeVilleMiseDispo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByCodevillerendre(string $codeVilleRendre) Return the first ChildReservation filtered by the codeVilleRendre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByCodeutilisateur(int $codeUtilisateur) Return the first ChildReservation filtered by the codeUtilisateur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReservation requireOneByEtat(string $etat) Return the first ChildReservation filtered by the etat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReservation[]|Collection find(?ConnectionInterface $con = null) Return ChildReservation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildReservation> find(?ConnectionInterface $con = null) Return ChildReservation objects based on current ModelCriteria
 *
 * @method     ChildReservation[]|Collection findByCodereservation(int|array<int> $codeReservation) Return ChildReservation objects filtered by the codeReservation column
 * @psalm-method Collection&\Traversable<ChildReservation> findByCodereservation(int|array<int> $codeReservation) Return ChildReservation objects filtered by the codeReservation column
 * @method     ChildReservation[]|Collection findByDatedebutreservation(string|array<string> $dateDebutReservation) Return ChildReservation objects filtered by the dateDebutReservation column
 * @psalm-method Collection&\Traversable<ChildReservation> findByDatedebutreservation(string|array<string> $dateDebutReservation) Return ChildReservation objects filtered by the dateDebutReservation column
 * @method     ChildReservation[]|Collection findByDatefinreservation(string|array<string> $dateFinReservation) Return ChildReservation objects filtered by the dateFinReservation column
 * @psalm-method Collection&\Traversable<ChildReservation> findByDatefinreservation(string|array<string> $dateFinReservation) Return ChildReservation objects filtered by the dateFinReservation column
 * @method     ChildReservation[]|Collection findByDatereservation(string|array<string> $dateReservation) Return ChildReservation objects filtered by the dateReservation column
 * @psalm-method Collection&\Traversable<ChildReservation> findByDatereservation(string|array<string> $dateReservation) Return ChildReservation objects filtered by the dateReservation column
 * @method     ChildReservation[]|Collection findByVolumeestime(int|array<int> $volumeEstime) Return ChildReservation objects filtered by the volumeEstime column
 * @psalm-method Collection&\Traversable<ChildReservation> findByVolumeestime(int|array<int> $volumeEstime) Return ChildReservation objects filtered by the volumeEstime column
 * @method     ChildReservation[]|Collection findByCodedevis(int|array<int> $codeDevis) Return ChildReservation objects filtered by the codeDevis column
 * @psalm-method Collection&\Traversable<ChildReservation> findByCodedevis(int|array<int> $codeDevis) Return ChildReservation objects filtered by the codeDevis column
 * @method     ChildReservation[]|Collection findByCodevillemisedispo(string|array<string> $codeVilleMiseDispo) Return ChildReservation objects filtered by the codeVilleMiseDispo column
 * @psalm-method Collection&\Traversable<ChildReservation> findByCodevillemisedispo(string|array<string> $codeVilleMiseDispo) Return ChildReservation objects filtered by the codeVilleMiseDispo column
 * @method     ChildReservation[]|Collection findByCodevillerendre(string|array<string> $codeVilleRendre) Return ChildReservation objects filtered by the codeVilleRendre column
 * @psalm-method Collection&\Traversable<ChildReservation> findByCodevillerendre(string|array<string> $codeVilleRendre) Return ChildReservation objects filtered by the codeVilleRendre column
 * @method     ChildReservation[]|Collection findByCodeutilisateur(int|array<int> $codeUtilisateur) Return ChildReservation objects filtered by the codeUtilisateur column
 * @psalm-method Collection&\Traversable<ChildReservation> findByCodeutilisateur(int|array<int> $codeUtilisateur) Return ChildReservation objects filtered by the codeUtilisateur column
 * @method     ChildReservation[]|Collection findByEtat(string|array<string> $etat) Return ChildReservation objects filtered by the etat column
 * @psalm-method Collection&\Traversable<ChildReservation> findByEtat(string|array<string> $etat) Return ChildReservation objects filtered by the etat column
 *
 * @method     ChildReservation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildReservation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ReservationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\ReservationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Reservation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReservationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReservationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildReservationQuery) {
            return $criteria;
        }
        $query = new ChildReservationQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReservation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReservationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReservationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReservation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codeReservation, dateDebutReservation, dateFinReservation, dateReservation, volumeEstime, codeDevis, codeVilleMiseDispo, codeVilleRendre, codeUtilisateur, etat FROM reservation WHERE codeReservation = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReservation $obj */
            $obj = new ChildReservation();
            $obj->hydrate($row);
            ReservationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildReservation|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codeReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByCodereservation(1234); // WHERE codeReservation = 1234
     * $query->filterByCodereservation(array(12, 34)); // WHERE codeReservation IN (12, 34)
     * $query->filterByCodereservation(array('min' => 12)); // WHERE codeReservation > 12
     * </code>
     *
     * @param mixed $codereservation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodereservation($codereservation = null, ?string $comparison = null)
    {
        if (is_array($codereservation)) {
            $useMinMax = false;
            if (isset($codereservation['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $codereservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codereservation['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $codereservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $codereservation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dateDebutReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByDatedebutreservation('2011-03-14'); // WHERE dateDebutReservation = '2011-03-14'
     * $query->filterByDatedebutreservation('now'); // WHERE dateDebutReservation = '2011-03-14'
     * $query->filterByDatedebutreservation(array('max' => 'yesterday')); // WHERE dateDebutReservation > '2011-03-13'
     * </code>
     *
     * @param mixed $datedebutreservation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDatedebutreservation($datedebutreservation = null, ?string $comparison = null)
    {
        if (is_array($datedebutreservation)) {
            $useMinMax = false;
            if (isset($datedebutreservation['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEDEBUTRESERVATION, $datedebutreservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datedebutreservation['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEDEBUTRESERVATION, $datedebutreservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_DATEDEBUTRESERVATION, $datedebutreservation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dateFinReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByDatefinreservation('2011-03-14'); // WHERE dateFinReservation = '2011-03-14'
     * $query->filterByDatefinreservation('now'); // WHERE dateFinReservation = '2011-03-14'
     * $query->filterByDatefinreservation(array('max' => 'yesterday')); // WHERE dateFinReservation > '2011-03-13'
     * </code>
     *
     * @param mixed $datefinreservation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDatefinreservation($datefinreservation = null, ?string $comparison = null)
    {
        if (is_array($datefinreservation)) {
            $useMinMax = false;
            if (isset($datefinreservation['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEFINRESERVATION, $datefinreservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datefinreservation['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATEFINRESERVATION, $datefinreservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_DATEFINRESERVATION, $datefinreservation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dateReservation column
     *
     * Example usage:
     * <code>
     * $query->filterByDatereservation('2011-03-14'); // WHERE dateReservation = '2011-03-14'
     * $query->filterByDatereservation('now'); // WHERE dateReservation = '2011-03-14'
     * $query->filterByDatereservation(array('max' => 'yesterday')); // WHERE dateReservation > '2011-03-13'
     * </code>
     *
     * @param mixed $datereservation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDatereservation($datereservation = null, ?string $comparison = null)
    {
        if (is_array($datereservation)) {
            $useMinMax = false;
            if (isset($datereservation['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datereservation['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_DATERESERVATION, $datereservation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the volumeEstime column
     *
     * Example usage:
     * <code>
     * $query->filterByVolumeestime(1234); // WHERE volumeEstime = 1234
     * $query->filterByVolumeestime(array(12, 34)); // WHERE volumeEstime IN (12, 34)
     * $query->filterByVolumeestime(array('min' => 12)); // WHERE volumeEstime > 12
     * </code>
     *
     * @param mixed $volumeestime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolumeestime($volumeestime = null, ?string $comparison = null)
    {
        if (is_array($volumeestime)) {
            $useMinMax = false;
            if (isset($volumeestime['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_VOLUMEESTIME, $volumeestime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($volumeestime['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_VOLUMEESTIME, $volumeestime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_VOLUMEESTIME, $volumeestime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codeDevis column
     *
     * Example usage:
     * <code>
     * $query->filterByCodedevis(1234); // WHERE codeDevis = 1234
     * $query->filterByCodedevis(array(12, 34)); // WHERE codeDevis IN (12, 34)
     * $query->filterByCodedevis(array('min' => 12)); // WHERE codeDevis > 12
     * </code>
     *
     * @see       filterByDevis()
     *
     * @param mixed $codedevis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodedevis($codedevis = null, ?string $comparison = null)
    {
        if (is_array($codedevis)) {
            $useMinMax = false;
            if (isset($codedevis['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODEDEVIS, $codedevis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codedevis['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODEDEVIS, $codedevis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_CODEDEVIS, $codedevis, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codeVilleMiseDispo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodevillemisedispo('fooValue');   // WHERE codeVilleMiseDispo = 'fooValue'
     * $query->filterByCodevillemisedispo('%fooValue%', Criteria::LIKE); // WHERE codeVilleMiseDispo LIKE '%fooValue%'
     * $query->filterByCodevillemisedispo(['foo', 'bar']); // WHERE codeVilleMiseDispo IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codevillemisedispo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodevillemisedispo($codevillemisedispo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codevillemisedispo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_CODEVILLEMISEDISPO, $codevillemisedispo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codeVilleRendre column
     *
     * Example usage:
     * <code>
     * $query->filterByCodevillerendre('fooValue');   // WHERE codeVilleRendre = 'fooValue'
     * $query->filterByCodevillerendre('%fooValue%', Criteria::LIKE); // WHERE codeVilleRendre LIKE '%fooValue%'
     * $query->filterByCodevillerendre(['foo', 'bar']); // WHERE codeVilleRendre IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codevillerendre The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodevillerendre($codevillerendre = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codevillerendre)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_CODEVILLERENDRE, $codevillerendre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codeUtilisateur column
     *
     * Example usage:
     * <code>
     * $query->filterByCodeutilisateur(1234); // WHERE codeUtilisateur = 1234
     * $query->filterByCodeutilisateur(array(12, 34)); // WHERE codeUtilisateur IN (12, 34)
     * $query->filterByCodeutilisateur(array('min' => 12)); // WHERE codeUtilisateur > 12
     * </code>
     *
     * @see       filterByUtilisateur()
     *
     * @param mixed $codeutilisateur The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodeutilisateur($codeutilisateur = null, ?string $comparison = null)
    {
        if (is_array($codeutilisateur)) {
            $useMinMax = false;
            if (isset($codeutilisateur['min'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODEUTILISATEUR, $codeutilisateur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codeutilisateur['max'])) {
                $this->addUsingAlias(ReservationTableMap::COL_CODEUTILISATEUR, $codeutilisateur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_CODEUTILISATEUR, $codeutilisateur, $comparison);

        return $this;
    }

    /**
     * Filter the query on the etat column
     *
     * Example usage:
     * <code>
     * $query->filterByEtat('fooValue');   // WHERE etat = 'fooValue'
     * $query->filterByEtat('%fooValue%', Criteria::LIKE); // WHERE etat LIKE '%fooValue%'
     * $query->filterByEtat(['foo', 'bar']); // WHERE etat IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $etat The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEtat($etat = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etat)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReservationTableMap::COL_ETAT, $etat, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Utilisateur object
     *
     * @param \App\Http\Model\Utilisateur|ObjectCollection $utilisateur The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUtilisateur($utilisateur, ?string $comparison = null)
    {
        if ($utilisateur instanceof \App\Http\Model\Utilisateur) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_CODEUTILISATEUR, $utilisateur->getCodeutilisateur(), $comparison);
        } elseif ($utilisateur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ReservationTableMap::COL_CODEUTILISATEUR, $utilisateur->toKeyValue('PrimaryKey', 'Codeutilisateur'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUtilisateur() only accepts arguments of type \App\Http\Model\Utilisateur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Utilisateur relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUtilisateur(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Utilisateur');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Utilisateur');
        }

        return $this;
    }

    /**
     * Use the Utilisateur relation Utilisateur object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\UtilisateurQuery A secondary query class using the current class as primary query
     */
    public function useUtilisateurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUtilisateur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Utilisateur', '\App\Http\Model\UtilisateurQuery');
    }

    /**
     * Use the Utilisateur relation Utilisateur object
     *
     * @param callable(\App\Http\Model\UtilisateurQuery):\App\Http\Model\UtilisateurQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUtilisateurQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUtilisateurQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Utilisateur table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\UtilisateurQuery The inner query object of the EXISTS statement
     */
    public function useUtilisateurExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\UtilisateurQuery */
        $q = $this->useExistsQuery('Utilisateur', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Utilisateur table for a NOT EXISTS query.
     *
     * @see useUtilisateurExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\UtilisateurQuery The inner query object of the NOT EXISTS statement
     */
    public function useUtilisateurNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\UtilisateurQuery */
        $q = $this->useExistsQuery('Utilisateur', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Utilisateur table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\UtilisateurQuery The inner query object of the IN statement
     */
    public function useInUtilisateurQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\UtilisateurQuery */
        $q = $this->useInQuery('Utilisateur', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Utilisateur table for a NOT IN query.
     *
     * @see useUtilisateurInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\UtilisateurQuery The inner query object of the NOT IN statement
     */
    public function useNotInUtilisateurQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\UtilisateurQuery */
        $q = $this->useInQuery('Utilisateur', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Ville object
     *
     * @param \App\Http\Model\Ville|ObjectCollection $ville The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVilleRelatedByCodevillemisedispo($ville, ?string $comparison = null)
    {
        if ($ville instanceof \App\Http\Model\Ville) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_CODEVILLEMISEDISPO, $ville->getCodeville(), $comparison);
        } elseif ($ville instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ReservationTableMap::COL_CODEVILLEMISEDISPO, $ville->toKeyValue('PrimaryKey', 'Codeville'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVilleRelatedByCodevillemisedispo() only accepts arguments of type \App\Http\Model\Ville or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VilleRelatedByCodevillemisedispo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVilleRelatedByCodevillemisedispo(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VilleRelatedByCodevillemisedispo');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VilleRelatedByCodevillemisedispo');
        }

        return $this;
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation Ville object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\VilleQuery A secondary query class using the current class as primary query
     */
    public function useVilleRelatedByCodevillemisedispoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVilleRelatedByCodevillemisedispo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VilleRelatedByCodevillemisedispo', '\App\Http\Model\VilleQuery');
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation Ville object
     *
     * @param callable(\App\Http\Model\VilleQuery):\App\Http\Model\VilleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVilleRelatedByCodevillemisedispoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVilleRelatedByCodevillemisedispoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation to the Ville table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the EXISTS statement
     */
    public function useVilleRelatedByCodevillemisedispoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('VilleRelatedByCodevillemisedispo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation to the Ville table for a NOT EXISTS query.
     *
     * @see useVilleRelatedByCodevillemisedispoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT EXISTS statement
     */
    public function useVilleRelatedByCodevillemisedispoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('VilleRelatedByCodevillemisedispo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation to the Ville table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the IN statement
     */
    public function useInVilleRelatedByCodevillemisedispoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('VilleRelatedByCodevillemisedispo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillemisedispo relation to the Ville table for a NOT IN query.
     *
     * @see useVilleRelatedByCodevillemisedispoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT IN statement
     */
    public function useNotInVilleRelatedByCodevillemisedispoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('VilleRelatedByCodevillemisedispo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Ville object
     *
     * @param \App\Http\Model\Ville|ObjectCollection $ville The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVilleRelatedByCodevillerendre($ville, ?string $comparison = null)
    {
        if ($ville instanceof \App\Http\Model\Ville) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_CODEVILLERENDRE, $ville->getCodeville(), $comparison);
        } elseif ($ville instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ReservationTableMap::COL_CODEVILLERENDRE, $ville->toKeyValue('PrimaryKey', 'Codeville'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVilleRelatedByCodevillerendre() only accepts arguments of type \App\Http\Model\Ville or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VilleRelatedByCodevillerendre relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVilleRelatedByCodevillerendre(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VilleRelatedByCodevillerendre');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VilleRelatedByCodevillerendre');
        }

        return $this;
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation Ville object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\VilleQuery A secondary query class using the current class as primary query
     */
    public function useVilleRelatedByCodevillerendreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVilleRelatedByCodevillerendre($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VilleRelatedByCodevillerendre', '\App\Http\Model\VilleQuery');
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation Ville object
     *
     * @param callable(\App\Http\Model\VilleQuery):\App\Http\Model\VilleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVilleRelatedByCodevillerendreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVilleRelatedByCodevillerendreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation to the Ville table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the EXISTS statement
     */
    public function useVilleRelatedByCodevillerendreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('VilleRelatedByCodevillerendre', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation to the Ville table for a NOT EXISTS query.
     *
     * @see useVilleRelatedByCodevillerendreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT EXISTS statement
     */
    public function useVilleRelatedByCodevillerendreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('VilleRelatedByCodevillerendre', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation to the Ville table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the IN statement
     */
    public function useInVilleRelatedByCodevillerendreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('VilleRelatedByCodevillerendre', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the VilleRelatedByCodevillerendre relation to the Ville table for a NOT IN query.
     *
     * @see useVilleRelatedByCodevillerendreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT IN statement
     */
    public function useNotInVilleRelatedByCodevillerendreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('VilleRelatedByCodevillerendre', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Devis object
     *
     * @param \App\Http\Model\Devis|ObjectCollection $devis The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDevis($devis, ?string $comparison = null)
    {
        if ($devis instanceof \App\Http\Model\Devis) {
            return $this
                ->addUsingAlias(ReservationTableMap::COL_CODEDEVIS, $devis->getCodedevis(), $comparison);
        } elseif ($devis instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ReservationTableMap::COL_CODEDEVIS, $devis->toKeyValue('PrimaryKey', 'Codedevis'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDevis() only accepts arguments of type \App\Http\Model\Devis or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Devis relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDevis(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Devis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Devis');
        }

        return $this;
    }

    /**
     * Use the Devis relation Devis object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\DevisQuery A secondary query class using the current class as primary query
     */
    public function useDevisQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDevis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Devis', '\App\Http\Model\DevisQuery');
    }

    /**
     * Use the Devis relation Devis object
     *
     * @param callable(\App\Http\Model\DevisQuery):\App\Http\Model\DevisQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDevisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDevisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Devis table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\DevisQuery The inner query object of the EXISTS statement
     */
    public function useDevisExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\DevisQuery */
        $q = $this->useExistsQuery('Devis', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Devis table for a NOT EXISTS query.
     *
     * @see useDevisExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\DevisQuery The inner query object of the NOT EXISTS statement
     */
    public function useDevisNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\DevisQuery */
        $q = $this->useExistsQuery('Devis', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Devis table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\DevisQuery The inner query object of the IN statement
     */
    public function useInDevisQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\DevisQuery */
        $q = $this->useInQuery('Devis', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Devis table for a NOT IN query.
     *
     * @see useDevisInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\DevisQuery The inner query object of the NOT IN statement
     */
    public function useNotInDevisQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\DevisQuery */
        $q = $this->useInQuery('Devis', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Reserver object
     *
     * @param \App\Http\Model\Reserver|ObjectCollection $reserver the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReserver($reserver, ?string $comparison = null)
    {
        if ($reserver instanceof \App\Http\Model\Reserver) {
            $this
                ->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $reserver->getCodereservation(), $comparison);

            return $this;
        } elseif ($reserver instanceof ObjectCollection) {
            $this
                ->useReserverQuery()
                ->filterByPrimaryKeys($reserver->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReserver() only accepts arguments of type \App\Http\Model\Reserver or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reserver relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReserver(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reserver');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Reserver');
        }

        return $this;
    }

    /**
     * Use the Reserver relation Reserver object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReserverQuery A secondary query class using the current class as primary query
     */
    public function useReserverQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReserver($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reserver', '\App\Http\Model\ReserverQuery');
    }

    /**
     * Use the Reserver relation Reserver object
     *
     * @param callable(\App\Http\Model\ReserverQuery):\App\Http\Model\ReserverQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReserverQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReserverQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Reserver table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the EXISTS statement
     */
    public function useReserverExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\ReserverQuery */
        $q = $this->useExistsQuery('Reserver', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Reserver table for a NOT EXISTS query.
     *
     * @see useReserverExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the NOT EXISTS statement
     */
    public function useReserverNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReserverQuery */
        $q = $this->useExistsQuery('Reserver', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Reserver table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the IN statement
     */
    public function useInReserverQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\ReserverQuery */
        $q = $this->useInQuery('Reserver', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Reserver table for a NOT IN query.
     *
     * @see useReserverInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the NOT IN statement
     */
    public function useNotInReserverQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReserverQuery */
        $q = $this->useInQuery('Reserver', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildReservation $reservation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($reservation = null)
    {
        if ($reservation) {
            $this->addUsingAlias(ReservationTableMap::COL_CODERESERVATION, $reservation->getCodereservation(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReservationTableMap::clearInstancePool();
            ReservationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReservationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReservationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReservationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
