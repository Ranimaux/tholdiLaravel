<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Duree as ChildDuree;
use App\Http\Model\DureeQuery as ChildDureeQuery;
use App\Http\Model\Map\DureeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `duree` table.
 *
 * @method     ChildDureeQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildDureeQuery orderByNbjours($order = Criteria::ASC) Order by the nbJours column
 *
 * @method     ChildDureeQuery groupByCode() Group by the code column
 * @method     ChildDureeQuery groupByNbjours() Group by the nbJours column
 *
 * @method     ChildDureeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDureeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDureeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDureeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDureeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDureeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDureeQuery leftJoinTarificationcontainer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildDureeQuery rightJoinTarificationcontainer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildDureeQuery innerJoinTarificationcontainer($relationAlias = null) Adds a INNER JOIN clause to the query using the Tarificationcontainer relation
 *
 * @method     ChildDureeQuery joinWithTarificationcontainer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tarificationcontainer relation
 *
 * @method     ChildDureeQuery leftJoinWithTarificationcontainer() Adds a LEFT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildDureeQuery rightJoinWithTarificationcontainer() Adds a RIGHT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildDureeQuery innerJoinWithTarificationcontainer() Adds a INNER JOIN clause and with to the query using the Tarificationcontainer relation
 *
 * @method     \App\Http\Model\TarificationcontainerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDuree|null findOne(?ConnectionInterface $con = null) Return the first ChildDuree matching the query
 * @method     ChildDuree findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDuree matching the query, or a new ChildDuree object populated from the query conditions when no match is found
 *
 * @method     ChildDuree|null findOneByCode(string $code) Return the first ChildDuree filtered by the code column
 * @method     ChildDuree|null findOneByNbjours(int $nbJours) Return the first ChildDuree filtered by the nbJours column
 *
 * @method     ChildDuree requirePk($key, ?ConnectionInterface $con = null) Return the ChildDuree by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDuree requireOne(?ConnectionInterface $con = null) Return the first ChildDuree matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDuree requireOneByCode(string $code) Return the first ChildDuree filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDuree requireOneByNbjours(int $nbJours) Return the first ChildDuree filtered by the nbJours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDuree[]|Collection find(?ConnectionInterface $con = null) Return ChildDuree objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDuree> find(?ConnectionInterface $con = null) Return ChildDuree objects based on current ModelCriteria
 *
 * @method     ChildDuree[]|Collection findByCode(string|array<string> $code) Return ChildDuree objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildDuree> findByCode(string|array<string> $code) Return ChildDuree objects filtered by the code column
 * @method     ChildDuree[]|Collection findByNbjours(int|array<int> $nbJours) Return ChildDuree objects filtered by the nbJours column
 * @psalm-method Collection&\Traversable<ChildDuree> findByNbjours(int|array<int> $nbJours) Return ChildDuree objects filtered by the nbJours column
 *
 * @method     ChildDuree[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDuree> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DureeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\DureeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Duree', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDureeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDureeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDureeQuery) {
            return $criteria;
        }
        $query = new ChildDureeQuery();
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
     * @return ChildDuree|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DureeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DureeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDuree A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT code, nbJours FROM duree WHERE code = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDuree $obj */
            $obj = new ChildDuree();
            $obj->hydrate($row);
            DureeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDuree|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DureeTableMap::COL_CODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DureeTableMap::COL_CODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $code The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode($code = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DureeTableMap::COL_CODE, $code, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nbJours column
     *
     * Example usage:
     * <code>
     * $query->filterByNbjours(1234); // WHERE nbJours = 1234
     * $query->filterByNbjours(array(12, 34)); // WHERE nbJours IN (12, 34)
     * $query->filterByNbjours(array('min' => 12)); // WHERE nbJours > 12
     * </code>
     *
     * @param mixed $nbjours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNbjours($nbjours = null, ?string $comparison = null)
    {
        if (is_array($nbjours)) {
            $useMinMax = false;
            if (isset($nbjours['min'])) {
                $this->addUsingAlias(DureeTableMap::COL_NBJOURS, $nbjours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbjours['max'])) {
                $this->addUsingAlias(DureeTableMap::COL_NBJOURS, $nbjours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DureeTableMap::COL_NBJOURS, $nbjours, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Tarificationcontainer object
     *
     * @param \App\Http\Model\Tarificationcontainer|ObjectCollection $tarificationcontainer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTarificationcontainer($tarificationcontainer, ?string $comparison = null)
    {
        if ($tarificationcontainer instanceof \App\Http\Model\Tarificationcontainer) {
            $this
                ->addUsingAlias(DureeTableMap::COL_CODE, $tarificationcontainer->getCodeduree(), $comparison);

            return $this;
        } elseif ($tarificationcontainer instanceof ObjectCollection) {
            $this
                ->useTarificationcontainerQuery()
                ->filterByPrimaryKeys($tarificationcontainer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTarificationcontainer() only accepts arguments of type \App\Http\Model\Tarificationcontainer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tarificationcontainer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTarificationcontainer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tarificationcontainer');

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
            $this->addJoinObject($join, 'Tarificationcontainer');
        }

        return $this;
    }

    /**
     * Use the Tarificationcontainer relation Tarificationcontainer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\TarificationcontainerQuery A secondary query class using the current class as primary query
     */
    public function useTarificationcontainerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTarificationcontainer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tarificationcontainer', '\App\Http\Model\TarificationcontainerQuery');
    }

    /**
     * Use the Tarificationcontainer relation Tarificationcontainer object
     *
     * @param callable(\App\Http\Model\TarificationcontainerQuery):\App\Http\Model\TarificationcontainerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTarificationcontainerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTarificationcontainerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tarificationcontainer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the EXISTS statement
     */
    public function useTarificationcontainerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\TarificationcontainerQuery */
        $q = $this->useExistsQuery('Tarificationcontainer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tarificationcontainer table for a NOT EXISTS query.
     *
     * @see useTarificationcontainerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the NOT EXISTS statement
     */
    public function useTarificationcontainerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\TarificationcontainerQuery */
        $q = $this->useExistsQuery('Tarificationcontainer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tarificationcontainer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the IN statement
     */
    public function useInTarificationcontainerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\TarificationcontainerQuery */
        $q = $this->useInQuery('Tarificationcontainer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tarificationcontainer table for a NOT IN query.
     *
     * @see useTarificationcontainerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the NOT IN statement
     */
    public function useNotInTarificationcontainerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\TarificationcontainerQuery */
        $q = $this->useInQuery('Tarificationcontainer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDuree $duree Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($duree = null)
    {
        if ($duree) {
            $this->addUsingAlias(DureeTableMap::COL_CODE, $duree->getCode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the duree table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DureeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DureeTableMap::clearInstancePool();
            DureeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DureeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DureeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DureeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DureeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
