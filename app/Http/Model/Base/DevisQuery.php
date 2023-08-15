<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Devis as ChildDevis;
use App\Http\Model\DevisQuery as ChildDevisQuery;
use App\Http\Model\Map\DevisTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `devis` table.
 *
 * @method     ChildDevisQuery orderByCodedevis($order = Criteria::ASC) Order by the codeDevis column
 * @method     ChildDevisQuery orderByDatedevis($order = Criteria::ASC) Order by the dateDevis column
 * @method     ChildDevisQuery orderByMontantdevis($order = Criteria::ASC) Order by the montantDevis column
 * @method     ChildDevisQuery orderByVolume($order = Criteria::ASC) Order by the volume column
 * @method     ChildDevisQuery orderByNbcontainers($order = Criteria::ASC) Order by the nbContainers column
 * @method     ChildDevisQuery orderByValider($order = Criteria::ASC) Order by the valider column
 *
 * @method     ChildDevisQuery groupByCodedevis() Group by the codeDevis column
 * @method     ChildDevisQuery groupByDatedevis() Group by the dateDevis column
 * @method     ChildDevisQuery groupByMontantdevis() Group by the montantDevis column
 * @method     ChildDevisQuery groupByVolume() Group by the volume column
 * @method     ChildDevisQuery groupByNbcontainers() Group by the nbContainers column
 * @method     ChildDevisQuery groupByValider() Group by the valider column
 *
 * @method     ChildDevisQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDevisQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDevisQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDevisQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDevisQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDevisQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDevisQuery leftJoinReservation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reservation relation
 * @method     ChildDevisQuery rightJoinReservation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reservation relation
 * @method     ChildDevisQuery innerJoinReservation($relationAlias = null) Adds a INNER JOIN clause to the query using the Reservation relation
 *
 * @method     ChildDevisQuery joinWithReservation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reservation relation
 *
 * @method     ChildDevisQuery leftJoinWithReservation() Adds a LEFT JOIN clause and with to the query using the Reservation relation
 * @method     ChildDevisQuery rightJoinWithReservation() Adds a RIGHT JOIN clause and with to the query using the Reservation relation
 * @method     ChildDevisQuery innerJoinWithReservation() Adds a INNER JOIN clause and with to the query using the Reservation relation
 *
 * @method     \App\Http\Model\ReservationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDevis|null findOne(?ConnectionInterface $con = null) Return the first ChildDevis matching the query
 * @method     ChildDevis findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDevis matching the query, or a new ChildDevis object populated from the query conditions when no match is found
 *
 * @method     ChildDevis|null findOneByCodedevis(int $codeDevis) Return the first ChildDevis filtered by the codeDevis column
 * @method     ChildDevis|null findOneByDatedevis(string $dateDevis) Return the first ChildDevis filtered by the dateDevis column
 * @method     ChildDevis|null findOneByMontantdevis(string $montantDevis) Return the first ChildDevis filtered by the montantDevis column
 * @method     ChildDevis|null findOneByVolume(int $volume) Return the first ChildDevis filtered by the volume column
 * @method     ChildDevis|null findOneByNbcontainers(int $nbContainers) Return the first ChildDevis filtered by the nbContainers column
 * @method     ChildDevis|null findOneByValider(boolean $valider) Return the first ChildDevis filtered by the valider column
 *
 * @method     ChildDevis requirePk($key, ?ConnectionInterface $con = null) Return the ChildDevis by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOne(?ConnectionInterface $con = null) Return the first ChildDevis matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDevis requireOneByCodedevis(int $codeDevis) Return the first ChildDevis filtered by the codeDevis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOneByDatedevis(string $dateDevis) Return the first ChildDevis filtered by the dateDevis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOneByMontantdevis(string $montantDevis) Return the first ChildDevis filtered by the montantDevis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOneByVolume(int $volume) Return the first ChildDevis filtered by the volume column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOneByNbcontainers(int $nbContainers) Return the first ChildDevis filtered by the nbContainers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevis requireOneByValider(boolean $valider) Return the first ChildDevis filtered by the valider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDevis[]|Collection find(?ConnectionInterface $con = null) Return ChildDevis objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDevis> find(?ConnectionInterface $con = null) Return ChildDevis objects based on current ModelCriteria
 *
 * @method     ChildDevis[]|Collection findByCodedevis(int|array<int> $codeDevis) Return ChildDevis objects filtered by the codeDevis column
 * @psalm-method Collection&\Traversable<ChildDevis> findByCodedevis(int|array<int> $codeDevis) Return ChildDevis objects filtered by the codeDevis column
 * @method     ChildDevis[]|Collection findByDatedevis(string|array<string> $dateDevis) Return ChildDevis objects filtered by the dateDevis column
 * @psalm-method Collection&\Traversable<ChildDevis> findByDatedevis(string|array<string> $dateDevis) Return ChildDevis objects filtered by the dateDevis column
 * @method     ChildDevis[]|Collection findByMontantdevis(string|array<string> $montantDevis) Return ChildDevis objects filtered by the montantDevis column
 * @psalm-method Collection&\Traversable<ChildDevis> findByMontantdevis(string|array<string> $montantDevis) Return ChildDevis objects filtered by the montantDevis column
 * @method     ChildDevis[]|Collection findByVolume(int|array<int> $volume) Return ChildDevis objects filtered by the volume column
 * @psalm-method Collection&\Traversable<ChildDevis> findByVolume(int|array<int> $volume) Return ChildDevis objects filtered by the volume column
 * @method     ChildDevis[]|Collection findByNbcontainers(int|array<int> $nbContainers) Return ChildDevis objects filtered by the nbContainers column
 * @psalm-method Collection&\Traversable<ChildDevis> findByNbcontainers(int|array<int> $nbContainers) Return ChildDevis objects filtered by the nbContainers column
 * @method     ChildDevis[]|Collection findByValider(boolean|array<boolean> $valider) Return ChildDevis objects filtered by the valider column
 * @psalm-method Collection&\Traversable<ChildDevis> findByValider(boolean|array<boolean> $valider) Return ChildDevis objects filtered by the valider column
 *
 * @method     ChildDevis[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDevis> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DevisQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\DevisQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Devis', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDevisQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDevisQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDevisQuery) {
            return $criteria;
        }
        $query = new ChildDevisQuery();
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
     * @return ChildDevis|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DevisTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DevisTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDevis A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codeDevis, dateDevis, montantDevis, volume, nbContainers, valider FROM devis WHERE codeDevis = :p0';
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
            /** @var ChildDevis $obj */
            $obj = new ChildDevis();
            $obj->hydrate($row);
            DevisTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDevis|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $keys, Criteria::IN);

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
                $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $codedevis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codedevis['max'])) {
                $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $codedevis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $codedevis, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dateDevis column
     *
     * Example usage:
     * <code>
     * $query->filterByDatedevis('2011-03-14'); // WHERE dateDevis = '2011-03-14'
     * $query->filterByDatedevis('now'); // WHERE dateDevis = '2011-03-14'
     * $query->filterByDatedevis(array('max' => 'yesterday')); // WHERE dateDevis > '2011-03-13'
     * </code>
     *
     * @param mixed $datedevis The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDatedevis($datedevis = null, ?string $comparison = null)
    {
        if (is_array($datedevis)) {
            $useMinMax = false;
            if (isset($datedevis['min'])) {
                $this->addUsingAlias(DevisTableMap::COL_DATEDEVIS, $datedevis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datedevis['max'])) {
                $this->addUsingAlias(DevisTableMap::COL_DATEDEVIS, $datedevis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DevisTableMap::COL_DATEDEVIS, $datedevis, $comparison);

        return $this;
    }

    /**
     * Filter the query on the montantDevis column
     *
     * Example usage:
     * <code>
     * $query->filterByMontantdevis(1234); // WHERE montantDevis = 1234
     * $query->filterByMontantdevis(array(12, 34)); // WHERE montantDevis IN (12, 34)
     * $query->filterByMontantdevis(array('min' => 12)); // WHERE montantDevis > 12
     * </code>
     *
     * @param mixed $montantdevis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMontantdevis($montantdevis = null, ?string $comparison = null)
    {
        if (is_array($montantdevis)) {
            $useMinMax = false;
            if (isset($montantdevis['min'])) {
                $this->addUsingAlias(DevisTableMap::COL_MONTANTDEVIS, $montantdevis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($montantdevis['max'])) {
                $this->addUsingAlias(DevisTableMap::COL_MONTANTDEVIS, $montantdevis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DevisTableMap::COL_MONTANTDEVIS, $montantdevis, $comparison);

        return $this;
    }

    /**
     * Filter the query on the volume column
     *
     * Example usage:
     * <code>
     * $query->filterByVolume(1234); // WHERE volume = 1234
     * $query->filterByVolume(array(12, 34)); // WHERE volume IN (12, 34)
     * $query->filterByVolume(array('min' => 12)); // WHERE volume > 12
     * </code>
     *
     * @param mixed $volume The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolume($volume = null, ?string $comparison = null)
    {
        if (is_array($volume)) {
            $useMinMax = false;
            if (isset($volume['min'])) {
                $this->addUsingAlias(DevisTableMap::COL_VOLUME, $volume['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($volume['max'])) {
                $this->addUsingAlias(DevisTableMap::COL_VOLUME, $volume['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DevisTableMap::COL_VOLUME, $volume, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nbContainers column
     *
     * Example usage:
     * <code>
     * $query->filterByNbcontainers(1234); // WHERE nbContainers = 1234
     * $query->filterByNbcontainers(array(12, 34)); // WHERE nbContainers IN (12, 34)
     * $query->filterByNbcontainers(array('min' => 12)); // WHERE nbContainers > 12
     * </code>
     *
     * @param mixed $nbcontainers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNbcontainers($nbcontainers = null, ?string $comparison = null)
    {
        if (is_array($nbcontainers)) {
            $useMinMax = false;
            if (isset($nbcontainers['min'])) {
                $this->addUsingAlias(DevisTableMap::COL_NBCONTAINERS, $nbcontainers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbcontainers['max'])) {
                $this->addUsingAlias(DevisTableMap::COL_NBCONTAINERS, $nbcontainers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DevisTableMap::COL_NBCONTAINERS, $nbcontainers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the valider column
     *
     * Example usage:
     * <code>
     * $query->filterByValider(true); // WHERE valider = true
     * $query->filterByValider('yes'); // WHERE valider = true
     * </code>
     *
     * @param bool|string $valider The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValider($valider = null, ?string $comparison = null)
    {
        if (is_string($valider)) {
            $valider = in_array(strtolower($valider), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DevisTableMap::COL_VALIDER, $valider, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Reservation object
     *
     * @param \App\Http\Model\Reservation|ObjectCollection $reservation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReservation($reservation, ?string $comparison = null)
    {
        if ($reservation instanceof \App\Http\Model\Reservation) {
            $this
                ->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $reservation->getCodedevis(), $comparison);

            return $this;
        } elseif ($reservation instanceof ObjectCollection) {
            $this
                ->useReservationQuery()
                ->filterByPrimaryKeys($reservation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReservation() only accepts arguments of type \App\Http\Model\Reservation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reservation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReservation(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reservation');

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
            $this->addJoinObject($join, 'Reservation');
        }

        return $this;
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReservationQuery A secondary query class using the current class as primary query
     */
    public function useReservationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinReservation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reservation', '\App\Http\Model\ReservationQuery');
    }

    /**
     * Use the Reservation relation Reservation object
     *
     * @param callable(\App\Http\Model\ReservationQuery):\App\Http\Model\ReservationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReservationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useReservationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Reservation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the EXISTS statement
     */
    public function useReservationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useExistsQuery('Reservation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Reservation table for a NOT EXISTS query.
     *
     * @see useReservationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the NOT EXISTS statement
     */
    public function useReservationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useExistsQuery('Reservation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Reservation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the IN statement
     */
    public function useInReservationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useInQuery('Reservation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Reservation table for a NOT IN query.
     *
     * @see useReservationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReservationQuery The inner query object of the NOT IN statement
     */
    public function useNotInReservationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\ReservationQuery */
        $q = $this->useInQuery('Reservation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDevis $devis Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($devis = null)
    {
        if ($devis) {
            $this->addUsingAlias(DevisTableMap::COL_CODEDEVIS, $devis->getCodedevis(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DevisTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DevisTableMap::clearInstancePool();
            DevisTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DevisTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DevisTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DevisTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DevisTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
