<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Pays as ChildPays;
use App\Http\Model\PaysQuery as ChildPaysQuery;
use App\Http\Model\Map\PaysTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `pays` table.
 *
 * @method     ChildPaysQuery orderByCodepays($order = Criteria::ASC) Order by the codePays column
 * @method     ChildPaysQuery orderByNompays($order = Criteria::ASC) Order by the nomPays column
 *
 * @method     ChildPaysQuery groupByCodepays() Group by the codePays column
 * @method     ChildPaysQuery groupByNompays() Group by the nomPays column
 *
 * @method     ChildPaysQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPaysQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPaysQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPaysQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPaysQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPaysQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPaysQuery leftJoinUtilisateur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Utilisateur relation
 * @method     ChildPaysQuery rightJoinUtilisateur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Utilisateur relation
 * @method     ChildPaysQuery innerJoinUtilisateur($relationAlias = null) Adds a INNER JOIN clause to the query using the Utilisateur relation
 *
 * @method     ChildPaysQuery joinWithUtilisateur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Utilisateur relation
 *
 * @method     ChildPaysQuery leftJoinWithUtilisateur() Adds a LEFT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildPaysQuery rightJoinWithUtilisateur() Adds a RIGHT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildPaysQuery innerJoinWithUtilisateur() Adds a INNER JOIN clause and with to the query using the Utilisateur relation
 *
 * @method     ChildPaysQuery leftJoinVille($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ville relation
 * @method     ChildPaysQuery rightJoinVille($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ville relation
 * @method     ChildPaysQuery innerJoinVille($relationAlias = null) Adds a INNER JOIN clause to the query using the Ville relation
 *
 * @method     ChildPaysQuery joinWithVille($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ville relation
 *
 * @method     ChildPaysQuery leftJoinWithVille() Adds a LEFT JOIN clause and with to the query using the Ville relation
 * @method     ChildPaysQuery rightJoinWithVille() Adds a RIGHT JOIN clause and with to the query using the Ville relation
 * @method     ChildPaysQuery innerJoinWithVille() Adds a INNER JOIN clause and with to the query using the Ville relation
 *
 * @method     \App\Http\Model\UtilisateurQuery|\App\Http\Model\VilleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPays|null findOne(?ConnectionInterface $con = null) Return the first ChildPays matching the query
 * @method     ChildPays findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPays matching the query, or a new ChildPays object populated from the query conditions when no match is found
 *
 * @method     ChildPays|null findOneByCodepays(string $codePays) Return the first ChildPays filtered by the codePays column
 * @method     ChildPays|null findOneByNompays(string $nomPays) Return the first ChildPays filtered by the nomPays column
 *
 * @method     ChildPays requirePk($key, ?ConnectionInterface $con = null) Return the ChildPays by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPays requireOne(?ConnectionInterface $con = null) Return the first ChildPays matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPays requireOneByCodepays(string $codePays) Return the first ChildPays filtered by the codePays column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPays requireOneByNompays(string $nomPays) Return the first ChildPays filtered by the nomPays column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPays[]|Collection find(?ConnectionInterface $con = null) Return ChildPays objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPays> find(?ConnectionInterface $con = null) Return ChildPays objects based on current ModelCriteria
 *
 * @method     ChildPays[]|Collection findByCodepays(string|array<string> $codePays) Return ChildPays objects filtered by the codePays column
 * @psalm-method Collection&\Traversable<ChildPays> findByCodepays(string|array<string> $codePays) Return ChildPays objects filtered by the codePays column
 * @method     ChildPays[]|Collection findByNompays(string|array<string> $nomPays) Return ChildPays objects filtered by the nomPays column
 * @psalm-method Collection&\Traversable<ChildPays> findByNompays(string|array<string> $nomPays) Return ChildPays objects filtered by the nomPays column
 *
 * @method     ChildPays[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPays> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PaysQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\PaysQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Pays', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPaysQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPaysQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPaysQuery) {
            return $criteria;
        }
        $query = new ChildPaysQuery();
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
     * @return ChildPays|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PaysTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PaysTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPays A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codePays, nomPays FROM pays WHERE codePays = :p0';
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
            /** @var ChildPays $obj */
            $obj = new ChildPays();
            $obj->hydrate($row);
            PaysTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPays|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PaysTableMap::COL_CODEPAYS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PaysTableMap::COL_CODEPAYS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codePays column
     *
     * Example usage:
     * <code>
     * $query->filterByCodepays('fooValue');   // WHERE codePays = 'fooValue'
     * $query->filterByCodepays('%fooValue%', Criteria::LIKE); // WHERE codePays LIKE '%fooValue%'
     * $query->filterByCodepays(['foo', 'bar']); // WHERE codePays IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codepays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodepays($codepays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codepays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PaysTableMap::COL_CODEPAYS, $codepays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nomPays column
     *
     * Example usage:
     * <code>
     * $query->filterByNompays('fooValue');   // WHERE nomPays = 'fooValue'
     * $query->filterByNompays('%fooValue%', Criteria::LIKE); // WHERE nomPays LIKE '%fooValue%'
     * $query->filterByNompays(['foo', 'bar']); // WHERE nomPays IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nompays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNompays($nompays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nompays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PaysTableMap::COL_NOMPAYS, $nompays, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Http\Model\Utilisateur object
     *
     * @param \App\Http\Model\Utilisateur|ObjectCollection $utilisateur the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUtilisateur($utilisateur, ?string $comparison = null)
    {
        if ($utilisateur instanceof \App\Http\Model\Utilisateur) {
            $this
                ->addUsingAlias(PaysTableMap::COL_CODEPAYS, $utilisateur->getCodepays(), $comparison);

            return $this;
        } elseif ($utilisateur instanceof ObjectCollection) {
            $this
                ->useUtilisateurQuery()
                ->filterByPrimaryKeys($utilisateur->getPrimaryKeys())
                ->endUse();

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
     * @param \App\Http\Model\Ville|ObjectCollection $ville the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVille($ville, ?string $comparison = null)
    {
        if ($ville instanceof \App\Http\Model\Ville) {
            $this
                ->addUsingAlias(PaysTableMap::COL_CODEPAYS, $ville->getCodepays(), $comparison);

            return $this;
        } elseif ($ville instanceof ObjectCollection) {
            $this
                ->useVilleQuery()
                ->filterByPrimaryKeys($ville->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVille() only accepts arguments of type \App\Http\Model\Ville or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ville relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVille(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ville');

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
            $this->addJoinObject($join, 'Ville');
        }

        return $this;
    }

    /**
     * Use the Ville relation Ville object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\VilleQuery A secondary query class using the current class as primary query
     */
    public function useVilleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVille($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ville', '\App\Http\Model\VilleQuery');
    }

    /**
     * Use the Ville relation Ville object
     *
     * @param callable(\App\Http\Model\VilleQuery):\App\Http\Model\VilleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVilleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVilleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Ville table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the EXISTS statement
     */
    public function useVilleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('Ville', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Ville table for a NOT EXISTS query.
     *
     * @see useVilleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT EXISTS statement
     */
    public function useVilleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useExistsQuery('Ville', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Ville table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the IN statement
     */
    public function useInVilleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('Ville', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Ville table for a NOT IN query.
     *
     * @see useVilleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\VilleQuery The inner query object of the NOT IN statement
     */
    public function useNotInVilleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\Http\Model\VilleQuery */
        $q = $this->useInQuery('Ville', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPays $pays Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pays = null)
    {
        if ($pays) {
            $this->addUsingAlias(PaysTableMap::COL_CODEPAYS, $pays->getCodepays(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pays table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaysTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PaysTableMap::clearInstancePool();
            PaysTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PaysTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PaysTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PaysTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PaysTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
