<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Tarificationcontainer as ChildTarificationcontainer;
use App\Http\Model\TarificationcontainerQuery as ChildTarificationcontainerQuery;
use App\Http\Model\Map\TarificationcontainerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `tarificationContainer` table.
 *
 * @method     ChildTarificationcontainerQuery orderByCodeduree($order = Criteria::ASC) Order by the codeDuree column
 * @method     ChildTarificationcontainerQuery orderByNumtypecontainer($order = Criteria::ASC) Order by the numTypeContainer column
 * @method     ChildTarificationcontainerQuery orderByTarif($order = Criteria::ASC) Order by the tarif column
 *
 * @method     ChildTarificationcontainerQuery groupByCodeduree() Group by the codeDuree column
 * @method     ChildTarificationcontainerQuery groupByNumtypecontainer() Group by the numTypeContainer column
 * @method     ChildTarificationcontainerQuery groupByTarif() Group by the tarif column
 *
 * @method     ChildTarificationcontainerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTarificationcontainerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTarificationcontainerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTarificationcontainerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTarificationcontainerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTarificationcontainerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTarificationcontainerQuery leftJoinDuree($relationAlias = null) Adds a LEFT JOIN clause to the query using the Duree relation
 * @method     ChildTarificationcontainerQuery rightJoinDuree($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Duree relation
 * @method     ChildTarificationcontainerQuery innerJoinDuree($relationAlias = null) Adds a INNER JOIN clause to the query using the Duree relation
 *
 * @method     ChildTarificationcontainerQuery joinWithDuree($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Duree relation
 *
 * @method     ChildTarificationcontainerQuery leftJoinWithDuree() Adds a LEFT JOIN clause and with to the query using the Duree relation
 * @method     ChildTarificationcontainerQuery rightJoinWithDuree() Adds a RIGHT JOIN clause and with to the query using the Duree relation
 * @method     ChildTarificationcontainerQuery innerJoinWithDuree() Adds a INNER JOIN clause and with to the query using the Duree relation
 *
 * @method     ChildTarificationcontainerQuery leftJoinTypecontainer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Typecontainer relation
 * @method     ChildTarificationcontainerQuery rightJoinTypecontainer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Typecontainer relation
 * @method     ChildTarificationcontainerQuery innerJoinTypecontainer($relationAlias = null) Adds a INNER JOIN clause to the query using the Typecontainer relation
 *
 * @method     ChildTarificationcontainerQuery joinWithTypecontainer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Typecontainer relation
 *
 * @method     ChildTarificationcontainerQuery leftJoinWithTypecontainer() Adds a LEFT JOIN clause and with to the query using the Typecontainer relation
 * @method     ChildTarificationcontainerQuery rightJoinWithTypecontainer() Adds a RIGHT JOIN clause and with to the query using the Typecontainer relation
 * @method     ChildTarificationcontainerQuery innerJoinWithTypecontainer() Adds a INNER JOIN clause and with to the query using the Typecontainer relation
 *
 * @method     \App\Http\Model\DureeQuery|\App\Http\Model\TypecontainerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTarificationcontainer|null findOne(?ConnectionInterface $con = null) Return the first ChildTarificationcontainer matching the query
 * @method     ChildTarificationcontainer findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTarificationcontainer matching the query, or a new ChildTarificationcontainer object populated from the query conditions when no match is found
 *
 * @method     ChildTarificationcontainer|null findOneByCodeduree(string $codeDuree) Return the first ChildTarificationcontainer filtered by the codeDuree column
 * @method     ChildTarificationcontainer|null findOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTarificationcontainer filtered by the numTypeContainer column
 * @method     ChildTarificationcontainer|null findOneByTarif(string $tarif) Return the first ChildTarificationcontainer filtered by the tarif column
 *
 * @method     ChildTarificationcontainer requirePk($key, ?ConnectionInterface $con = null) Return the ChildTarificationcontainer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarificationcontainer requireOne(?ConnectionInterface $con = null) Return the first ChildTarificationcontainer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTarificationcontainer requireOneByCodeduree(string $codeDuree) Return the first ChildTarificationcontainer filtered by the codeDuree column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarificationcontainer requireOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTarificationcontainer filtered by the numTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarificationcontainer requireOneByTarif(string $tarif) Return the first ChildTarificationcontainer filtered by the tarif column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTarificationcontainer[]|Collection find(?ConnectionInterface $con = null) Return ChildTarificationcontainer objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTarificationcontainer> find(?ConnectionInterface $con = null) Return ChildTarificationcontainer objects based on current ModelCriteria
 *
 * @method     ChildTarificationcontainer[]|Collection findByCodeduree(string|array<string> $codeDuree) Return ChildTarificationcontainer objects filtered by the codeDuree column
 * @psalm-method Collection&\Traversable<ChildTarificationcontainer> findByCodeduree(string|array<string> $codeDuree) Return ChildTarificationcontainer objects filtered by the codeDuree column
 * @method     ChildTarificationcontainer[]|Collection findByNumtypecontainer(int|array<int> $numTypeContainer) Return ChildTarificationcontainer objects filtered by the numTypeContainer column
 * @psalm-method Collection&\Traversable<ChildTarificationcontainer> findByNumtypecontainer(int|array<int> $numTypeContainer) Return ChildTarificationcontainer objects filtered by the numTypeContainer column
 * @method     ChildTarificationcontainer[]|Collection findByTarif(string|array<string> $tarif) Return ChildTarificationcontainer objects filtered by the tarif column
 * @psalm-method Collection&\Traversable<ChildTarificationcontainer> findByTarif(string|array<string> $tarif) Return ChildTarificationcontainer objects filtered by the tarif column
 *
 * @method     ChildTarificationcontainer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTarificationcontainer> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TarificationcontainerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\TarificationcontainerQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Tarificationcontainer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTarificationcontainerQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTarificationcontainerQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTarificationcontainerQuery) {
            return $criteria;
        }
        $query = new ChildTarificationcontainerQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$codeDuree, $numTypeContainer] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTarificationcontainer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TarificationcontainerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TarificationcontainerTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildTarificationcontainer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codeDuree, numTypeContainer, tarif FROM tarificationContainer WHERE codeDuree = :p0 AND numTypeContainer = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTarificationcontainer $obj */
            $obj = new ChildTarificationcontainer();
            $obj->hydrate($row);
            TarificationcontainerTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildTarificationcontainer|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(TarificationcontainerTableMap::COL_CODEDUREE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TarificationcontainerTableMap::COL_CODEDUREE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the codeDuree column
     *
     * Example usage:
     * <code>
     * $query->filterByCodeduree('fooValue');   // WHERE codeDuree = 'fooValue'
     * $query->filterByCodeduree('%fooValue%', Criteria::LIKE); // WHERE codeDuree LIKE '%fooValue%'
     * $query->filterByCodeduree(['foo', 'bar']); // WHERE codeDuree IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codeduree The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodeduree($codeduree = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codeduree)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TarificationcontainerTableMap::COL_CODEDUREE, $codeduree, $comparison);

        return $this;
    }

    /**
     * Filter the query on the numTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByNumtypecontainer(1234); // WHERE numTypeContainer = 1234
     * $query->filterByNumtypecontainer(array(12, 34)); // WHERE numTypeContainer IN (12, 34)
     * $query->filterByNumtypecontainer(array('min' => 12)); // WHERE numTypeContainer > 12
     * </code>
     *
     * @see       filterByTypecontainer()
     *
     * @param mixed $numtypecontainer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNumtypecontainer($numtypecontainer = null, ?string $comparison = null)
    {
        if (is_array($numtypecontainer)) {
            $useMinMax = false;
            if (isset($numtypecontainer['min'])) {
                $this->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numtypecontainer['max'])) {
                $this->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tarif column
     *
     * Example usage:
     * <code>
     * $query->filterByTarif(1234); // WHERE tarif = 1234
     * $query->filterByTarif(array(12, 34)); // WHERE tarif IN (12, 34)
     * $query->filterByTarif(array('min' => 12)); // WHERE tarif > 12
     * </code>
     *
     * @param mixed $tarif The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTarif($tarif = null, ?string $comparison = null)
    {
        if (is_array($tarif)) {
            $useMinMax = false;
            if (isset($tarif['min'])) {
                $this->addUsingAlias(TarificationcontainerTableMap::COL_TARIF, $tarif['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tarif['max'])) {
                $this->addUsingAlias(TarificationcontainerTableMap::COL_TARIF, $tarif['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TarificationcontainerTableMap::COL_TARIF, $tarif, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Duree object
     *
     * @param \App\Http\Model\Duree|ObjectCollection $duree The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDuree($duree, ?string $comparison = null)
    {
        if ($duree instanceof \App\Http\Model\Duree) {
            return $this
                ->addUsingAlias(TarificationcontainerTableMap::COL_CODEDUREE, $duree->getCode(), $comparison);
        } elseif ($duree instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TarificationcontainerTableMap::COL_CODEDUREE, $duree->toKeyValue('PrimaryKey', 'Code'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDuree() only accepts arguments of type \App\Http\Model\Duree or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Duree relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDuree(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Duree');

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
            $this->addJoinObject($join, 'Duree');
        }

        return $this;
    }

    /**
     * Use the Duree relation Duree object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\DureeQuery A secondary query class using the current class as primary query
     */
    public function useDureeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDuree($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Duree', '\App\Http\Model\DureeQuery');
    }

    /**
     * Use the Duree relation Duree object
     *
     * @param callable(\App\Http\Model\DureeQuery):\App\Http\Model\DureeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDureeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDureeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Duree table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\DureeQuery The inner query object of the EXISTS statement
     */
    public function useDureeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\DureeQuery */
        $q = $this->useExistsQuery('Duree', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Duree table for a NOT EXISTS query.
     *
     * @see useDureeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\DureeQuery The inner query object of the NOT EXISTS statement
     */
    public function useDureeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\DureeQuery */
        $q = $this->useExistsQuery('Duree', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Duree table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\DureeQuery The inner query object of the IN statement
     */
    public function useInDureeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\DureeQuery */
        $q = $this->useInQuery('Duree', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Duree table for a NOT IN query.
     *
     * @see useDureeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\DureeQuery The inner query object of the NOT IN statement
     */
    public function useNotInDureeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\DureeQuery */
        $q = $this->useInQuery('Duree', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Http\Model\Typecontainer object
     *
     * @param \App\Http\Model\Typecontainer|ObjectCollection $typecontainer The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTypecontainer($typecontainer, ?string $comparison = null)
    {
        if ($typecontainer instanceof \App\Http\Model\Typecontainer) {
            return $this
                ->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $typecontainer->getNumtypecontainer(), $comparison);
        } elseif ($typecontainer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TarificationcontainerTableMap::COL_NUMTYPECONTAINER, $typecontainer->toKeyValue('PrimaryKey', 'Numtypecontainer'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTypecontainer() only accepts arguments of type \App\Http\Model\Typecontainer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Typecontainer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTypecontainer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Typecontainer');

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
            $this->addJoinObject($join, 'Typecontainer');
        }

        return $this;
    }

    /**
     * Use the Typecontainer relation Typecontainer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\TypecontainerQuery A secondary query class using the current class as primary query
     */
    public function useTypecontainerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTypecontainer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Typecontainer', '\App\Http\Model\TypecontainerQuery');
    }

    /**
     * Use the Typecontainer relation Typecontainer object
     *
     * @param callable(\App\Http\Model\TypecontainerQuery):\App\Http\Model\TypecontainerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTypecontainerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTypecontainerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Typecontainer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\TypecontainerQuery The inner query object of the EXISTS statement
     */
    public function useTypecontainerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\TypecontainerQuery */
        $q = $this->useExistsQuery('Typecontainer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Typecontainer table for a NOT EXISTS query.
     *
     * @see useTypecontainerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\TypecontainerQuery The inner query object of the NOT EXISTS statement
     */
    public function useTypecontainerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\TypecontainerQuery */
        $q = $this->useExistsQuery('Typecontainer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Typecontainer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\TypecontainerQuery The inner query object of the IN statement
     */
    public function useInTypecontainerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\TypecontainerQuery */
        $q = $this->useInQuery('Typecontainer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Typecontainer table for a NOT IN query.
     *
     * @see useTypecontainerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\TypecontainerQuery The inner query object of the NOT IN statement
     */
    public function useNotInTypecontainerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\TypecontainerQuery */
        $q = $this->useInQuery('Typecontainer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTarificationcontainer $tarificationcontainer Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tarificationcontainer = null)
    {
        if ($tarificationcontainer) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TarificationcontainerTableMap::COL_CODEDUREE), $tarificationcontainer->getCodeduree(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TarificationcontainerTableMap::COL_NUMTYPECONTAINER), $tarificationcontainer->getNumtypecontainer(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tarificationContainer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TarificationcontainerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TarificationcontainerTableMap::clearInstancePool();
            TarificationcontainerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TarificationcontainerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TarificationcontainerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TarificationcontainerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TarificationcontainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
