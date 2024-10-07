<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Typecontainer as ChildTypecontainer;
use App\Http\Model\TypecontainerQuery as ChildTypecontainerQuery;
use App\Http\Model\Map\TypecontainerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `typeContainer` table.
 *
 * @method     ChildTypecontainerQuery orderByNumtypecontainer($order = Criteria::ASC) Order by the numTypeContainer column
 * @method     ChildTypecontainerQuery orderByCodetypecontainer($order = Criteria::ASC) Order by the codeTypeContainer column
 * @method     ChildTypecontainerQuery orderByLibelletypecontainer($order = Criteria::ASC) Order by the libelleTypeContainer column
 * @method     ChildTypecontainerQuery orderByLongueurenmillimetre($order = Criteria::ASC) Order by the longueurEnMillimetre column
 * @method     ChildTypecontainerQuery orderByLargeurenmillimetre($order = Criteria::ASC) Order by the largeurEnMillimetre column
 * @method     ChildTypecontainerQuery orderByHauteurenmillimetre($order = Criteria::ASC) Order by the hauteurEnMillimetre column
 * @method     ChildTypecontainerQuery orderByMasseentonne($order = Criteria::ASC) Order by the masseEnTonne column
 * @method     ChildTypecontainerQuery orderByVolumeenmetrecube($order = Criteria::ASC) Order by the volumeEnMetreCube column
 * @method     ChildTypecontainerQuery orderByCapacitedechargeentonne($order = Criteria::ASC) Order by the capaciteDeChargeEnTonne column
 *
 * @method     ChildTypecontainerQuery groupByNumtypecontainer() Group by the numTypeContainer column
 * @method     ChildTypecontainerQuery groupByCodetypecontainer() Group by the codeTypeContainer column
 * @method     ChildTypecontainerQuery groupByLibelletypecontainer() Group by the libelleTypeContainer column
 * @method     ChildTypecontainerQuery groupByLongueurenmillimetre() Group by the longueurEnMillimetre column
 * @method     ChildTypecontainerQuery groupByLargeurenmillimetre() Group by the largeurEnMillimetre column
 * @method     ChildTypecontainerQuery groupByHauteurenmillimetre() Group by the hauteurEnMillimetre column
 * @method     ChildTypecontainerQuery groupByMasseentonne() Group by the masseEnTonne column
 * @method     ChildTypecontainerQuery groupByVolumeenmetrecube() Group by the volumeEnMetreCube column
 * @method     ChildTypecontainerQuery groupByCapacitedechargeentonne() Group by the capaciteDeChargeEnTonne column
 *
 * @method     ChildTypecontainerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTypecontainerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTypecontainerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTypecontainerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTypecontainerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTypecontainerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTypecontainerQuery leftJoinReserver($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reserver relation
 * @method     ChildTypecontainerQuery rightJoinReserver($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reserver relation
 * @method     ChildTypecontainerQuery innerJoinReserver($relationAlias = null) Adds a INNER JOIN clause to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery joinWithReserver($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery leftJoinWithReserver() Adds a LEFT JOIN clause and with to the query using the Reserver relation
 * @method     ChildTypecontainerQuery rightJoinWithReserver() Adds a RIGHT JOIN clause and with to the query using the Reserver relation
 * @method     ChildTypecontainerQuery innerJoinWithReserver() Adds a INNER JOIN clause and with to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery leftJoinTarificationcontainer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery rightJoinTarificationcontainer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery innerJoinTarificationcontainer($relationAlias = null) Adds a INNER JOIN clause to the query using the Tarificationcontainer relation
 *
 * @method     ChildTypecontainerQuery joinWithTarificationcontainer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tarificationcontainer relation
 *
 * @method     ChildTypecontainerQuery leftJoinWithTarificationcontainer() Adds a LEFT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery rightJoinWithTarificationcontainer() Adds a RIGHT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery innerJoinWithTarificationcontainer() Adds a INNER JOIN clause and with to the query using the Tarificationcontainer relation
 *
 * @method     \App\Http\Model\ReserverQuery|\App\Http\Model\TarificationcontainerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTypecontainer|null findOne(?ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query
 * @method     ChildTypecontainer findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query, or a new ChildTypecontainer object populated from the query conditions when no match is found
 *
 * @method     ChildTypecontainer|null findOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTypecontainer filtered by the numTypeContainer column
 * @method     ChildTypecontainer|null findOneByCodetypecontainer(string $codeTypeContainer) Return the first ChildTypecontainer filtered by the codeTypeContainer column
 * @method     ChildTypecontainer|null findOneByLibelletypecontainer(string $libelleTypeContainer) Return the first ChildTypecontainer filtered by the libelleTypeContainer column
 * @method     ChildTypecontainer|null findOneByLongueurenmillimetre(string $longueurEnMillimetre) Return the first ChildTypecontainer filtered by the longueurEnMillimetre column
 * @method     ChildTypecontainer|null findOneByLargeurenmillimetre(string $largeurEnMillimetre) Return the first ChildTypecontainer filtered by the largeurEnMillimetre column
 * @method     ChildTypecontainer|null findOneByHauteurenmillimetre(string $hauteurEnMillimetre) Return the first ChildTypecontainer filtered by the hauteurEnMillimetre column
 * @method     ChildTypecontainer|null findOneByMasseentonne(string $masseEnTonne) Return the first ChildTypecontainer filtered by the masseEnTonne column
 * @method     ChildTypecontainer|null findOneByVolumeenmetrecube(string $volumeEnMetreCube) Return the first ChildTypecontainer filtered by the volumeEnMetreCube column
 * @method     ChildTypecontainer|null findOneByCapacitedechargeentonne(string $capaciteDeChargeEnTonne) Return the first ChildTypecontainer filtered by the capaciteDeChargeEnTonne column
 *
 * @method     ChildTypecontainer requirePk($key, ?ConnectionInterface $con = null) Return the ChildTypecontainer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOne(?ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTypecontainer requireOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTypecontainer filtered by the numTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByCodetypecontainer(string $codeTypeContainer) Return the first ChildTypecontainer filtered by the codeTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLibelletypecontainer(string $libelleTypeContainer) Return the first ChildTypecontainer filtered by the libelleTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLongueurenmillimetre(string $longueurEnMillimetre) Return the first ChildTypecontainer filtered by the longueurEnMillimetre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLargeurenmillimetre(string $largeurEnMillimetre) Return the first ChildTypecontainer filtered by the largeurEnMillimetre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByHauteurenmillimetre(string $hauteurEnMillimetre) Return the first ChildTypecontainer filtered by the hauteurEnMillimetre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByMasseentonne(string $masseEnTonne) Return the first ChildTypecontainer filtered by the masseEnTonne column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByVolumeenmetrecube(string $volumeEnMetreCube) Return the first ChildTypecontainer filtered by the volumeEnMetreCube column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByCapacitedechargeentonne(string $capaciteDeChargeEnTonne) Return the first ChildTypecontainer filtered by the capaciteDeChargeEnTonne column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTypecontainer[]|Collection find(?ConnectionInterface $con = null) Return ChildTypecontainer objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTypecontainer> find(?ConnectionInterface $con = null) Return ChildTypecontainer objects based on current ModelCriteria
 *
 * @method     ChildTypecontainer[]|Collection findByNumtypecontainer(int|array<int> $numTypeContainer) Return ChildTypecontainer objects filtered by the numTypeContainer column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByNumtypecontainer(int|array<int> $numTypeContainer) Return ChildTypecontainer objects filtered by the numTypeContainer column
 * @method     ChildTypecontainer[]|Collection findByCodetypecontainer(string|array<string> $codeTypeContainer) Return ChildTypecontainer objects filtered by the codeTypeContainer column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByCodetypecontainer(string|array<string> $codeTypeContainer) Return ChildTypecontainer objects filtered by the codeTypeContainer column
 * @method     ChildTypecontainer[]|Collection findByLibelletypecontainer(string|array<string> $libelleTypeContainer) Return ChildTypecontainer objects filtered by the libelleTypeContainer column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByLibelletypecontainer(string|array<string> $libelleTypeContainer) Return ChildTypecontainer objects filtered by the libelleTypeContainer column
 * @method     ChildTypecontainer[]|Collection findByLongueurenmillimetre(string|array<string> $longueurEnMillimetre) Return ChildTypecontainer objects filtered by the longueurEnMillimetre column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByLongueurenmillimetre(string|array<string> $longueurEnMillimetre) Return ChildTypecontainer objects filtered by the longueurEnMillimetre column
 * @method     ChildTypecontainer[]|Collection findByLargeurenmillimetre(string|array<string> $largeurEnMillimetre) Return ChildTypecontainer objects filtered by the largeurEnMillimetre column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByLargeurenmillimetre(string|array<string> $largeurEnMillimetre) Return ChildTypecontainer objects filtered by the largeurEnMillimetre column
 * @method     ChildTypecontainer[]|Collection findByHauteurenmillimetre(string|array<string> $hauteurEnMillimetre) Return ChildTypecontainer objects filtered by the hauteurEnMillimetre column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByHauteurenmillimetre(string|array<string> $hauteurEnMillimetre) Return ChildTypecontainer objects filtered by the hauteurEnMillimetre column
 * @method     ChildTypecontainer[]|Collection findByMasseentonne(string|array<string> $masseEnTonne) Return ChildTypecontainer objects filtered by the masseEnTonne column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByMasseentonne(string|array<string> $masseEnTonne) Return ChildTypecontainer objects filtered by the masseEnTonne column
 * @method     ChildTypecontainer[]|Collection findByVolumeenmetrecube(string|array<string> $volumeEnMetreCube) Return ChildTypecontainer objects filtered by the volumeEnMetreCube column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByVolumeenmetrecube(string|array<string> $volumeEnMetreCube) Return ChildTypecontainer objects filtered by the volumeEnMetreCube column
 * @method     ChildTypecontainer[]|Collection findByCapacitedechargeentonne(string|array<string> $capaciteDeChargeEnTonne) Return ChildTypecontainer objects filtered by the capaciteDeChargeEnTonne column
 * @psalm-method Collection&\Traversable<ChildTypecontainer> findByCapacitedechargeentonne(string|array<string> $capaciteDeChargeEnTonne) Return ChildTypecontainer objects filtered by the capaciteDeChargeEnTonne column
 *
 * @method     ChildTypecontainer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTypecontainer> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TypecontainerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\TypecontainerQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Typecontainer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTypecontainerQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTypecontainerQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTypecontainerQuery) {
            return $criteria;
        }
        $query = new ChildTypecontainerQuery();
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
     * @return ChildTypecontainer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TypecontainerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTypecontainer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numTypeContainer, codeTypeContainer, libelleTypeContainer, longueurEnMillimetre, largeurEnMillimetre, hauteurEnMillimetre, masseEnTonne, volumeEnMetreCube, capaciteDeChargeEnTonne FROM typeContainer WHERE numTypeContainer = :p0';
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
            /** @var ChildTypecontainer $obj */
            $obj = new ChildTypecontainer();
            $obj->hydrate($row);
            TypecontainerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTypecontainer|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $keys, Criteria::IN);

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
                $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numtypecontainer['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codeTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByCodetypecontainer('fooValue');   // WHERE codeTypeContainer = 'fooValue'
     * $query->filterByCodetypecontainer('%fooValue%', Criteria::LIKE); // WHERE codeTypeContainer LIKE '%fooValue%'
     * $query->filterByCodetypecontainer(['foo', 'bar']); // WHERE codeTypeContainer IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codetypecontainer The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodetypecontainer($codetypecontainer = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codetypecontainer)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_CODETYPECONTAINER, $codetypecontainer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the libelleTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByLibelletypecontainer('fooValue');   // WHERE libelleTypeContainer = 'fooValue'
     * $query->filterByLibelletypecontainer('%fooValue%', Criteria::LIKE); // WHERE libelleTypeContainer LIKE '%fooValue%'
     * $query->filterByLibelletypecontainer(['foo', 'bar']); // WHERE libelleTypeContainer IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $libelletypecontainer The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLibelletypecontainer($libelletypecontainer = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelletypecontainer)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_LIBELLETYPECONTAINER, $libelletypecontainer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the longueurEnMillimetre column
     *
     * Example usage:
     * <code>
     * $query->filterByLongueurenmillimetre(1234); // WHERE longueurEnMillimetre = 1234
     * $query->filterByLongueurenmillimetre(array(12, 34)); // WHERE longueurEnMillimetre IN (12, 34)
     * $query->filterByLongueurenmillimetre(array('min' => 12)); // WHERE longueurEnMillimetre > 12
     * </code>
     *
     * @param mixed $longueurenmillimetre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLongueurenmillimetre($longueurenmillimetre = null, ?string $comparison = null)
    {
        if (is_array($longueurenmillimetre)) {
            $useMinMax = false;
            if (isset($longueurenmillimetre['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE, $longueurenmillimetre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longueurenmillimetre['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE, $longueurenmillimetre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURENMILLIMETRE, $longueurenmillimetre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the largeurEnMillimetre column
     *
     * Example usage:
     * <code>
     * $query->filterByLargeurenmillimetre(1234); // WHERE largeurEnMillimetre = 1234
     * $query->filterByLargeurenmillimetre(array(12, 34)); // WHERE largeurEnMillimetre IN (12, 34)
     * $query->filterByLargeurenmillimetre(array('min' => 12)); // WHERE largeurEnMillimetre > 12
     * </code>
     *
     * @param mixed $largeurenmillimetre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLargeurenmillimetre($largeurenmillimetre = null, ?string $comparison = null)
    {
        if (is_array($largeurenmillimetre)) {
            $useMinMax = false;
            if (isset($largeurenmillimetre['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURENMILLIMETRE, $largeurenmillimetre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($largeurenmillimetre['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURENMILLIMETRE, $largeurenmillimetre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURENMILLIMETRE, $largeurenmillimetre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the hauteurEnMillimetre column
     *
     * Example usage:
     * <code>
     * $query->filterByHauteurenmillimetre(1234); // WHERE hauteurEnMillimetre = 1234
     * $query->filterByHauteurenmillimetre(array(12, 34)); // WHERE hauteurEnMillimetre IN (12, 34)
     * $query->filterByHauteurenmillimetre(array('min' => 12)); // WHERE hauteurEnMillimetre > 12
     * </code>
     *
     * @param mixed $hauteurenmillimetre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHauteurenmillimetre($hauteurenmillimetre = null, ?string $comparison = null)
    {
        if (is_array($hauteurenmillimetre)) {
            $useMinMax = false;
            if (isset($hauteurenmillimetre['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE, $hauteurenmillimetre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hauteurenmillimetre['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE, $hauteurenmillimetre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURENMILLIMETRE, $hauteurenmillimetre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the masseEnTonne column
     *
     * Example usage:
     * <code>
     * $query->filterByMasseentonne(1234); // WHERE masseEnTonne = 1234
     * $query->filterByMasseentonne(array(12, 34)); // WHERE masseEnTonne IN (12, 34)
     * $query->filterByMasseentonne(array('min' => 12)); // WHERE masseEnTonne > 12
     * </code>
     *
     * @param mixed $masseentonne The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMasseentonne($masseentonne = null, ?string $comparison = null)
    {
        if (is_array($masseentonne)) {
            $useMinMax = false;
            if (isset($masseentonne['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_MASSEENTONNE, $masseentonne['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($masseentonne['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_MASSEENTONNE, $masseentonne['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_MASSEENTONNE, $masseentonne, $comparison);

        return $this;
    }

    /**
     * Filter the query on the volumeEnMetreCube column
     *
     * Example usage:
     * <code>
     * $query->filterByVolumeenmetrecube(1234); // WHERE volumeEnMetreCube = 1234
     * $query->filterByVolumeenmetrecube(array(12, 34)); // WHERE volumeEnMetreCube IN (12, 34)
     * $query->filterByVolumeenmetrecube(array('min' => 12)); // WHERE volumeEnMetreCube > 12
     * </code>
     *
     * @param mixed $volumeenmetrecube The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolumeenmetrecube($volumeenmetrecube = null, ?string $comparison = null)
    {
        if (is_array($volumeenmetrecube)) {
            $useMinMax = false;
            if (isset($volumeenmetrecube['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_VOLUMEENMETRECUBE, $volumeenmetrecube['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($volumeenmetrecube['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_VOLUMEENMETRECUBE, $volumeenmetrecube['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_VOLUMEENMETRECUBE, $volumeenmetrecube, $comparison);

        return $this;
    }

    /**
     * Filter the query on the capaciteDeChargeEnTonne column
     *
     * Example usage:
     * <code>
     * $query->filterByCapacitedechargeentonne(1234); // WHERE capaciteDeChargeEnTonne = 1234
     * $query->filterByCapacitedechargeentonne(array(12, 34)); // WHERE capaciteDeChargeEnTonne IN (12, 34)
     * $query->filterByCapacitedechargeentonne(array('min' => 12)); // WHERE capaciteDeChargeEnTonne > 12
     * </code>
     *
     * @param mixed $capacitedechargeentonne The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCapacitedechargeentonne($capacitedechargeentonne = null, ?string $comparison = null)
    {
        if (is_array($capacitedechargeentonne)) {
            $useMinMax = false;
            if (isset($capacitedechargeentonne['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE, $capacitedechargeentonne['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capacitedechargeentonne['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE, $capacitedechargeentonne['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGEENTONNE, $capacitedechargeentonne, $comparison);

        return $this;
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
                ->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $reserver->getNumtypecontainer(), $comparison);

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
                ->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $tarificationcontainer->getNumtypecontainer(), $comparison);

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
     * @param ChildTypecontainer $typecontainer Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($typecontainer = null)
    {
        if ($typecontainer) {
            $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $typecontainer->getNumtypecontainer(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the typeContainer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TypecontainerTableMap::clearInstancePool();
            TypecontainerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TypecontainerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TypecontainerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TypecontainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
